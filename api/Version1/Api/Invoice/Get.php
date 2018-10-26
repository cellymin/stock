<?php

/**
 * Created by PhpStorm.
 * User: b
 * Date: 2017/8/31
 * Time: 15:18
 */
class Api_Invoice_Get extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'invoiceId' => array('name'    => 'invoiceId',
                                     'type'    => 'array',
                                     'format'  => 'explode',
                                     'require' => true
                ),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        if (!is_array($this->invoiceId)) {
            throw new PhalApi_Exception_BadRequest('参数错误', 0);
        }

        $domain = new Domain_Invoice_CURD();
        $list = $domain->get($this->invoiceId);
        if ($list) {
            $rs['code'] = 1;
            $rs['content'] = $list;
            return $rs;
        }
        $rs['msg'] = '没有数据';

        return $rs;
    }

}