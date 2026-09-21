<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumDigestArchive extends IforumPersistableObject
{
    public function __construct(&$handler)
    {
        parent::__construct($handler);
        $this->quickInitVar('digest_id', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('digest_time', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('digest_content', XOBJ_DTYPE_TXTAREA, false, '');
    }
}

class IforumDigestArchivePersistableHandler extends IforumPersistableHandler
{
    public function __construct(&$db)
    {
        parent::__construct($db, 'digestarchive', 'bb_digest', 'IforumDigestArchive', 'digest_id', 'digest_id', 'digest_content');
    }
}
