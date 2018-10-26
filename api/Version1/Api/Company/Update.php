<?php

/**
 * 新增公司
 * Class Company_Insert
 */
class Api_Company_Update extends PhalApi_Api
{
    public function getRules() {
        return array(
            'go' => array(
                'companyId'        => array('name' => 'companyId', 'type' => 'int', 'min' => 1, 'require' => true),
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
        $rs     = array('code' => 0, 'companyId' => '', 'msg' => '');
        $domain = new Domain_Company_CURD();

        if(DI()->userInfo['userGroup']!=1){
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员',3);
        }

        $company = $domain->getForUD($this->companyId);
        if (!$company) {
            $rs['msg'] = '公司不存在';
            return $rs;
        }

        $input = array();

        $input['companyName']      = $this->companyName;
        $input['companyAddress']   = $this->companyAddress;
        $input['companyTel']       = $this->companyTel;
        $input['companyUserName']  = $this->companyUserName;
        $input['companyUserPhone'] = $this->companyUserPhone;
        $input['companyUserEmail'] = $this->companyUserEmail;
        $input['companyUserQQ']    = $this->companyUserQQ;

        $companyId = $domain->update($this->companyId, $input);

        if ($companyId === false) {
            $rs['msg'] = '保存失败';

            return $rs;
        }

        $rs['code']      = 1;
        $rs['companyId'] = $this->companyId;

        return $rs;
    }
}