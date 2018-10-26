<?php

class Api_Depot_Get extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'depotId' => array('name' => 'depotId', 'type' => 'int', 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $domain = new Domain_Depot_CURD();

        $depot = $domain->get($this->depotId);
        if (!$depot) {
            $rs['msg'] = '仓库不存在';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['content'] = $depot[0];
        return $rs;
    }
}