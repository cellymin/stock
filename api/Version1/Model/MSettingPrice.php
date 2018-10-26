<?php

class Model_MSettingPrice extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'msetting_price';
    }

    public function getTableKey($table)
    {
        return 'id';
    }

    public static function searchPriceSetting($companyId,$goodsId){
        return DI()->notorm->msetting_price
            ->select('*')
            ->where('createCompany=? and goodsId=? and flag=1',array($companyId,$goodsId))
            ->fetch();
    }
}