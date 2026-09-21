<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumForumPermissionService
{
    public function getPermissions(string $type = 'forum', $id = 0): array
    {
        $handler = icms_getmodulehandler('permission', basename(dirname(__FILE__, 3)), 'iforum');
        return $handler->getPermissions($type, $id);
    }

    public function canAccessCategory($category): bool
    {
        $handler = icms_getmodulehandler('category', basename(dirname(__FILE__, 3)), 'iforum');
        return (bool)$handler->getPermission($category);
    }

    public function canAccessForum($forum, string $permission = 'access', bool $allowAdmin = true): bool
    {
        $handler = icms_getmodulehandler('forum', basename(dirname(__FILE__, 3)), 'iforum');
        return (bool)$handler->getPermission($forum, $permission, $allowAdmin);
    }
}
