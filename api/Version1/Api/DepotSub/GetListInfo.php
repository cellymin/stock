<?php

class Api_DepotSub_GetListInfo extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'depotId' => array('name' => 'depotId', 'type' => 'int','require' => false)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_DepotSub_CURD();
        $list = $domain->getListAll();

        $rs['code'] = 1;
        $rs['content'] = $list;

        return $rs;
    }
}