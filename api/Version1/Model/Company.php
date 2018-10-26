<?php

class Model_Company extends PhalApi_Model_NotORM
{
    public function getTableName($id) {
        return 'companys';
    }

    public function getTableKey($table) {
        return 'companyId';
    }

    public function delete($id)
    {
        return $this->update($id,array('flag'=>'-1'));
    }

    public function getFields() {
        return 'companyId,companyName,companyTel,companyAddress,companyTel,companyUserName,companyUserPhone,companyUserEmail,companyUserQQ';
    }

    public function getList($start, $page_size, $keyword) {
        $where = 'flag=1 and companyName like ?';
        $param[] = '%' . $keyword . '%';

        $user = DI()->get('userInfo');
        if($user['userGroup']!=1 && $user['selectAll']!=1){
            $where .= ' and companyId=?';
            $param[] = $user['companyId'];
        }

        return DI()->notorm->companys
            ->select($this->getFields())
            ->where($where,$param)
            ->limit($start, $page_size)
            ->fetchAll();
    }

    public function count($keyword) {
        $where = 'flag=1 and companyName like ?';
        $param[] = '%' . $keyword . '%';

        $user = DI()->get('userInfo');
        if($user['userGroup']!=1 && $user['selectAll']!=1){
            $where .= ' and companyId=?';
            $param[] = $user['companyId'];
        }

        return DI()->notorm->companys
            ->select($this->getFields())
            ->where($where, $param)
            ->count();
    }

    public function get($id, $fields = '*') {
        $where = 'companyId=? and flag=1';
        $param[] = $id;
        $user = DI()->get('userInfo');
        if($user['userGroup']!=1 && $user['selectAll']!=1){
            $where .= ' and companyId=?';
            $param[] = $user['companyId'];
        }

        return DI()->notorm->companys
            ->select($this->getFields())
            ->where($where, $param)
            ->fetch();
    }

    public function getForUD($id, $fields = '*'){
        $where = 'companyId=? and flag=1';
        $param[] = $id;

        return DI()->notorm->companys
            ->select($this->getFields())
            ->where($where, $param)
            ->fetch();
    }

    public function getOptions(){
        $where = 'flag=1';
        $param = array();

        $user = DI()->get('userInfo');
        if($user['userGroup']!=1 && $user['selectAll']!=1){
            $where .= ' and companyId=?';
            $param[] = $user['companyId'];

            return DI()->notorm->companys
                ->select('*')
                ->where($where,$param)
                ->fetchAll();
        }

        return DI()->notorm->companys
            ->select('*')
            ->where($where)
            ->fetchAll();
    }
}