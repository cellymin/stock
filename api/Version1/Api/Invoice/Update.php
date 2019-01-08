<?php

/**
 * Created by PhpStorm.
 * User: b
 * Date: 2017/8/31
 * Time: 15:18
 */
class Api_Invoice_Update extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'invoiceId' => array(
                    'name' => 'invoiceId',
                    'type' => 'string',
                    'format' => 'explode',
                    'require' => true
                )

            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $domain = new Domain_Invoice_CURD();
        $data = array(
            'invoiceId' => $this->invoiceId
        );
        $res = $domain->updateVerify($data);
        if (res) {
            $rs['code'] = 1;
            $rs['content'] = $res;
            return $rs;
        } else {

        }
        $rs['msg'] = "对账操作失败";
        return $rs;
    }

}