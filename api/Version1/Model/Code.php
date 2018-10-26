<?php

class Model_Code extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'codes';
    }

    public function getTableKey($table)
    {
        return 'codeId';
    }

    public function getByCode($code)
    {
        return DI()->notorm->codes
            ->select('*')
            ->where('code=? and createUser=?',array($code,DI()->userInfo['userId']))
            ->fetch();
    }

    public function getByUser($userId){
        return DI()->notorm->codes
            ->select('*')
            ->where('createUser=?',$userId)
            ->fetch();
    }
}