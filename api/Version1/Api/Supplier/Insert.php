<?php

class Api_Supplier_Insert extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'supplierName' => array('name' => 'supplierName', 'type' => 'string', 'require' => true),
                'supplierAddress' => array('name' => 'supplierAddress', 'type' => 'string', 'require' => true),
                'supplierTel' => array('name' => 'supplierTel', 'type' => 'tel', 'require' => false),
                'supplierUserName' => array('name' => 'supplierUserName', 'type' => 'name', 'require' => true),
                'supplierUserPhone' => array('name' => 'supplierUserPhone', 'type' => 'phone', 'require' => true),
                'supplierUserEmail' => array('name' => 'supplierUserEmail', 'type' => 'email', 'require' => false),
                'supplierUserQQ' => array('name' => 'supplierUserQQ', 'type' => 'string', 'require' => false),
                'bankName' => array('name' => 'bankName', 'type' => 'string', 'require' => true),
                'bankAccount' => array('name' => 'bankAccount', 'type' => 'Bank', 'require' => true),
                'bankOpenName' => array('name' => 'bankOpenName', 'type' => 'string', 'require' => true),
                'cardUserName' => array('name' => 'cardUserName', 'type' => 'name', 'require' => true),
                'cardUserPhone' => array('name' => 'cardUserPhone', 'type' => 'phone', 'require' => true),
                'cardMoney' => array('name' => 'cardMoney', 'type' => 'float', 'require' => true),
                'reviewer' => array('name' => 'reviewer', 'type' => 'int', 'min' => 1, 'require' => true),
                'remark' => array('name' => 'remark', 'type' => 'string', 'require' => false),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'supplierId' => '', 'msg' => '');

        $input = array(
            'supplierName' => $this->supplierName,
            'supplierAddress' => $this->supplierAddress,
            'supplierTel' => $this->supplierTel,
            'supplierUserName' => $this->supplierUserName,
            'supplierUserPhone' => $this->supplierUserPhone,
            'supplierUserEmail' => $this->supplierUserEmail,
            'supplierUserQQ' => $this->supplierUserQQ,
            'bankName' => $this->bankName,
            'bankAccount' => $this->bankAccount,
            'bankOpenName' => $this->bankOpenName,
            'cardUserName' => $this->cardUserName,
            'cardUserPhone' => $this->cardUserPhone,
            'cardMoney' => $this->cardMoney,
            'reviewer' => $this->reviewer,
            'remark' => $this->remark,
            'flag' => 0,
            'createCompany' => DI()->userInfo['companyId'],
            'createUser' => DI()->userInfo['userId'],
            'createTime' => date('Y-m-d H:i:s'),
        );

        $domain = new Domain_Supplier_CURD();

        $supplierId = $domain->insert($input);
        if ($supplierId === false) {
            $rs['msg'] = '保存失败';
            return $rs;
        }
        $rs['code'] = 1;
        $rs['supplierId'] = $supplierId;

        return $rs;
    }
}