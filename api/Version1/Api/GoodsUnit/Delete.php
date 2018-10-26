<?php

class Api_GoodsUnit_Delete extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'unitId' => array('name' => 'unitId', 'type' => 'array', 'format' => 'explode', 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'unitId' => '', 'msg' => '');
        if (!is_array($this->unitId)) {
            $rs['msg'] = '参数错误';
            return $rs;
        }

        if (DI()->userInfo['userGroup'] != 1) {
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员', 0);
        }

        $domain = new Domain_GoodsUnit_CURD();
        $id = $domain->delete($this->unitId);
        if ($id === false) {
            $rs['msg'] = '删除失败';
            return $rs;
        }
        $rs['code'] = 1;
        $rs['unitId'] = $this->unitId;

        return $rs;
    }
}