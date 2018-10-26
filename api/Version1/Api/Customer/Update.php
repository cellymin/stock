<?php

class Api_Customer_Update extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go'=>array(
                'customerId' => array('name' => 'customerId', 'type' => 'int','min'=>1, 'require' => true),
                'customerName' => array('name' => 'customerName', 'type' => 'string', 'require' => true),
                'customerAddress' => array('name' => 'customerAddress', 'type' => 'string', 'require' => true),
                'customerUserName' => array('name' => 'customerUserName', 'type' => 'name', 'require' => true),
                'customerUserPhone' => array('name' => 'customerUserPhone', 'type' => 'phone', 'require' => true),
                'customerUserEmail' => array('name' => 'customerUserEmail', 'type' => 'email', 'require' => true),
            )
        );
    }

    public function go(){
        $rs = array('code' => 0, 'customerId' => '', 'msg' => '');

        $domian = new Domain_Customer_CURD();

        $customer = $domian->getForUD($this->customerId);
        if(!$customer){
            $rs['msg'] = '没有权限';
            return $rs;
        }

        $input = array();
        $input['customerName'] = $this->customerName;
        $input['customerAddress'] = $this->customerAddress;
        $input['customerUserName'] = $this->customerUserName;
        $input['customerUserPhone'] = $this->customerUserPhone;
        $input['customerUserEmail'] = $this->customerUserEmail;

        $customerId = $domian->update($this->customerId,$input);
        if ($customerId === false) {
            $rs['msg'] = '保存失败';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['customerId'] = $this->customerId;
        return $rs;
    }
}