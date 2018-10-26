<?php

class Model_Department extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'departments';
    }

    public function getTableKey($table)
    {
        return 'departmentId';
    }

    public function delete($id)
    {
        return $this->update($id, array('flag' => '-1'));
    }

    public function getFields()
    {
        return 'departmentId,departmentName,remark';
    }

    public function count($keyword)
    {
        $where = 'flag=1 and departmentName like ?';
        $param[] = '%' . $keyword . '%';

        return DI()->notorm->departments
            ->select('*')
            ->where($where, $param)
            ->count();
    }

    public function getList($start, $page_size, $keyword)
    {
        $where = 'flag=1 and departmentName like ?';
        $param[] = '%' . $keyword . '%';

        return DI()->notorm->departments
            ->select($this->getFields())
            ->where($where, $param)
            ->limit($start, $page_size)
            ->fetchAll();
    }

    public function get($id, $fields = '*')
    {
        $where = 'flag=1 and departmentId=?';
        $param[] = $id;

        return DI()->notorm->departments
            ->select($this->getFields())
            ->where($where, $param)
            ->fetch();
    }

    public function getForUD($id, $fields = '*')
    {
        $where = 'flag=1 and departmentId=?';
        $param[] = $id;

        return DI()->notorm->departments
            ->select($this->getFields())
            ->where($where, $param)
            ->fetch();
    }

    public function getOptions()
    {
        $where = 'flag=1';

        return DI()->notorm->departments
            ->select('*')
            ->where($where)
            ->fetchAll();
    }
}