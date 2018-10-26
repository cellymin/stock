<?php

class Api_Employee_Delete extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'employeeId' => array('name'    => 'employeeId',
                                      'type'    => 'array',
                                      'format'  => 'explode',
                                      'require' => true
                )
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'employeeId' => '', 'msg' => '');
        if (!is_array($this->employeeId)) {
            $rs['msg'] = '参数错误';
            return $rs;
        }

        $domain = new Domain_Employee_CURD();
        $employeeId = $this->employeeId;
        foreach ($employeeId as $row) {
            $employee = $domain->getForUD($row);
            if (!$employee) {
                $rs['msg'] = '存在不可操作项';
                break;
            }
        }
        if ($rs['msg']) {
            return $rs;
        }

        $id = $domain->delete($this->employeeId);
        if ($id === false) {
            $rs['msg'] = '删除失败';
            return $rs;
        }
        $rs['code'] = 1;
        $rs['employeeId'] = $this->employeeId;

        return $rs;
    }
}