<?php

/**
 * 获取员工信息
 * Class Api_Employee_Get
 */
class Api_Employee_Get extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'employeeId' => array('name' => 'employeeId', 'type' => 'int', 'min' => 1, 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $domain = new Domain_Employee_CURD();
        $employee = $domain->get($this->employeeId);
        if (!$employee) {
            $rs['msg'] = '不能操作该员工';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['content'] = $employee[0];

        return $rs;
    }
}