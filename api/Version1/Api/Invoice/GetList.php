<?php

/**
 * Created by PhpStorm.
 * User: b
 * Date: 2017/8/31
 * Time: 15:18
 */
class Api_Invoice_GetList extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go'=>array(
                'page_no'    => array('name' => 'page_no', 'type' => 'int', 'min' => 1, 'require' => true),
                'page_size'  => array('name' => 'page_size', 'type' => 'int', 'min' => 1, 'require' => true),
                'keyword'    => array('name' => 'keyword', 'type' => 'string', 'default' => '', 'require' => false),
                'supplierId' => array('name' => 'supplierId', 'type' => 'int', 'min' => 0, 'require' => true),
                'payStatus'=>array('name' => 'payStatus', 'type' => 'enum', 'range' => array(0,1,2), 'require' => false),
                'invoiceStatus'=>array('name' => 'invoiceStatus', 'type' => 'enum', 'range' => array(0,1,2), 'require' => false),
                'type'=>array('name' => 'type', 'type' => 'enum', 'range' => array(1,2), 'require' => false),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_Invoice_CURD();
        $list = $domain->getList($this->page_no, $this->page_size, $this->keyword, $this->supplierId,$this->payStatus,$this->invoiceStatus,$this->type);

        if ($list) {
            $rs['code'] = 1;
            $rs['content'] = $list;
            return $rs;
        }
        $rs['msg'] = '没有数据';

        return $rs;
    }

}