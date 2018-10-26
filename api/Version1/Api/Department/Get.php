<?php

/**
 * 部门信息
 * Class Company_Insert
 */
class Api_Department_Get extends PhalApi_Api
{
    public function getRules() {
        return array(
            'go' => array(
                'departmentId' => array('name' => 'departmentId', 'type' => 'int', 'min' => 1, 'require' => true),
            )
        );
    }

    public function go() {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_Department_CURD();
        $data   = $domain->get($this->departmentId);
        if ($data) {
            $rs['code']    = 1;
            $rs['content'] = $data;

            return $rs;
        }
        $rs['msg'] = '部门不存在';

        return $rs;
    }
}