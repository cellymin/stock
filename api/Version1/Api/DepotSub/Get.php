<?php

class Api_DepotSub_Get extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'depotSubId' => array('name' => 'depotSubId', 'type' => 'int','min'=>1, 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $domain = new Domain_DepotSub_CURD();

        $depot = $domain->get($this->depotSubId);
        if (!$depot) {
            $rs['msg'] = '库位不存在';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['content'] = $depot;
        return $rs;
    }
}