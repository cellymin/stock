<?php

class Api_Order_Save extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'orderId' => array('name' => 'orderId', 'type' => 'int', 'min' => 0, 'require' => true),
                'reviewer' => array('name' => 'reviewer', 'type' => 'int', 'min' => 0, 'require' => true),
                'type' => array( 'name' => 'type', 'type' => 'enum',
                    'range' => array('PLAN', 'ARRIVAL', 'RETURN', 'PURCHASE_IN', 'ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY','SALE_OUT','SALE_RETURN','PURCHASE_RETURN'),
                    'require' => true
                ),
                'flag' => array('name' => 'flag', 'type' => 'int', 'min' => 0, 'require' => false),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $domian = new Domain_Order_Save($this->type);
        $num = $domian->save($this->orderId,$this->reviewer,$this->flag);
//        return $num;
        if ($num) {
            $rs['code'] = 1;
            $rs['content'] = $num;
            return $rs;
        }
        $rs['code'] = 1;
        return $rs;
    }
}