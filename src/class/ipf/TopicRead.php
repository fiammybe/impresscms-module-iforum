<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumTopicRead extends IforumPersistableObject
{
    public function __construct(&$handler)
    {
        parent::__construct($handler);
        $this->quickInitVar('read_id', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('uid', XOBJ_DTYPE_INT, true, '');
        $this->quickInitVar('read_time', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('read_item', XOBJ_DTYPE_INT, true, '');
        $this->quickInitVar('post_id', XOBJ_DTYPE_INT, false, '');
    }
}

class IforumTopicReadPersistableHandler extends IforumPersistableHandler
{
    public function __construct(&$db)
    {
        parent::__construct($db, 'topicread', 'bb_reads_topic', 'IforumTopicRead', 'read_id', 'read_item', 'post_id');
    }
}
