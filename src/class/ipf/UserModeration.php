<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumUserModeration extends IforumPersistableObject
{
    public function __construct(&$handler)
    {
        parent::__construct($handler);
        $this->quickInitVar('mod_id', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('mod_start', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('mod_end', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('mod_desc', XOBJ_DTYPE_TXTBOX, false, '');
        $this->quickInitVar('uid', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('ip', XOBJ_DTYPE_TXTBOX, false, '');
        $this->quickInitVar('forum_id', XOBJ_DTYPE_INT, false, '');
    }
}

class IforumUserModerationPersistableHandler extends IforumPersistableHandler
{
    public function __construct(&$db)
    {
        parent::__construct($db, 'usermoderation', 'bb_moderates', 'IforumUserModeration', 'mod_id', 'uid', 'mod_desc');
    }
}
