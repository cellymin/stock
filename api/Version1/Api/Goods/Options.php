<?php

class Api_Goods_Options extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'goodsCateId' => array('name' => 'goodsCateId', 'type' => 'int', 'min' => 0, 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_Goods_Options();
        $list = $domain->get($this->goodsCateId);

        $rs['code'] = 1;
        $rs['content'] = $list;

        return $rs;
    }
}