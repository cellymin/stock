<?php

class Api_Supplier_Insert extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'supplierName' => array('name' => 'supplierName', 'type' => 'string', 'require' => true),
                'supplierAddress' => array('name' => 'supplierAddress', 'type' => 'string', 'require' => true),
                'supplierTel' => array('name' => 'supplierTel', 'type' => 'tel', 'require' => true),
//                'supplierUserName' => array('name' => 'supplierUserName', 'type' => 'name', 'require' => false),
//                'supplierUserPhone' => array('name' => 'supplierUserPhone', 'type' => 'phone', 'require' => false),
//                'supplierUserEmail' => array('name' => 'supplierUserEmail', 'type' => 'email', 'require' => false),
                'supplierUserName' => array('name' => 'supplierUserName', 'type' => 'string', 'require' => false),
                'supplierUserPhone' => array('name' => 'supplierUserPhone', 'type' => 'string', 'require' => false),
                'supplierUserEmail' => array('name' => 'supplierUserEmail', 'type' => 'string', 'require' => false),
                'supplierUserQQ' => array('name' => 'supplierUserQQ', 'type' => 'string', 'require' => false),
                'bankName' => array('name' => 'bankName', 'type' => 'string', 'require' => false),
//                'bankAccount' => array('name' => 'bankAccount', 'type' => 'Bank', 'require' => false),
                'bankAccount' => array('name' => 'bankAccount', 'type' => 'string', 'require' => false),
                'bankOpenName' => array('name' => 'bankOpenName', 'type' => 'string', 'require' => false),
//                'cardUserName' => array('name' => 'cardUserName', 'type' => 'name', 'require' => false),
//                'cardUserPhone' => array('name' => 'cardUserPhone', 'type' => 'phone', 'require' => false),
                'cardUserName' => array('name' => 'cardUserName', 'type' => 'string', 'require' => false),
                'cardUserPhone' => array('name' => 'cardUserPhone', 'type' => 'string', 'require' => false),
                'cardMoney' => array('name' => 'cardMoney', 'type' => 'float', 'require' => false),
                'reviewer' => array('name' => 'reviewer', 'type' => 'int', 'min' => 1, 'require' => false),
                'remark' => array('name' => 'remark', 'type' => 'string', 'require' => false),
                'taxrate' => array('name' => 'taxrate', 'type' => 'float', 'require' => true),
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
            'taxrate' => $this->taxrate,
            'supplierUserName' => $this->supplierUserName,
            'supplierUserPhone' => $this->supplierUserPhone,
            'supplierUserEmail' => $this->supplierUserEmail,
            'supplierUserQQ' => $this->supplierUserQQ,
            'bankName' => $this->bankName,
            'bankAccount' => $this->bankAccount,
            'bankOpenName' => $this->bankOpenName,
            'cardUserName' => $this->cardUserName,
            'cardUserPhone' => $this->cardUserPhone,
            'cardMoney' => $this->cardMoney?$this->cardMoney:0.00 ,
            'reviewer' => $this->reviewer,
            'remark' => $this->remark,
            'flag' => 0,
            'createCompany' => DI()->userInfo['companyId'],
            'createUser' => DI()->userInfo['userId'],
            'createTime' => date('Y-m-d H:i:s'),
        );

        $domain = new Domain_Supplier_CURD();
        if($this->taxrate>1){
            $rs['msg'] = '税率不能大于1';
            return $rs;
        }

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