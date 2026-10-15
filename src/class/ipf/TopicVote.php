<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumTopicVote extends IforumPersistableObject
{
    public function __construct(&$handler)
    {
        parent::__construct($handler);
        $this->quickInitVar('ratingid', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('topic_id', XOBJ_DTYPE_INT, true, '');
        $this->quickInitVar('ratinguser', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('rating', XOBJ_DTYPE_INT, false, '');
        $this->quickInitVar('ratinghostname', XOBJ_DTYPE_TXTBOX, false, '');
        $this->quickInitVar('ratingtimestamp', XOBJ_DTYPE_INT, false, '');
    }
}

class IforumTopicVotePersistableHandler extends IforumPersistableHandler
{
    public function __construct(&$db)
    {
        parent::__construct($db, 'topicvote', 'bb_votedata', 'IforumTopicVote', 'ratingid', 'topic_id', 'rating');
    }
}
