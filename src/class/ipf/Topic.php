<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumTopic extends IforumPersistableObject
{
    public function __construct(&$handler)
    {
        parent::__construct($handler);
        $this->quickInitVar('topic_id', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('topic_title', XOBJ_DTYPE_TXTBOX, true, '');
        $this->quickInitVar('topic_poster', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('topic_time', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('topic_views', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('topic_replies', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('topic_last_post_id', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('forum_id', XOBJ_DTYPE_INT, true, '');
        $this->quickInitVar('topic_status', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('topic_subject', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('topic_sticky', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('topic_digest', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('digest_time', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('approved', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('poster_name', XOBJ_DTYPE_TXTBOX, false, '');
        $this->quickInitVar('rating', XOBJ_DTYPE_OTHER, false, '');
        $this->quickInitVar('votes', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('topic_haspoll', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('poll_id', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('topic_tags', XOBJ_DTYPE_TXTAREA, false, '');
    }
}

class IforumTopicPersistableHandler extends IforumPersistableHandler
{
    public function __construct(&$db)
    {
        parent::__construct($db, 'topic', 'bb_topics', 'IforumTopic', 'topic_id', 'topic_title', 'topic_title');
    }
}
