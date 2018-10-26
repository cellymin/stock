<?php

class Api_Goods_GetForOrder extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go'=>array(
                'goodsId' => array('name' => 'goodsId', 'type' => 'int', 'min' => 1, 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $domain = new Domain_Goods_CURD();

        $goods = $domain->getForOrder($this->goodsId);
        if (!$goods) {
            $rs['msg'] = '商品不存在';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['content'] = $goods;

        return $rs;
    }
}