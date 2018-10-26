<?php

/**
 * 新增部门
 * Class Api_Department_Insert
 */
class Api_Department_Insert extends PhalApi_Api
{
    public function getRules() {
        return array(
            'go' => array(
                'departmentName' => array('name' => 'departmentName', 'type' => 'string', 'min' => 1, 'max' => 50, 'format' => 'utf8', 'require' => true),
                'remark'         => array('name' => 'remark', 'type' => 'string', 'len' => 200, 'format' => 'utf8', 'require' => true),
            )
        );
    }

    public function go() {
        $rs = array('code' => 0, 'departmentId' => '', 'msg' => '');

        if(DI()->userInfo['userGroup']!=1){
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员',3);
        }

        $input = array(
            'departmentName' => $this->departmentName,
            'remark'         => $this->remark,
            'flag'           => 1,
            'createCompany'  => DI()->userInfo['companyId'],
            'createUser'     => DI()->userInfo['userId'],
            'createTime'     => date('Y-m-d H:i:s'),
        );

        $departmentDomain = new Domain_Department_CURD();

        $departmentId = $departmentDomain->insert($input);
        if ($departmentId === false) {
            $rs['msg'] = '保存失败';

            return $rs;
        }
        $rs['code']         = 1;
        $rs['departmentId'] = $departmentId;

        return $rs;
    }
}