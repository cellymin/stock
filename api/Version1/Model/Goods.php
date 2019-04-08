<?php

class Model_Goods extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'goods';
    }

    public function getTableKey($table)
    {
        return 'goodsId';
    }

    public function delete($id)
    {
        return $this->update($id, array('flag' => '-1'));
    }

    public function fetch($id, $fields = "*")
    {
        return parent::get($id, $fields);
    }

    public function add($data, $code)
    {
        try {
            DI()->notorm->beginTransaction('db_demo');

            $id = DI()->notorm->goods->insert($data);
            DI()->notorm->codes->where('code', $code)->delete();

            DI()->notorm->commit('db_demo');

            return $id;
        } catch (PDOException $e) {
            DI()->notorm->rollback('db_demo');
            return false;
        }
    }

    public function count($keyword, $goodsCateId)
    {
        $where = 'flag=1 and (goodsBarCode like :keyword or searchKey like :keyword or goodsName like :keyword or goodsSn like :keyword)';
        $param = array(':keyword' => '%' . $keyword . '%');

        if ($goodsCateId) {
            $where .= ' and (goodsCateId=:goodsCateId or goodsCateId1=:goodsCateId or goodsCateId2=:goodsCateId)';
            $param[':goodsCateId'] = $goodsCateId;
        }

        return DI()->notorm->goods
            ->select('*')
            ->where($where, $param)
            ->count();
    }

    public function countRequest($keyword,$status){
        $where = 'WHERE rg.flag!=-1 AND (goodsBarCode LIKE :keyword OR searchKey LIKE :keyword OR goodsName LIKE :keyword OR goodsSn LIKE :keyword)';
        $param = array(':keyword' => '%' . $keyword . '%');
        $param[':status'] = $status;
        if($status ==0 || $status ==1) {
            $where .= " AND rg.flag=:status ";
        }
        $sql = "SELECT count(og.goodsId) as count FROM vich_request_goods rg JOIN vich_goods og ON rg.goodsId = og.goodsId ".$where;
        return DI()->notorm->goods->queryAll($sql, $param);
    }

    public  function getRequestList($start,$page_size,$keyword,$status){

        if ($page_size) {
            $limit = " limit $start,$page_size";
        }
        $where = 'WHERE rg.flag!=-1 AND (goodsBarCode LIKE :keyword OR searchKey LIKE :keyword OR goodsName LIKE :keyword OR goodsSn LIKE :keyword)  ';
        $param = array(':keyword' => '%' . $keyword . '%');
        $param[':status'] = $status;
        if($status ==0 || $status ==1) {
            $where .= " AND rg.flag=:status ";
        }
        $where .= ' order by og.goodsSn asc,rg.createTime desc ';
        $sql = 'SELECT og.goodsId,og.goodsName,og.goodsSn,dp.depotName,rg.goodsCnt,rg.createTime,
               (case rg.flag when 0 then "未处理" when 1 then "已处理" when -1 then "已失效" end) as status,og.lastPrice
                FROM vich_request_goods rg 
                INNER JOIN vich_goods og ON rg.goodsId = og.goodsId
                LEFT join vich_depots as dp on rg.depotId=dp.depotId
                '.$where.$limit;

        $requestList = DI()->notorm->goods->queryAll($sql, $param);
        $newlist = array();
        foreach ($requestList as $kk){
            $sqlids = 'SELECT sp.supplierName,sp.taxrate,ig.usecostpri,ig.goodsPrice FROM vich_orders_ip ip
                       LEFT JOIN vich_orders_ip_goods ig ON ip.orderId = ig.orderId
                       LEFT JOIN vich_suppliers sp ON ip.supplierId = sp.supplierId
                       WHERE ig.goodsId = '.$kk['goodsId'].' ORDER BY ip.createTime DESC LIMIT 1';
            $supplierName =  DI()->notorm->goods->queryAll($sqlids);
            $newlist[$kk['goodsId']]=$kk;
            $newlist[$kk['goodsId']]['suppliername'] = $supplierName[0]['supplierName'];
            $newlist[$kk['goodsId']]['usecostpri'] = $supplierName[0]['usecostpri'];
            $newlist[$kk['goodsId']]['goodsPrice'] = $supplierName[0]['goodsPrice'];
            if(floatval($supplierName[0]['usecostpri'])>0 && floatval($supplierName[0]['taxrate'])>0){
                $newlist[$kk['goodsId']]['lastratepri'] = $supplierName[0]['usecostpri'] * (1+floatval($supplierName[0]['taxrate']));
            }
            unset($supplierName);
        }
    return $newlist;
    }
    public function get($id, $fields = '*')
    {
        $where = 'flag=1 and goodsId=?';
        $param[] = $id;

        return DI()->notorm->goods
            ->select($fields)
            ->where($where, $param)
            ->fetch();
    }
    public function getInfo($goodsBarCode, $fields = '*')
    {
        $where = 'flag=1 and goodsBarCode=?';
        $param[] = $goodsBarCode;

        return DI()->notorm->goods
            ->select($fields)
            ->where($where, $param)
            ->fetch();
    }
    public function getForOrder($id, $fields = '*')
    {
        $where = 'flag=1 and goodsId=?';
        $param[] = $id;

        return DI()->notorm->goods
            ->select($fields)
            ->where($where, $param)
            ->fetch();
    }

    public function getForUD($id, $fields = '*')
    {
        $where = 'flag=1 and goodsId=?';
        $param[] = $id;

        return DI()->notorm->goods
            ->select($fields)
            ->where($where, $param)
            ->fetch();
    }


    public function getList($start, $page_size, $keyword, $goodsCateId)
    {
        $limit = '';
        if ($page_size) {
            $limit = " limit $start,$page_size";
        }

        $sql = 'select g.goodsId,g.goodsSn,g.goodsBarCode,g.goodsName,g.goodsSpec,g.goodsCateId,c.cateName,g.goodsUnitId,u.unitName,'
            . 'g.lastPrice,g.minPrice,g.maxPrice,g.avgPrice,g.productionDate,g.invalidDate,g.searchKey,g.remark '
            . 'from vich_goods g '
            . 'left join vich_goods_cates c on c.cateId=g.goodsCateId '
            . 'left join vich_goods_units u on u.unitId=g.goodsUnitId '
            . 'where g.flag=1 and (g.goodsBarCode like :keyword or g.searchKey like :keyword or g.goodsName like :keyword or g.goodsSn like :keyword) ';
        $param = array(':keyword' => '%' . $keyword . '%');

        if ($goodsCateId) {
            $sql .= ' and (goodsCateId=:goodsCateId or goodsCateId1=:goodsCateId or goodsCateId2=:goodsCateId) ';
            $param[':goodsCateId'] = $goodsCateId;
        }

        $sql .= ' order by g.goodsSn asc,g.createTime desc';

        $sql .= $limit;

        return DI()->notorm->goods->queryAll($sql, $param);
    }

    public function listAll($start, $page_size, $keyword, $goodsCateId)
    {
        $limit = '';
        if ($page_size) {
            $limit = " limit $start,$page_size";
        }

        $sql = 'select g.goodsId,g.goodsSn,g.goodsBarCode,g.goodsName,g.goodsSpec,g.goodsCateId,c.cateName,g.goodsUnitId,u.unitName,'
            . 'g.lastPrice,g.minPrice,g.maxPrice,g.avgPrice,g.productionDate,g.invalidDate,g.searchKey,g.remark,g.usecostpri '
            . 'from vich_goods g '
            . 'left join vich_goods_cates c on c.cateId=g.goodsCateId '
            . 'left join vich_goods_units u on u.unitId=g.goodsUnitId '
            . 'where g.flag=1 and (g.goodsBarCode like :keyword or g.searchKey like :keyword or g.goodsName like :keyword or g.goodsSn like :keyword) ';
        $param = array(':keyword' => '%' . $keyword . '%');

        if ($goodsCateId) {
            $sql .= ' and (g.goodsCateId=:goodsCateId or g.goodsCateId1=:goodsCateId or g.goodsCateId2=:goodsCateId) ';
            $param[':goodsCateId'] = $goodsCateId;
        }

        $sql .= $limit;

        return DI()->notorm->goods->queryAll($sql, $param);
    }


    public function countHistoryPo($supplierId, $goodsId)
    {
        $sql = 'select count("*") as `count` '
            . 'from vich_orders_ip_goods og '
            . 'left join vich_orders_ip o on o.orderId=og.orderId '
            . 'left join vich_suppliers s on s.supplierId=og.supplierId '
            . 'where og.goodsId=:goodsId and o.flag=3';
        $param[':goodsId'] = $goodsId;

        if ($supplierId) {
            $sql .= ' and og.supplierId=:supplierId';
            $param[':supplierId'] = $supplierId;
        }

        return $this->getORM()->queryAll($sql, $param);
    }

    public function getHistoryPo($start, $page_size, $goodsId, $supplierId, $sortType)
    {
        $sql = 'select s.supplierName,s.supplierTel,og.goodsCnt,o.createTime,og.goodsPrice '
            . 'from vich_orders_ip_goods og '
            . 'left join vich_orders_ip o on o.orderId=og.orderId '
            . 'left join vich_suppliers s on s.supplierId=og.supplierId '
            . 'where og.goodsId=:goodsId and o.flag=3';

        $param[':goodsId'] = $goodsId;

        if ($supplierId) {
            $sql .= ' and og.supplierId=:supplierId';
            $param[':supplierId'] = $supplierId;
        }

        $sql .= " order by og.goodsPrice $sortType";

        if ($page_size) {
            $sql .= " limit $start,$page_size";
        }


        return $this->getORM()->queryAll($sql, $param);
    }

    public function getTotalPoPrice($goodsId)
    {
        $sql = 'select sum(og.goodsPrice) as `totalMoney`,count(*) as `count` from vich_orders_ip_goods og
                left join vich_orders_ip o on o.orderId=og.orderId
                where o.flag=3 and og.goodsId=:goodsId';

        $param[':goodsId'] = $goodsId;

        return DI()->notorm->orders_ip_goods->queryAll($sql, $param);
    }

    public function options($goodsCateId)
    {
//        判断是否是顶级分类
        $param[':goodsCateId'] = $goodsCateId;
        $sql='select * from vich_goods_cates where cateId=:goodsCateId and parentId=0';
        $istop=DI()->notorm->goods_cates->queryAll($sql,$param);
//        如果是，则通过goodsCateId1来查询商品
        if ($istop){
            $sql = 'select goodsId,goodsName from vich_goods where flag=1 and goodsCateId1=:goodsCateId';
            $result=DI()->notorm->goods->queryAll($sql,$param);
        }else{
//            不是则通过goodsCateId2来查询商品
            $sql = 'select goodsId,goodsName from vich_goods where flag=1 and goodsCateId2=:goodsCateId';
            $result=DI()->notorm->goods->queryAll($sql,$param);
        }
        return $result;
    }

}