<?php

class Model_DepotSub extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'depot_subs';
    }

    public function getTableKey($table)
    {
        return 'depotSubId';
    }

    public function getFields()
    {
        return 'depotSubId,depotId,depotSubName,depotSubNo,companyId';
    }

    public function delete($id)
    {
        $model = new Model_DepotGoods();
        $model->hasDepotGoods($id);

        return $this->update($id, array('flag' => '-1'));
    }

    public function fetch($id, $fields = "*")
    {
        return parent::get($id, $fields);
    }

    public function get($id, $fields = '*')
    {
        $where = 'flag=1 and depotSubId=?';
        $param[] = $id;

        $user = DI()->get('userInfo');
        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
            $where .= ' and companyId=? ';
            $param[] = $user['companyId'];
        }

        return DI()->notorm->depot_subs
            ->select($this->getFields())
            ->where($where, $param)
            ->fetch();
    }

    public function getForUD($id, $fields = '*')
    {
        $where = 'flag=1 and depotSubId=?';
        $param[] = $id;

        $user = DI()->get('userInfo');
        if ($user['userGroup'] != 1) {
            $where .= ' and companyId=? ';
            $param[] = $user['companyId'];
        }

        return DI()->notorm->depot_subs
            ->select($this->getFields())
            ->where($where, $param)
            ->fetch();
    }

    public function getList($depotId)
    {
        $where = 'flag=1 and depotId=?';
        $param[] = $depotId;

        $user = DI()->get('userInfo');
        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
            $where .= ' and companyId=? ';
            $param[] = $user['companyId'];
        }

        return DI()->notorm->depot_subs
            ->select($this->getFields())
            ->where($where, $param)
            ->fetchAll();
    }

    public function getByIdAndDepotId($depotId, $depotSubId)
    {
        return DI()->notorm->depot_subs
            ->select('*')
            ->where('depotId=? and depotSubId=? and flag=1', array($depotId, $depotSubId))
            ->fetch();
    }

    public function getForOptions($depotId)
    {
        $where = 'flag=1 and depotId=?';
        $param[] = $depotId;

        $user = DI()->get('userInfo');
        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
            $where .= ' and companyId=? ';
            $param[] = $user['companyId'];
        }

        return DI()->notorm->depot_subs
            ->select($this->getFields())
            ->where($where, $param)
            ->fetchAll();
    }

    public function hasDepotSubUsing($depotId)
    {
        $count = $this->getORM()
            ->select('*')
            ->where('flag=1 and depotId=?', $depotId)
            ->count();
        if ($count) {
            throw new PhalApi_Exception_BadRequest('存在使用中的库位', 0);
        }

        return $count;
    }

    public static function getName($depotSubId){
        return DI()->notorm
            ->depot_subs
            ->select('depotSubName')
            ->where('flag=1 and depotSubId=?',$depotSubId)
            ->fetch('depotSubName');
    }
}