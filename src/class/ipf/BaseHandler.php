<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumPersistableHandler extends icms_ipf_Handler
{
    public function __construct(&$db, string $itemname, string $tableName, string $className, string $keyName, string $identifierName, string $summaryName = '')
    {
        $moduleDir = basename(dirname(__FILE__, 3));
        $prefixedTable = $db->prefix($tableName);
        parent::__construct($db, $prefixedTable, $keyName, $identifierName, $summaryName, $moduleDir);
        $this->table = $prefixedTable;
        $this->className = $className;
        $this->_moduleName = $moduleDir;
        $this->_modulePath = ICMS_ROOT_PATH . '/modules/' . $moduleDir . '/';
        $this->_moduleUrl = ICMS_URL . '/modules/' . $moduleDir . '/';
        $this->_uploadPath = ICMS_UPLOAD_PATH . '/' . $moduleDir . '/';
        $this->_uploadUrl = ICMS_UPLOAD_URL . '/' . $moduleDir . '/';
    }
}
