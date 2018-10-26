<?php

class Model_LogDepot extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'logs_depot';
    }

    public function getTableKey($table)
    {
        return 'logId';
    }
}