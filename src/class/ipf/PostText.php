<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumPostText extends IforumPersistableObject
{
    public function __construct(&$handler)
    {
        parent::__construct($handler);
        $this->quickInitVar('post_id', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('post_text', XOBJ_DTYPE_TXTAREA, false, '');
        $this->quickInitVar('post_edit', XOBJ_DTYPE_TXTAREA, false, '');
    }
}

class IforumPostTextPersistableHandler extends IforumPersistableHandler
{
    public function __construct(&$db)
    {
        parent::__construct($db, 'posttext', 'bb_posts_text', 'IforumPostText', 'post_id', 'post_id', 'post_text');
    }
}
