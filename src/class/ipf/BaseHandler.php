<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumPersistableHandler extends icms_ipf_Handler
{
    public function __construct(&$db, string $itemname, string $tableName, string $className, string $keyName, string $identifierName, string $summaryName = '')
    {
        parent::__construct($db, $itemname, $keyName, $identifierName, $summaryName, 'iforum');
        $this->table = $db->prefix($tableName);
        $this->className = $className;
        $this->_moduleName = 'iforum';
        $this->_modulePath = ICMS_ROOT_PATH . '/modules/iforum/';
        $this->_moduleUrl = ICMS_URL . '/modules/iforum/';
        $this->_uploadPath = ICMS_UPLOAD_PATH . '/iforum/';
        $this->_uploadUrl = ICMS_UPLOAD_URL . '/iforum/';
    }
}
