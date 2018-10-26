<?php

/**
 * 编辑部门
 * Class Api_Department_Insert
 */
class Api_Department_Update extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'departmentId'   => array('name' => 'departmentId', 'type' => 'int', 'min' => 1, 'require' => true),
                'departmentName' => array(
                    'name'    => 'departmentName',
                    'type'    => 'string',
                    'min'     => 1,
                    'max'     => 50,
                    'format'  => 'utf8',
                    'require' => true
                ),
                'remark'         => array(
                    'name'    => 'remark',
                    'type'    => 'string',
                    'len'     => 200,
                    'format'  => 'utf8',
                    'require' => true
                ),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'departmentId' => '', 'msg' => '');

        if (DI()->userInfo['userGroup'] != 1) {
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员', 3);
        }

        $departmentDomain = new Domain_Department_CURD();
        $department = $departmentDomain->getForUD($this->departmentId);
        if (!$department) {
            $rs['msg'] = '部门不存在';
            return $rs;
        }

        $input = array(
            'departmentName' => $this->departmentName,
            'remark'         => $this->remark,
        );

        $departmentId = $departmentDomain->update($input, $this->departmentId);
        if ($departmentId === false) {
            $rs['msg'] = '保存失败';

            return $rs;
        }
        $rs['code'] = 1;
        $rs['departmentId'] = $this->departmentId;

        return $rs;
    }
}