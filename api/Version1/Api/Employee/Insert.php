<?php

/**
 * 新增员工
 * Class Api_Employee_Insert
 */
class Api_Employee_Insert extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'companyId'       => array('name' => 'companyId', 'type' => 'int', 'min' => 1, 'require' => true),
                'departmentId'    => array('name' => 'departmentId', 'type' => 'int', 'min' => 1, 'require' => true),
                'employeeName'    => array('name' => 'employeeName', 'type' => 'name', 'require' => true),
                'employeeAddress' => array('name' => 'employeeAddress', 'type' => 'string', 'require' => true),
                'employeePhone'   => array('name' => 'employeePhone', 'type' => 'phone', 'require' => true),
                'employeeEmail'   => array('name' => 'employeeEmail', 'type' => 'email', 'require' => true),
                'employeeQQ'      => array('name' => 'employeeQQ', 'type' => 'string', 'require' => false),
                'employeeJob'     => array('name' => 'employeeJob', 'type' => 'string', 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'employeeId' => '', 'msg' => '');

        $companyDomain = new Domain_Company_CURD();
        $company = $companyDomain->getForUD($this->companyId);
        if (!$company) {
            $rs['msg'] = '公司不存在';
            return $rs;
        }
        if (DI()->userInfo['userGroup'] != 1 && $company['companyId'] != DI()->userInfo['companyId']) {
            $rs['msg'] = '没有权限,不能为该公司添加员工';
            return $rs;
        }

        $departmentDomain = new Domain_Department_CURD();
        $department = $departmentDomain->get($this->departmentId);
        if (!$department) {
            $rs['msg'] = '部门不存在';

            return $rs;
        }

        $input = array(
            'companyId'       => $this->companyId,
            'departmentId'    => $this->departmentId,
            'employeeName'    => $this->employeeName,
            'employeeAddress' => $this->employeeAddress,
            'employeePhone'   => $this->employeePhone,
            'employeeEmail'   => $this->employeeEmail,
            'employeeQQ'      => $this->employeeQQ,
            'employeeJob'     => $this->employeeJob,
            'flag'            => 1,
            'createCompany'   => DI()->userInfo['companyId'],
            'createUser'      => DI()->userInfo['userId'],
            'createTime'      => date('Y-m-d H:i:s'),
        );


        $domain = new Domain_Employee_CURD();

        $employeeId = $domain->insert($input);
        if ($employeeId === false) {
            $rs['msg'] = '保存失败';

            return $rs;
        }

        $rs['code'] = 1;
        $rs['employeeId'] = $employeeId;

        return $rs;
    }
}