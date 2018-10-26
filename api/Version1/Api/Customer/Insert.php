<?php

class Api_Customer_Insert extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'customerName' => array('name' => 'customerName', 'type' => 'string', 'require' => true),
                'customerAddress' => array('name' => 'customerAddress', 'type' => 'string', 'require' => true),
                'customerUserName' => array('name' => 'customerUserName', 'type' => 'name', 'require' => true),
                'customerUserPhone' => array('name' => 'customerUserPhone', 'type' => 'phone', 'require' => true),
                'customerUserEmail' => array('name' => 'customerUserEmail', 'type' => 'email', 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'customerId' => '', 'msg' => '');

        $input = array();
        $input['customerName'] = $this->customerName;
        $input['customerAddress'] = $this->customerAddress;
        $input['customerUserName'] = $this->customerUserName;
        $input['customerUserPhone'] = $this->customerUserPhone;
        $input['customerUserEmail'] = $this->customerUserEmail;
        $input['flag'] = 1;
        $input['createCompany'] = DI()->userInfo['companyId'];
        $input['createUser'] = DI()->userInfo['userId'];
        $input['createTime'] = date('Y-m-d H:i:s');

        $domian = new Domain_Customer_CURD();

        $customerId = $domian->insert($input);
        if ($customerId === false) {
            $rs['msg'] = '保存失败';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['customerId'] = $customerId;
        return $rs;
    }

}