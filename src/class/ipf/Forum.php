<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumForum extends IforumPersistableObject
{
    public function __construct(&$handler)
    {
        parent::__construct($handler);
        $this->quickInitVar('forum_id', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('forum_name', XOBJ_DTYPE_TXTBOX, true, '');
        $this->quickInitVar('forum_desc', XOBJ_DTYPE_TXTAREA, false, '');
        $this->initVar('forum_moderator', XOBJ_DTYPE_ARRAY, array(), false, null, '', false, '', '', false, true, true);
        $this->quickInitVar('forum_topics', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('forum_posts', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('forum_last_post_id', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('cat_id', XOBJ_DTYPE_INT, true, '');
        $this->quickInitVar('forum_type', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('parent_forum', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('allow_html', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('allow_sig', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('allow_subject_prefix', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('hot_threshold', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('attach_maxkb', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('attach_ext', XOBJ_DTYPE_TXTAREA, false, '');
        $this->quickInitVar('allow_polls', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('forum_order', XOBJ_DTYPE_INT, false, '');
        $this->initCommonVar('dohtml');
        $this->initCommonVar('dosmiley');
        $this->initCommonVar('doxcode');
        $this->initCommonVar('doimage');
        $this->initCommonVar('dobr');
    }
}

class IforumForumPersistableHandler extends IforumPersistableHandler
{
    public function __construct(&$db)
    {
        parent::__construct($db, 'forum', 'bb_forums', 'IforumForum', 'forum_id', 'forum_name', 'forum_desc');
    }
}
