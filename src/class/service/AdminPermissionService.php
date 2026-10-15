<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumAdminPermissionService
{
    public function getActionOptions(): array
    {
        return array(
            'no' => _SELECT,
            'template' => _AM_IFORUM_PERM_TEMPLATE,
            'apply' => _AM_IFORUM_PERM_TEMPLATEAPP,
            'default' => _AM_IFORUM_PERM_SETBYGROUP,
        );
    }

    public function getPermissionKeys(): array
    {
        return array_map('trim', explode(',', FORUM_PERM_ITEMS));
    }

    public function getForumCategoryOptions(): array
    {
        $categoryHandler = icms_getmodulehandler('category', basename(dirname(__FILE__, 4)), 'iforum');
        $categories = $categoryHandler->getAllCats('', true);
        $forumHandler = icms_getmodulehandler('forum', basename(dirname(__FILE__, 4)), 'iforum');
        $forums = $forumHandler->getForumsByCategory(0, '', false);
        $options = array();
        foreach (array_keys($categories) as $c) {
            $options[-1 * $c] = '[' . $categories[$c]->getVar('cat_title') . ']';
            foreach (array_keys($forums[$c]) as $f) {
                $options[$f] = $forums[$c][$f]['title'];
                if (!isset($forums[$c][$f]['sub'])) {
                    continue;
                }
                foreach (array_keys($forums[$c][$f]['sub']) as $s) {
                    $options[$s] = '-- ' . $forums[$c][$f]['sub'][$s]['title'];
                }
            }
        }
        return $options;
    }

    public function getPermissionFormOptions(array $perms): array
    {
        $opOptions = array('category' => _AM_IFORUM_CAT_ACCESS);
        $fmOptions = array('category' => array('title' => _AM_IFORUM_CAT_ACCESS, 'item' => 'category_access', 'desc' => '', 'anonymous' => true));
        foreach ($perms as $perm) {
            $opOptions[$perm] = constant('_AM_IFORUM_CAN_' . strtoupper($perm));
            $fmOptions[$perm] = array('title' => constant('_AM_IFORUM_CAN_' . strtoupper($perm)), 'item' => 'forum_' . $perm, 'desc' => '', 'anonymous' => true);
        }
        return array($opOptions, $fmOptions);
    }

    public function renderTemplateRows(array $groupList, array $perms, array $permTemplate): string
    {
        $elements = array();
        foreach (array_keys($groupList) as $i) {
            $selected = !empty($permTemplate[$i]) ? array_keys($permTemplate[$i]) : array();
            $ret = '<tr align="left" valign="top"><td class="head">' . $groupList[$i] . '</td>';
            $ret .= '<td class="even"><table class="outer"><tr><td class="odd"><table><tr>';
            $ii = 0;
            $optionIds = array();
            foreach ($perms as $perm) {
                $ii++;
                if ($ii % 5 == 0) {
                    $ret .= '</tr><tr>';
                }
                $checked = in_array('forum_' . $perm, $selected, true) ? " checked='checked'" : '';
                $optionId = $perm . '_' . $i;
                $optionIds[] = '\'' . $optionId . '\'';
                $ret .= '<td><input name="perms[' . $i . '][forum_' . $perm . ']" id="' . $optionId . '" value="1" type="checkbox"' . $checked . '>' . constant('_AM_IFORUM_CAN_' . strtoupper($perm)) . '<br></td>';
            }
            $ret .= '</tr></table></td><td class="even">';
            $ret .= _ALL . ' <input id="checkall[' . $i . ']" type="checkbox" value="" onclick="var optionids = new Array(' . implode(', ', $optionIds) . '); xoopsCheckAllElements(optionids, \'checkall[' . $i . ']\')" />';
            $ret .= '</td></tr></table></td></tr>';
            $elements[] = $ret;
        }
        return implode("\n", $elements);
    }
}
