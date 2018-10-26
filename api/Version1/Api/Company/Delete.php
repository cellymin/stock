<?php

class Api_Company_Delete extends PhalApi_Api
{
    public function getRules() {
        return array(
            'go' => array(
                'companyId' => array('name' => 'companyId', 'type' => 'array', 'format' => 'explode', 'require' => true),
            )
        );
    }

    public function go() {
        $rs = array('code' => 0, 'companyId' => '', 'msg' => '');

        if(DI()->userInfo['userGroup']!=1){
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员',3);
        }

        if(!is_array($this->companyId)){
            $rs['msg'] = '参数错误';
            return $rs;
        }
        $domain = new Domain_Company_CURD();
        $id     = $domain->delete($this->companyId);
        if ($id === false) {
            $rs['msg'] = '删除失败';
            return $rs;
        }

        $rs['code']      = 1;
        $rs['companyId'] = $this->companyId;
        $rs['msg'] = '';
        return $rs;
    }
}