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
        $sql = 'select msd.*,dp.depotName,g.goodsName '
            . 'from vich_msetting_depot msd '
            . 'left join vich_depots dp on dp.depotId=msd.depotId '
            . 'left join vich_goods g on g.goodsId=msd.goodsId '
            . 'where msd.flag=1 and msd.createCompany=:companyId ';

        $param[':companyId'] = $companyId;

        return DI()->notorm->msetting_depot
            ->queryAll($sql, $param);
    }
    public static function searchDepotGoodsSetting($companyId,$goodsId,$depotId){
        $sql = 'select msd.*,dp.depotName,g.goodsName '
            . 'from vich_msetting_depot msd '
            . 'left join vich_depots dp on dp.depotId=msd.depotId '
            . 'left join vich_goods g on g.goodsId=msd.goodsId '
            . "where msd.flag=1 and msd.createCompany=:companyId and msd.depotId=:depotId and msd.goodsId=:goodsId ";

        $param[':companyId'] = $companyId;
        $param[':goodsId'] = $goodsId;
        $param[':depotId'] = $depotId;
        return DI()->notorm->msetting_depot
            ->queryAll($sql, $param);
    }

}