<?php

class Api_Depot_Insert extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'depotName' => array('name' => 'depotName', 'type' => 'string', 'require' => true),
                'depotNo' => array('name' => 'depotNo', 'type' => 'string', 'require' => true),
                'employeeId' => array('name' => 'employeeId', 'type' => 'int','min'=>0, 'require' => true),
                'isDefault' => array('name' => 'isDefault', 'type' => 'int','min'=>0, 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'depotId' => '', 'msg' => '');

        if (DI()->userInfo['userGroup'] != 1) {
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员', 0);
        }

        if(!preg_match('/^[a-zA-Z0-9]*$/',$this->depotNo)){
            throw new PhalApi_Exception_BadRequest('仓库编码不符合规则', 0);
        }

        $domain = new Domain_Employee_CURD();
        $employee = $domain->getForUD($this->employeeId);
        if(!$employee){
            $rs['msg'] = '不能选择此员工';
            return $rs;
        }

        $domain = new Domain_Depot_CURD();

        $input = array();
        $input['depotName'] = $this->depotName;
        $input['depotNo'] = $this->depotNo;
        $input['employeeId'] = $this->employeeId;
        $input['isDefault'] = $this->isDefault;
        $input['companyId'] = 0;
        $input['flag'] = 1;
        $input['createCompany'] = DI()->userInfo['companyId'];
        $input['createUser'] = DI()->userInfo['userId'];
        $input['createTime'] = date('Y-m-d H:i:s');

        $depotId = $domain->insert($input);
        if ($depotId === false) {
            $rs['msg'] = '保存失败';
            return $rs;
        }

        if($this->isDefault==1){
            //修改默认仓库
            $domain->rmDefault($depotId);
        }

        $rs['code'] = 1;
        $rs['depotId'] = $depotId;
        return $rs;
    }
}