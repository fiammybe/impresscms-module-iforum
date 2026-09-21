<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumPersistableObject extends icms_ipf_Object
{
    public function __construct(&$handler)
    {
        parent::__construct($handler);
    }
}
