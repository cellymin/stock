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
                 'rate' => array('name' => 'rate', 'type' => 'float', 'require' => false),
            )
        );
    }

    public function go()
    {
        $rs = array('code'=>0,'content'=>null,'msg'=>'');
        $domain = new Domain_Goods_CURD();
        if($this->rate>1){
            $rs['msg'] = '税率不能大于1';
            return $rs;
        }
        $goods = $domain->getInfo($this->goodsBarCode);
        if(!$goods){

            $rs['msg'] = '商品不存在';
            return $rs;
        }
        if(empty($goods['usecostpri'])){
            if($this->rate>0) {
                $goods['lastPrice'] = $goods['lastPrice'];
            }else{
                $goods['lastPrice'] = strval($goods['lastPrice'] * (1+$this->rate)) ; //含税价格=不含税价*(1+税率)
            }
        }else if($goods['lastPrice']!=$goods['usecostpri']){
            $goods['lastPrice'] = $goods['lastPrice'];
        }

        $rs['code'] = 1;
        $rs['content'] = $goods;

        return $rs;
    }
}