<?php

class Api_Depot_ChkNum extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'goodsCnt' => array('name' => 'goodsCnt', 'type' => 'float', 'require' => true),
                'depotgoodsId' => array('name' => 'depotgoodsId', 'type' => 'int', 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $model = new Model_DepotGoods();
        $goods = $model->get($this->depotgoodsId);
        if(!$goods){
            throw new PhalApi_Exception_BadRequest('商品不存在', 0);
        }
        if(floatval($goods['goodsCnt'])<$this->goodsCnt){
            throw new PhalApi_Exception_BadRequest('库存不足', 0);
        }
        $rs['code'] = 1;
        $rs['msg'] = '保存成功';
        return $rs;
    }
}