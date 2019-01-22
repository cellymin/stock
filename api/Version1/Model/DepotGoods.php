<?php

class Model_DepotGoods extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'depot_goods'; // TODO: Change the autogenerated stub
    }

    public function getTableKey($table)
    {
        return 'id'; // TODO: Change the autogenerated stub
    }


    //多条插入
    public function insert_multi($data)
    {
        return $this->getORM()->insert_multi($data);
    }

    public function count($keyword, $depotId, $depotSubId,$type)
    {
        $sql = 'select count(*) as `count` '
            . 'from vich_depot_goods dg '
            . 'left join vich_goods g on g.goodsId=dg.goodsId '
            . 'left join vich_depots d on d.depotId=dg.depotId '
            . 'left join vich_depot_subs ds on ds.depotSubId=dg.depotSubId '
            . 'where (g.goodsName like :keyword or dg.batchNo like :keyword) and dg.flag=1 ';

        $param = array();
        $param[':keyword'] = "%$keyword%";


        if ($depotId) {
            $sql .= ' and dg.depotId=:depotId';
            $param[':depotId'] = $depotId;
        }

        if ($depotSubId) {
            $sql .= ' and dg.depotSubId=:depotSubId';
            $param[':depotSubId'] = $depotSubId;
        }

        if ($type!='INVENTORY') {
            $sql .= ' and dg.goodsCnt>0';
        }

        if (DI()->userInfo['userGroup'] != 1 && DI()->userInfo['selectAll'] != 1) {
            $sql .= ' and ds.companyId=:companyId';
            $param[':companyId'] = DI()->userInfo['companyId'];
        }


        return $this->getORM()->queryAll($sql, $param);
    }

    public function getList($start, $page_size, $keyword, $depotId, $depotSubId, $type)
    {
        $limit = "";
        if ($page_size) {
            $limit = " limit $start,$page_size";
        }
        $sql = 'select dg.*,d.depotName,ds.depotSubName,g.goodsName '
            . 'from vich_depot_goods dg '
            . 'left join vich_goods g on g.goodsId=dg.goodsId '
            . 'left join vich_depots d on d.depotId=dg.depotId '
            . 'left join vich_depot_subs ds on ds.depotSubId=dg.depotSubId '
            . 'where (g.goodsName like :keyword or dg.batchNo like :keyword or g.goodsSn like :keyword) and dg.flag=1  ';

        $param = array();
        $param[':keyword'] = "%$keyword%";

        if ($depotId) {
            $sql .= ' and dg.depotId=:depotId';
            $param[':depotId'] = $depotId;
        }

        if ($depotSubId) {
            $sql .= ' and dg.depotSubId=:depotSubId';
            $param[':depotSubId'] = $depotSubId;
        }
        if ($type!='INVENTORY') {
            $sql .= ' and dg.goodsCnt>0';
        }

        if (DI()->userInfo['userGroup'] != 1 && DI()->userInfo['selectAll'] != 1) {
            $sql .= ' and ds.companyId=:companyId';
            $param[':companyId'] = DI()->userInfo['companyId'];
        }

        $sql .= $limit;

        return $this->getORM()->queryAll($sql, $param);
    }

    public function listAll($depotSubId)
    {

        $sql = 'select dg.batchNo,dg.goodsCnt,g.goodsName '
            . 'from vich_depot_goods dg '
            . 'left join vich_goods g on g.goodsId=dg.goodsId '
            . 'where dg.depotSubId=:depotSubId ';

        $param[':depotSubId'] = $depotSubId;

        return $this->getORM()->queryAll($sql, $param);
    }

    public function hasDepotGoods($depotSubId)
    {
        $count = $this->getORM()->select('*')
            ->where('flag=1 and goodsCnt>0 and depotSubId=?', $depotSubId)
            ->count();
        if ($count) {
            throw new PhalApi_Exception_BadRequest('库位存在未出库的产品', 0);
        }
    }

    public static function sumCompanyDepotGoods($companyId,$depotSubId,$goodsId){
        return DI()->notorm->depot_goods
            ->where('flag=1 and createCompany=? and depotSubId=? and goodsId=?',array($companyId,$depotSubId,$goodsId
            ))->sum('goodsCnt');
    }

    public function getInfo($goodsid,$depotid){
//        return 132;
//        $sql='select goodsPrice,sum(goodsCnt) as sumCnt from vich_depot_goods where goodsId=:goodsId and depotId=:depotId';
//        $param[':goodsId']=$goodsid;
//        $param[':depotId']=$depotid;
//        return $depotid;
        return DI()->notorm->depot_goods
            ->select('goodsPrice,sum(goodsCnt) as sumCnt')
            ->where('goodsId',$goodsid)->where('depotId',$depotid)->fetchAll();
//        return $this->getORM()->queryAll($sql, $param);

    }
}