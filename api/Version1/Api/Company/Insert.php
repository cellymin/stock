<?php

/**
 * 新增公司
 * Class Company_Insert
 */
class Api_Company_Insert extends PhalApi_Api
{
    public function getRules() {
        return array(
            'go' => array(
                'companyName'      => array('name' => 'companyName', 'type' => 'string','min' => 1, 'max' => 50, 'format' => 'utf8', 'require' => true),
                'companyAddress'   => array('name' => 'companyAddress', 'type' => 'string', 'require' => true),
                'companyTel'       => array('name' => 'companyTel', 'type' => 'tel', 'require' => false),
                'companyUserName'  => array('name' => 'companyUserName', 'type' => 'name', 'require' => true),
                'companyUserPhone' => array('name' => 'companyUserPhone', 'type' => 'phone', 'require' => true),
                'companyUserEmail' => array('name' => 'companyUserEmail', 'type' => 'email', 'require' => true),
                'companyUserQQ'    => array('name' => 'companyUserQQ', 'type' => 'string', 'require' => false),
            )
        );
    }

    public function go() {
        $rs    = array('code' => 0, 'companyId' => '', 'msg' => '');

        if(DI()->userInfo['userGroup']!=1){
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员',3);
        }

        $input = array();

        $input['companyName']      = $this->companyName;
        $input['companyAddress']   = $this->companyAddress;
        $input['companyTel']       = $this->companyTel;
        $input['companyUserName']  = $this->companyUserName;
        $input['companyUserPhone'] = $this->companyUserPhone;
        $input['companyUserEmail'] = $this->companyUserEmail;
        $input['companyUserQQ']    = $this->companyUserQQ;
        $input['flag']             = 1;
        $input['createUser']       = DI()->userInfo['userId'];
        $input['createCompany']    = DI()->userInfo['companyId'];
        $input['createTime']       = date('Y-m-d H:i:s');

        $domain    = new Domain_Company_CURD();
        $companyId = $domain->insert($input);

        if ($companyId === false) {
            $rs['msg'] = '保存失败';

            return $rs;
        }

        $rs['code']      = 1;
        $rs['companyId'] = $companyId;

        return $rs;
    }
}