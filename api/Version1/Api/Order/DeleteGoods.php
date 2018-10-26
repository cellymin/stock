<?php

class Api_Order_DeleteGoods extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'orderId' => array('name' => 'orderId', 'type' => 'int', 'min' => 0, 'require' => true),
                'id' => array('name' => 'id', 'type' => 'array', 'format' => 'explode', 'require' => true),
                'type' => array('name' => 'type', 'type' => 'enum',
                    'range' => array(
                        'PLAN', 'ARRIVAL', 'RETURN', 'PURCHASE_IN', 'ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY','SALE_OUT'), 'require' => true
                ),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'id' => '', 'msg' => '');

        $domain = new Domain_Order_Goods($this->type);

        $id = $domain->delete($this->orderId, $this->id);
        if ($id === false) {
            $rs['msg'] = '删除成功';
            return $rs;
        }
        $rs['code'] = 1;
        return $rs;
    }
}