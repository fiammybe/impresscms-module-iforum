<?php
declare(strict_types=1);

if (!defined('ICMS_ROOT_PATH')) {
    exit();
}

if (defined('IFORUM_IPF_FUNCTIONS')) {
    return;
}
define('IFORUM_IPF_FUNCTIONS', 1);

function iforum_ipf_module_root(): string
{
    return ICMS_ROOT_PATH . '/modules/' . basename(dirname(__FILE__, 2));
}

function iforum_ipf_require_base(): void
{
    include_once iforum_ipf_module_root() . '/class/ipf/BaseObject.php';
    include_once iforum_ipf_module_root() . '/class/ipf/BaseHandler.php';
}

function iforum_load_ipf_class(string $group, string $name): bool
{
    $file = iforum_ipf_module_root() . '/class/' . $group . '/' . $name . '.php';
    if (!is_file($file)) {
        return false;
    }

    if ($group === 'ipf') {
        iforum_ipf_require_base();
    }

    include_once $file;
    return true;
}

function iforum_get_ipf_handler(string $name, $db = null)
{
    static $instances = array();

    $map = array(
        'category' => array('file' => 'Category', 'class' => 'IforumCategoryPersistableHandler'),
        'forum' => array('file' => 'Forum', 'class' => 'IforumForumPersistableHandler'),
        'topic' => array('file' => 'Topic', 'class' => 'IforumTopicPersistableHandler'),
        'post' => array('file' => 'Post', 'class' => 'IforumPostPersistableHandler'),
        'posttext' => array('file' => 'PostText', 'class' => 'IforumPostTextPersistableHandler'),
        'topicvote' => array('file' => 'TopicVote', 'class' => 'IforumTopicVotePersistableHandler'),
        'report' => array('file' => 'Report', 'class' => 'IforumReportPersistableHandler'),
        'usermoderation' => array('file' => 'UserModeration', 'class' => 'IforumUserModerationPersistableHandler'),
        'forumread' => array('file' => 'ForumRead', 'class' => 'IforumForumReadPersistableHandler'),
        'topicread' => array('file' => 'TopicRead', 'class' => 'IforumTopicReadPersistableHandler'),
        'digestarchive' => array('file' => 'DigestArchive', 'class' => 'IforumDigestArchivePersistableHandler'),
    );

    if (!isset($map[$name])) {
        return null;
    }

    if (!$db) {
        $db = icms::$xoopsDB;
    }

    $cacheKey = $name;
    if ($db !== icms::$xoopsDB && is_object($db)) {
        $cacheKey .= ':' . spl_object_hash($db);
    }

    if (!isset($instances[$cacheKey])) {
        iforum_load_ipf_class('ipf', $map[$name]['file']);
        $className = $map[$name]['class'];
        $instances[$cacheKey] = new $className($db);
    }

    return $instances[$cacheKey];
}

function iforum_get_service(string $name)
{
    static $instances = array();

    $map = array(
        'forumPermission' => array('file' => 'ForumPermissionService', 'class' => 'IforumForumPermissionService'),
        'search' => array('file' => 'SearchService', 'class' => 'IforumSearchService'),
        'notification' => array('file' => 'NotificationService', 'class' => 'IforumNotificationService'),
        'topicTag' => array('file' => 'TopicTagService', 'class' => 'IforumTopicTagService'),
    );

    if (!isset($map[$name])) {
        return null;
    }

    if (!isset($instances[$name])) {
        iforum_load_ipf_class('service', $map[$name]['file']);
        $className = $map[$name]['class'];
        $instances[$name] = new $className();
    }

    return $instances[$name];
}
