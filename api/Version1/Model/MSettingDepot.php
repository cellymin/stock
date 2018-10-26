<?php

class Model_MSettingDepot extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'msetting_depot';
    }

    public function getTableKey($table)
    {
        return 'id';
    }

    public static function searchDepotSetting($companyId){
        $sql = 'select msd.*,ds.depotSubName,g.goodsName '
            . 'from vich_msetting_depot msd '
            . 'left join vich_depot_subs ds on ds.depotSubId=msd.depotSubId '
            . 'left join vich_goods g on g.goodsId=msd.goodsId '
            . 'where msd.flag=1 and msd.createCompany=:companyId ';

        $param[':companyId'] = $companyId;

        return DI()->notorm->msetting_depot
            ->queryAll($sql, $param);
    }
}