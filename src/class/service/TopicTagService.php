<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumTopicTagService
{
    public function populateTagItemInfo(array &$items): bool
    {
        if (empty($items)) {
            return false;
        }

        $items_id = array();
        foreach (array_keys($items) as $cat_id) {
            foreach (array_keys($items[$cat_id]) as $item_id) {
                $items_id[] = (int)$item_id;
            }
        }

        if (empty($items_id)) {
            return false;
        }

        $item_handler = iforum_get_ipf_handler('topic');
        $items_obj = $item_handler->getObjects(new icms_db_criteria_Item('topic_id', '(' . implode(', ', $items_id) . ')', 'IN'), true);

        foreach (array_keys($items) as $cat_id) {
            foreach (array_keys($items[$cat_id]) as $item_id) {
                if (!isset($items_obj[$item_id])) {
                    continue;
                }
                $item_obj = $items_obj[$item_id];
                $items[$cat_id][$item_id] = array(
                    'title' => $item_obj->getVar('topic_title'),
                    'uid' => $item_obj->getVar('topic_poster'),
                    'link' => 'viewtopic.php?topic_id=' . $item_id,
                    'time' => $item_obj->getVar('topic_time'),
                    'tags' => tag_parse_tag($item_obj->getVar('topic_tags', 'n')),
                    'content' => '',
                );
            }
        }

        return true;
    }

    public function synchronize(int $mid): bool
    {
        $item_handler = iforum_get_ipf_handler('topic');
        $link_handler = xoops_getmodulehandler('link', 'tag');

        if ($link_handler->mysql_major_version() >= 4) {
            $sql = ' DELETE FROM ' . $link_handler->table
                . ' WHERE tag_modid = ' . $mid
                . ' AND ( tag_itemid NOT IN ( SELECT DISTINCT ' . $item_handler->keyName
                . ' FROM ' . $item_handler->table
                . ' WHERE ' . $item_handler->table . '.approved > 0 ) )';
        } else {
            $sql = ' DELETE ' . $link_handler->table . ' FROM ' . $link_handler->table
                . ' LEFT JOIN ' . $item_handler->table . ' AS aa ON ' . $link_handler->table . '.tag_itemid = aa.' . $item_handler->keyName
                . ' WHERE tag_modid = ' . $mid
                . ' AND ( aa.' . $item_handler->keyName . ' IS NULL OR aa.approved < 1 )';
        }

        return (bool)$link_handler->db->queryF($sql);
    }
}
