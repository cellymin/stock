<?php

class Model_Message extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'messages';
    }

    public function getTableKey($table)
    {
        return 'messageId';
    }

    public function invoiceMsgExists($invoiceId){
        return $this->getORM()
            ->select('*')
            ->where('targetId=? and type=3 where to_days(createTime)=to_days(now())',array($invoiceId))
            ->fetch();
    }
}