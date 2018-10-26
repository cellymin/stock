<?php

class Model_GoodsUnit extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'goods_units';
    }

    public function getTableKey($table)
    {
        return 'unitId';
    }

    public function delete($id)
    {
        return $this->update($id, array('flag' => '-1'));
    }

    public function count($keyword)
    {
        $where = 'flag=1 and unitName like ?';
        $param[] = '%' . $keyword . '%';

        return DI()->notorm->goods_units
            ->select('*')
            ->where($where, $param)
            ->count();
    }

    public function getList($start, $page_size, $keyword)
    {
        $where = 'flag=1 and unitName like ?';
        $param[] = '%' . $keyword . '%';

        return DI()->notorm->goods_units
            ->select('unitId,unitName,unitNo')
            ->where($where, $param)
            ->limit($start, $page_size)
            ->fetchAll();
    }

    public function getOptions()
    {
        return DI()->notorm->goods_units
            ->select('unitId,unitName,unitNo')
            ->where('flag=1')
            ->fetchAll();
    }

    public function get($id, $fields = '*')
    {
        $where = 'flag=1 and unitId=?';
        $param[] = $id;

        return DI()->notorm->goods_units
            ->select($fields)
            ->where($where, $param)
            ->fetch();
    }

    public function getForUD($id, $fields = '*')
    {
        $where = 'flag=1 and unitId=?';
        $param[] = $id;

        return DI()->notorm->goods_units
            ->select($fields)
            ->where($where, $param)
            ->fetch();
    }

}