<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumPostPersistableObject extends IforumPersistableObject
{
    public function __construct(&$handler)
    {
        parent::__construct($handler);
        $this->quickInitVar('post_id', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('pid', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('topic_id', XOBJ_DTYPE_INT, true, '');
        $this->quickInitVar('forum_id', XOBJ_DTYPE_INT, true, '');
        $this->quickInitVar('post_time', XOBJ_DTYPE_INT, true, '');
        $this->quickInitVar('uid', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('poster_name', XOBJ_DTYPE_TXTBOX, false, '');
        $this->quickInitVar('poster_ip', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('subject', XOBJ_DTYPE_TXTBOX, true, '');
        $this->quickInitVar('dohtml', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('dosmiley', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('doxcode', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('dobr', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('doimage', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('icon', XOBJ_DTYPE_TXTBOX, false, '');
        $this->quickInitVar('attachsig', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('approved', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('post_karma', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('attachment', XOBJ_DTYPE_TXTAREA, false, '');
        $this->quickInitVar('require_reply', XOBJ_DTYPE_INT, false, '');
    }
}

class IforumPostPersistableHandler extends IforumPersistableHandler
{
    public function __construct(&$db)
    {
        parent::__construct($db, 'post', 'bb_posts', 'IforumPostPersistableObject', 'post_id', 'subject', 'subject');
    }
}
