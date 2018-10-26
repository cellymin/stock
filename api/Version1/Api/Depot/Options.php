<?php

class Api_Depot_Options extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array()
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_Depot_Options();

        $list = $domain->get();

        $rs['code'] = 1;
        $rs['content'] = $list;

        return $rs;
    }
}