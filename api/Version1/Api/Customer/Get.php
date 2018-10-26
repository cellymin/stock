<?php

class Api_Customer_Get extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'customerId' => array('name' => 'customerId', 'type' => 'int', 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $domain = new Domain_Customer_CURD();

        $customer = $domain->get($this->customerId);
        if(!$customer){
            $rs['msg']=  '客户不存在';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['content'] = $customer;
        return $rs;
    }
}