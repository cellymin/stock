<?php

class Model_GoodsCate extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'goods_cates';
    }

    public function getTableKey($table)
    {
        return 'cateId';
    }

    public function delete($id)
    {
        return $this->update($id, array('flag' => '-1'));
    }

    public function get($id, $fields = '*')
    {
        $where = 'flag=1 and cateId=?';
        $param[] = $id;

        return DI()->notorm->goods_cates
            ->select('cateId,ppid,parentId,cateName,cateSort,cateNo')
            ->where($where, $param)
            ->fetch();
    }

    public function getForUD($id, $fields = '*')
    {
        $where = 'flag=1 and cateId=?';
        $param[] = $id;

        return DI()->notorm->goods_cates
            ->select('cateId,ppid,parentId,cateName,cateSort,cateNo')
            ->where($where, $param)
            ->fetch();
    }

    public function getChildIds($parentId)
    {
        return DI()->notorm->goods_cates
            ->select('group_concat(cateId) as `ids`')
            ->where('flag=1 and parentId=?', $parentId)
            ->fetch();
    }


    public function getList($parentId = 0)
    {
        $where = 'flag=1 and parentId=?';
        $param[] = $parentId;

        return DI()->notorm->goods_cates
            ->select('cateId,ppid,parentId,cateName,cateSort,cateNo')
            ->where($where, $param)
            ->order('cateSort asc')
            ->fetchAll();
    }

    public function getByCateNo($cateNo)
    {
        return $this->getORM()
            ->select('*')
            ->where('flag=1 and cateNo=?', $cateNo)
            ->fetch();
    }
}