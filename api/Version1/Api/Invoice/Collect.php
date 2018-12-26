<?php

/**
 * Created by PhpStorm.
 * User: b
 * Date: 2017/8/31
 * Time: 15:18
 */
class Api_Invoice_Collect extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'invoiceId'     => array(
                    'name'    => 'invoiceId',
                    'type'    => 'array',
                    'format'  => 'explode',
                    'require' => true
                ),
                'invoiceStatus' => array(
                    'name'    => 'invoiceStatus',
                    'type'    => 'enum',
                    'range'   => array(0, 1),
                    'require' => true
                ),
                'invoiceImg'   => array('name' => 'invoiceImg', 'type' => 'string', 'require' => false),
                'endTime'       => array('name' => 'endTime', 'type' => 'string', 'require' => false),
                'noticeTime'    => array('name' => 'noticeTime', 'type' => 'string', 'require' => false),
                'remark'        => array('name' => 'remark', 'type' => 'string', 'require' => false),
                'adjustamount'        => array('name' => 'adjustamount', 'type' => 'string', 'require' => false),
                'trueInvoiceNo'        => array('name' => 'trueInvoiceNo', 'type' => 'string', 'require' => false),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $domain = new Domain_Invoice_CURD();
        $data = array(
            'invoiceId'     => $this->invoiceId,
            'invoiceImg'   => $this->invoiceImg,
            'invoiceStatus' => $this->invoiceStatus,
            'endTime'       => $this->endTime,
            'noticeTime'    => $this->noticeTime,
            'remark'        => $this->remark,
            'adjustamount' => $this->adjustamount,
            'trueInvoiceNo' => $this->trueInvoiceNo,
        );
        return $domain->collectList($data);

        $rs['code'] = 1;

        return $rs;
    }

}