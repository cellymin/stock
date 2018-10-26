<?php

class Model_Depot extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'depots';
    }

    public function getTableKey($table)
    {
        return 'depotId';
    }

    public function delete($id)
    {
        $model = new Model_DepotSub();
        $model->hasDepotSubUsing($id);

        return $this->update($id, array('flag' => '-1'));
    }

    public function rmDefault($depotId)
    {
        return DI()->notorm->depots
            ->where('depotId<>?', $depotId)
            ->update(array('isDefault' => 0));
    }

    public function get($id, $fields = '*')
    {
        $sql = 'select d.depotId,d.depotName,d.depotNo,d.employeeId,e.employeeName,d.isDefault,e.companyId,e.departmentId '
            . 'from vich_depots d '
            . 'left join vich_employees e on e.employeeId=d.employeeId '
            . 'where d.depotId=:depotId and d.flag=1';
        $param[':depotId'] = $id;

        return DI()->notorm->depots
            ->queryAll($sql, $param);
    }

    public function getForUD($id, $fields = '*')
    {
        $sql = 'select d.depotId,d.depotName,d.depotNo,d.employeeId,e.employeeName,d.isDefault,e.companyId,e.departmentId '
            . 'from vich_depots d '
            . 'left join vich_employees e on e.employeeId=d.employeeId '
            . 'where d.depotId=:depotId and d.flag=1';
        $param[':depotId'] = $id;

        return DI()->notorm->depots
            ->queryAll($sql, $param);
    }

    public function count($keyword)
    {
        $where = 'flag=1 and depotName like ?';
        $param[] = '%' . $keyword . '%';

        $user = DI()->get('userInfo');
        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
            $where .= ' and createCompany=?';
            $param[] = $user['companyId'];
        }

        return DI()->notorm->depots
            ->select('*')
            ->where($where, $param)
            ->count();
    }

    public function getList()
    {
        $sql = 'select d.depotId,d.depotName,d.depotNo,d.employeeId,e.employeeName,d.isDefault '
            . 'from vich_depots d '
            . 'left join vich_employees e on e.employeeId=d.employeeId '
            . 'where d.flag=1 ';

        return DI()->notorm->depots
            ->queryAll($sql);
    }

    public function getById($id)
    {
        return DI()->notorm->depots
            ->select('*')
            ->where('depotId=? and flag=1', $id)
            ->fetch();
    }

    public function getForOptions()
    {
        return DI()->notorm->depots
            ->select('*')
            ->where('flag=1')
            ->fetchAll();
    }
}