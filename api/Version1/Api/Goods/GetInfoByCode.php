<?php

class Api_Goods_GetInfoByCode extends PhalApi_Api
{
    protected function filterCheck()
    {
    }
    public function getRules()
    {
        return array(
            'go' => array(
                'goodsBarCode' => array('name' => 'goodsBarCode', 'type' => 'string', 'require' => true),
                 'rate' => array('name' => 'rate', 'type' => 'float', 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code'=>0,'content'=>'','msg'=>'');
        $domain = new Domain_Goods_CURD();
        if($this->rate>1){
            $rs['msg'] = '税率不嗯呢该大于1';
            return $rs;
        }
        $goods = $domain->getInfo($this->goodsBarCode);
        if($goods['lastPrice']>$goods['usecostpri'] && $goods['usecostpri']>0){  //成本价>不含税价格
            $goods['lastPrice'] = $goods['lastPrice']; //含税价
        }else{
            $goods['lastPrice'] = $goods['lastPrice'] * (1+$this->rate); //含税价格=不含税价*(1+税率)
        }
        if(!$goods){
            $rs['msg'] = '商品不存在';
            return $rs;
        }
        $rs['code'] = 1;
        $rs['content'] = $goods;

        return $rs;
    }
}