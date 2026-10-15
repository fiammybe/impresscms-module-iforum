<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumForumPermissionService
{
    public function getPermissions(string $type = 'forum', $id = 0): array
    {
        $handler = icms_getmodulehandler('permission', basename(dirname(__FILE__, 4)), 'iforum');
        return $handler->getPermissions($type, $id);
    }

    public function canAccessCategory($category): bool
    {
        $handler = icms_getmodulehandler('category', basename(dirname(__FILE__, 4)), 'iforum');
        return (bool)$handler->getPermission($category);
    }

    public function canAccessForum($forum, string $permission = 'access', bool $allowAdmin = true): bool
    {
        $handler = icms_getmodulehandler('forum', basename(dirname(__FILE__, 4)), 'iforum');
        return (bool)$handler->getPermission($forum, $permission, $allowAdmin);
    }

    public function canPostToForum($forum): bool
    {
        $handler = icms_getmodulehandler('topic', basename(dirname(__FILE__, 4)), 'iforum');
        return (bool)$handler->getPermission($forum, 0, 'post');
    }

    public function canReplyToForum($forum, int $topicStatus): bool
    {
        $handler = icms_getmodulehandler('topic', basename(dirname(__FILE__, 4)), 'iforum');
        return (bool)$handler->getPermission($forum, $topicStatus, 'reply');
    }

    public function canEditPost($forum, int $topicStatus, $forumpost): bool
    {
        $handler = icms_getmodulehandler('topic', basename(dirname(__FILE__, 4)), 'iforum');
        return (bool)($handler->getPermission($forum, $topicStatus, 'edit')
            && (iforum_isAdmin($forum) || ($forumpost->checkTimelimit('edit_timelimit') && $forumpost->checkIdentity())));
    }

    public function canAttachToForum($forum, int $topicStatus): bool
    {
        $handler = icms_getmodulehandler('topic', basename(dirname(__FILE__, 4)), 'iforum');
        return (bool)$handler->getPermission($forum, $topicStatus, 'attach');
    }

    public function canBypassApproval($forum, int $topicStatus): bool
    {
        $handler = icms_getmodulehandler('topic', basename(dirname(__FILE__, 4)), 'iforum');
        return (bool)$handler->getPermission($forum, $topicStatus, 'noapprove');
    }
}
