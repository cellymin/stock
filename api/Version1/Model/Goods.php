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


    public function get($id, $fields = '*')
    {
        $where = 'flag=1 and goodsId=?';
        $param[] = $id;

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
            $sql .= ' and g.goodsCateId=:goodsCateId ';
            $param[':goodsCateId'] = $goodsCateId;
        }

        $sql .= ' order by g.createTime desc';

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
            . 'g.lastPrice,g.minPrice,g.maxPrice,g.avgPrice,g.productionDate,g.invalidDate,g.searchKey,g.remark '
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
        return $this->getORM()
            ->select('goodsId,goodsName')
            ->where('flag=1 and goodsCateId=?', $goodsCateId)
            ->fetchAll();
    }

}