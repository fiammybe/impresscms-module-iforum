<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumReportPersistableObject extends IforumPersistableObject
{
    public function __construct(&$handler)
    {
        parent::__construct($handler);
        $this->quickInitVar('report_id', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('post_id', XOBJ_DTYPE_INT, true, '');
        $this->quickInitVar('reporter_uid', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('reporter_ip', XOBJ_DTYPE_TXTBOX, false, '');
        $this->quickInitVar('report_time', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('report_text', XOBJ_DTYPE_TXTBOX, true, '');
        $this->quickInitVar('report_result', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('report_memo', XOBJ_DTYPE_TXTBOX, false, '');
    }
}

class IforumReportPersistableHandler extends IforumPersistableHandler
{
    public function __construct(&$db)
    {
        parent::__construct($db, 'report', 'bb_report', 'IforumReportPersistableObject', 'report_id', 'post_id', 'report_text');
    }
}
