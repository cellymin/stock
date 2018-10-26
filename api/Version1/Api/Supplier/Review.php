<?php

class Api_Supplier_Review extends PhalApi_Api
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
        $rs = array('code' => 0, 'supplierId', 'msg' => '');

        $domain = new Domain_Supplier_CURD();

        $supplier = $domain->getForUD($this->supplierId);
        if (!$supplier) {
            $rs['msg'] = '没有权限';
            return $rs;
        }

        if ($supplier['flag'] == 1) {
            $rs['msg'] = '请勿重复审核';
            return $rs;
        }

        if (DI()->userInfo['userGroup'] != 1 && DI()->userInfo['userId'] != $supplier['reviewer']) {
            $rs['msg'] = '没有权限!';
            return $rs;
//            $reviewDomain = new Domain_Reviewer_Options();
//
//            $reviewer_options = $reviewDomain->getReviewers('supplier');
//            $reviewer_array = array_keys($reviewer_options);
//            if (!in_array(DI()->userInfo['userId'], $reviewer_array)) {
//                $rs['msg'] = '没有权限';
//                return $rs;
//            }
        }

        $id = $domain->review($this->supplierId);
        if ($id === false) {
            $rs['msg'] = '审核失败';
            return $rs;
        }
        $rs['code'] = 1;
        $rs['supplierId'] = $this->supplierId;

        return $rs;
    }
}