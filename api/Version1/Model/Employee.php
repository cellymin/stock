<?php

class Model_Employee extends PhalApi_Model_NotORM
{

    public function getTableName($id)
    {
        return 'employees';
    }

    public function getTableKey($table)
    {
        return 'employeeId';
    }

    public function delete($id)
    {
        return $this->update($id, array('flag' => '-1'));
    }

    public function get($id, $fields = '*')
    {
        $sql = 'select e.employeeId,e.companyId,e.departmentId,e.employeeName,e.employeeAddress,'
            . 'e.employeePhone,e.employeeEmail,e.employeeQQ,e.employeeJob,c.companyName,d.departmentName '
            . 'from vich_employees e '
            . 'left join vich_companys c on c.companyId=e.companyId '
            . 'left join vich_departments d on d.departmentId=e.departmentId '
            . 'where e.flag=1 and e.employeeId=:employeeId';
        $param = array(':employeeId' => $id);
        $user = DI()->get('userInfo');
        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
            $sql .= ' and e.companyId=:companyId';
            $param[':companyId'] = $user['companyId'];
        }

        return DI()->notorm->employees->queryAll($sql, $param);
    }

    public function getForUD($id, $fields = '*')
    {
        $sql = 'select e.employeeId,e.companyId,e.departmentId,e.employeeName,e.employeeAddress,'
            . 'e.employeePhone,e.employeeEmail,e.employeeQQ,e.employeeJob,c.companyName,d.departmentName '
            . 'from vich_employees e '
            . 'left join vich_companys c on c.companyId=e.companyId '
            . 'left join vich_departments d on d.departmentId=e.departmentId '
            . 'where e.flag=1 and e.employeeId=:employeeId';
        $param = array(':employeeId' => $id);
        $user = DI()->get('userInfo');

        if ($user['userGroup'] != 1) {
            $sql .= ' and e.companyId=:companyId';
            $param[':companyId'] = $user['companyId'];
        }

        return DI()->notorm->employees->queryAll($sql, $param);
    }

    public function count($keyword, $companyId)
    {
        $where = 'flag=1 and employeeName like :keyword';
        $param = array(':keyword' => '%' . $keyword . '%');

        $user = DI()->get('userInfo');
        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
            $where .= ' and companyId=:companyId';
            $param[':companyId'] = $user['companyId'];
        }else{
            if($companyId){
                $where .= ' and companyId=:companyId';
                $param[':companyId'] = $companyId;
            }
        }
        return DI()->notorm->employees
            ->select('*')
            ->where($where, $param)
            ->count();
    }

    public function getList($start, $page_size, $keyword, $companyId)
    {
        $limit = '';
        if ($page_size) {
            $limit = " limit $start,$page_size";
        }
        $sql = 'select e.employeeId,e.companyId,e.departmentId,e.employeeName,e.employeeAddress,'
            . 'e.employeePhone,e.employeeEmail,e.employeeQQ,e.employeeJob,c.companyName,d.departmentName '
            . 'from vich_employees e '
            . 'left join vich_companys c on c.companyId=e.companyId '
            . 'left join vich_departments d on d.departmentId=e.departmentId '
            . 'where e.flag=1 and e.employeeName like :keyword ';
        $param = array(':keyword' => '%' . $keyword . '%');

        $user = DI()->get('userInfo');
        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
            $sql .= ' and e.companyId=:companyId';
            $param[':companyId'] = $user['companyId'];
        }else{
            if($companyId){
                $sql .= ' and e.companyId=:companyId';
                $param[':companyId'] = $companyId;
            }
        }

        $sql .= $limit;

        return DI()->notorm->employees
            ->queryAll($sql, $param);
    }

    public function getOptins($companyId, $departmentId)
    {
        $where = 'flag=1';

        $param = array();

        if ($departmentId) {
            $where .= ' and departmentId=?';
            $param[] = $departmentId;
        }

        $user = DI()->get('userInfo');
        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
            $where .= ' and companyId=?';
            $param[] = $user['companyId'];
        }else{
            if ($companyId) {
                $where .= ' and companyId=?';
                $param[] = $companyId;
            }
        }

        if ($param) {
            return DI()->notorm->employees
                ->select('*')
                ->where($where, $param)
                ->fetchAll();
        }
        return DI()->notorm->employees
            ->select('*')
            ->where($where)
            ->fetchAll();
    }

    public function getWithDepartmentId($departmentId, $employeeId)
    {
        return DI()->notorm->employees
            ->select('*')
            ->where('departmentId=? and employeeId=?', array($departmentId, $employeeId))
            ->fetch();
    }
}