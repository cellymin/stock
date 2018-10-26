<?php

class Api_Department_Delete extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'departmentId' => array('name' => 'departmentId', 'type' => 'array', 'format' => 'explode', 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'departmentId' => '', 'msg' => '');

        if(DI()->userInfo['userGroup']!=1){
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员',3);
        }

        if (!is_array($this->departmentId)) {
            $rs['msg'] = '参数错误';
            return $rs;
        }

        $domain = new Domain_Department_CURD();
        $id = $domain->delete($this->departmentId);
        if ($id === false) {
            $rs['msg'] = '删除失败';

            return $rs;
        }

        $rs['code'] = 1;
        $rs['departmentId'] = $this->departmentId;
        $rs['msg'] = '';

        return $rs;
    }
}