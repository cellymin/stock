<?php

class Model_Customer extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'customers';
    }

    public function getTableKey($table)
    {
        return 'customerId';
    }

    public function delete($id)
    {
        return $this->update($id, array('flag' => '-1'));
    }

    public function get($id, $fields = '*')
    {
        $where = 'flag=1 and customerId=?';
        $param[] = $id;

//        $user = DI()->get('userInfo');
//        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
//            $where .= ' and createCompany=?';
//            $param[] = $user['companyId'];
//        }

        return DI()->notorm->customers
            ->select($fields)
            ->where($where, $param)
            ->fetch();
    }

    public function getForUD($id, $fields = '*')
    {
        $where = 'flag=1 and customerId=?';
        $param[] = $id;

        $user = DI()->get('userInfo');
        if ($user['userGroup'] != 1) {
            throw new PhalApi_Exception_BadRequest('你不是管理员', 0);
        }

        return DI()->notorm->customers
            ->select($fields)
            ->where($where, $param)
            ->fetch();
    }

    public function count($keyword)
    {
        $where = 'flag=1 and customerName like ?';
        $param[] = '%' . $keyword . '%';

//        $user = DI()->get('userInfo');
//        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
//            $where .= ' and createCompany=?';
//            $param[] = $user['companyId'];
//        }

        return DI()->notorm->customers
            ->select('*')
            ->where($where, $param)
            ->count();
    }

    public function getList($start, $page_size, $keyword)
    {
        $where = 'flag=1 and customerName like ?';
        $param[] = '%' . $keyword . '%';

//        $user = DI()->get('userInfo');
//        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
//            $where .= ' and createCompany=?';
//            $param[] = $user['companyId'];
//        }

        return DI()->notorm->customers
            ->select('*')
            ->where($where, $param)
            ->limit($start, $page_size)
            ->fetchAll();
    }

    public function listAll(){
        return DI()->notorm->customers
            ->select('*')
            ->where('flag=1')
            ->fetchAll();
    }
}