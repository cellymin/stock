<?php

class Api_DepotSub_Options extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'depotId' => array('name' => 'depotId', 'type' => 'int', 'min' => 1, 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_DepotSub_Options();

        $list = $domain->get($this->depotId);

        $rs['code'] = 1;
        $rs['content'] = $list;

        return $rs;
    }
}