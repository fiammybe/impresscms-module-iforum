<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumCategory extends IforumPersistableObject
{
    public function __construct(&$handler)
    {
        parent::__construct($handler);
        $this->quickInitVar('cat_id', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('cat_title', XOBJ_DTYPE_TXTBOX, true, '');
        $this->quickInitVar('cat_image', XOBJ_DTYPE_TXTBOX, false, '');
        $this->quickInitVar('cat_description', XOBJ_DTYPE_TXTAREA, false, '');
        $this->quickInitVar('cat_order', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('cat_url', XOBJ_DTYPE_URL, false, '');
        $this->initNonPersistableVar('pid', XOBJ_DTYPE_INT, false, '', false, 0, false, false);
    }
}

class IforumCategoryPersistableHandler extends IforumPersistableHandler
{
    public function __construct(&$db)
    {
        parent::__construct($db, 'category', 'bb_categories', 'IforumCategory', 'cat_id', 'cat_title', 'cat_description');
    }
}
