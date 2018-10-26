<?php

class Api_Supplier_Get extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'supplierId' => array('name' => 'supplierId', 'type' => 'int', 'min' => 1, 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_Supplier_CURD();
        $supplier = $domain->get($this->supplierId);

        if (!$supplier) {
            $rs['msg'] = '没有找到供应商';
            return $rs;
        }
        $rs['code'] = 1;
        $rs['content'] = $supplier;

        return $rs;
    }
}