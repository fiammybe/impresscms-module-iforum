<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumEditPostForm
{
    public static function create(array $context)
    {
        return IforumPostFormBuilder::create($context);
    }
}
