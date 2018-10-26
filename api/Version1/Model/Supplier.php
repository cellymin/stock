<?php

class Model_Supplier extends PhalApi_Model_NotORM
{
    public function getTableName($id)
    {
        return 'suppliers';
    }

    public function getTableKey($table)
    {
        return 'supplierId';
    }

    public function getFields()
    {
        return 'supplierId,supplierName,supplierAddress,supplierTel,supplierUserName,supplierUserPhone,supplierUserEmail,supplierUserQQ,bankName,bankAccount,bankOpenName,cardUserName,cardUserPhone,cardMoney,remark,reviewer,reviewTime,flag';
    }

    public function fetch($id, $fields = "*")
    {
        return parent::get($id, $fields);
    }

    public function delete($id)
    {
        return $this->update($id, array('flag' => '-1'));
    }

    public function get($id, $fields = "*")
    {
        $where = 'supplierId=? and (flag=1 or flag=0)';
        $param[] = $id;

        $user = DI()->get('userInfo');
        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
            $where .= ' and createCompany=?';
            $param[] = $user['companyId'];
        }

        return DI()->notorm->suppliers
            ->select($this->getFields())
            ->where($where, $param)
            ->fetch();
    }

    public function getForOrder($supplierId)
    {
        $where = 'supplierId=? and flag=1';
        $param[] = $supplierId;

        return DI()->notorm->suppliers
            ->select($this->getFields())
            ->where($where, $param)
            ->fetch();
    }

    public function getForUD($id, $fields = "*")
    {
        $where = 'supplierId=? and (flag=1 or flag=0)';
        $param[] = $id;

        $user = DI()->get('userInfo');
        if ($user['userGroup'] != 1) {
            $where .= ' and createCompany=?';
            $param[] = $user['companyId'];
        }

        return DI()->notorm->suppliers
            ->select($this->getFields())
            ->where($where, $param)
            ->fetch();
    }

    public function count($keyword, $status)
    {
        $where = 'supplierName like :keyword';
        $param = array(':keyword' => '%' . $keyword . '%');

        if ($status) {
            $where .= ' and flag=:status';
            $param[':status'] = ($status - 1);
        } else {
            $where .= ' and (flag=1 or flag=0)';
        }

        $user = DI()->get('userInfo');
        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
            $where .= ' and createCompany=:createCompany';
            $param[':createCompany'] = $user['companyId'];
        }

        return DI()->notorm->suppliers
            ->select('*')
            ->where($where, $param)
            ->count();
    }

    public function getList($start, $page_size, $keyword, $status)
    {
        $where = 'supplierName like :keyword';
        $param = array(':keyword' => '%' . $keyword . '%');

        if ($status) {
            $where .= ' and flag=:status';
            $param[':status'] = ($status - 1);
        } else {
            $where .= ' and (flag=1 or flag=0)';
        }

        $user = DI()->get('userInfo');
        if ($user['userGroup'] != 1 && $user['selectAll'] != 1) {
            $where .= ' and createCompany=:createCompany';
            $param[':createCompany'] = $user['companyId'];
        }

        return DI()->notorm->suppliers
            ->select($this->getFields())
            ->where($where, $param)
            ->limit($start, $page_size)
            ->fetchAll();
    }

    public function getOptions()
    {
        return DI()->notorm->suppliers
            ->select($this->getFields())
            ->where('flag=1')
            ->fetchAll();
    }

    public function getById($id)
    {
        return DI()->notorm->suppliers
            ->select('*')
            ->where('supplierId=? and flag=1', $id)
            ->fetch();
    }

}