<?php

class Api_Depot_Delete extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'depotId' => array('name' => 'depotId', 'type' => 'int', 'min' => 0, 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'depotId' => '', 'msg' => '');

        if (DI()->userInfo['userGroup'] != 1) {
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员', 0);
        }

        $depotId = $this->depotId;

        $domain = new Domain_Depot_CURD();
        $depot = $domain->getForUD($depotId);
        if (!$depot) {
            $rs['msg'] = '没有权限';
            return $rs;
        }

        $id = $domain->delete($depotId);
        if ($id === false) {
            $rs['msg'] = '删除失败';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['depotId'] = $depotId;

        return $rs;
    }


}
