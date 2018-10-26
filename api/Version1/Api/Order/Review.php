<?php

class Api_Order_Review extends PhalApi_Api
{
    public function getRules()
    {
        $type = DI()->request->get('type');
        if (!$type) {
            throw new PhalApi_Exception_BadRequest('缺少必要参数 type', 0);
        }
        $range = array(
            'PLAN',
            'ARRIVAL',
            'RETURN',
            'PURCHASE_IN',
            'ALLOT_IN',
            'ALLOT_OUT',
            'USE_OUT',
            'INVENTORY',
            'OTHER_IN',
            'OTHER_OUT',
            'SALE_OUT'
        );
        if (!in_array($type, $range)) {
            throw new PhalApi_Exception_BadRequest('type 应为 ' . implode('/', $range) . '中的一个', 0);
        }
        $rule_array = array(
            'orderId' => array('name' => 'orderId', 'type' => 'int', 'min' => 0, 'require' => true),
            'result'  => array(
                'name'    => 'result',
                'type'    => 'enum',
                'range'   => array('pass', 'nopass'),
                'require' => true
            ),
            'memo'    => array('name' => 'memo', 'type' => 'string', 'require' => false),
        );

        return array(
            'go' => $rule_array
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $data = array(
            'type'          => DI()->request->get('type'),
            'orderId'       => $this->orderId,
            'result'        => $this->result,
            'memo'          => $this->memo,
        );

        $domain = new Domain_Order_Review($data);

        $num = $domain->review();
        if ($num) {
            $rs['code'] = 1;
            return $rs;
        }
        $rs['msg'] = '审核失败';

        return $rs;
    }
}