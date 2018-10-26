<?php

class Api_DepotSub_Delete extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'depotSubId' => array('name' => 'depotSubId', 'type' => 'array', 'format' => 'explode', 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'depotSubId' => '', 'msg' => '');

        if (DI()->userInfo['userGroup'] != 1) {
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员', 0);
        }

        $depotSubId = $this->depotSubId;

        $domain = new Domain_DepotSub_CURD();

        $id = $domain->delete($depotSubId);
        if ($id === false) {
            $rs['msg'] = '删除失败';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['depotSubId'] = $depotSubId;

        return $rs;
    }


}
