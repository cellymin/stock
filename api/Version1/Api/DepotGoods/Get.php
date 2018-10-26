<?php

class Api_DepotGoods_Get extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'min' => 0, 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_DepotGoods_CURD();

        $goods = $domain->get($this->id);
        if ($goods) {
            $rs['code'] = 1;
            $rs['content'] = $goods;
            return $rs;
        }

        $rs['msg'] = '商品不存在';
        return $rs;
    }
}