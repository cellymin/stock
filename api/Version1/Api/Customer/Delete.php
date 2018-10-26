<?php

class Api_Customer_Delete extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'customerId' => array('name' => 'customerId', 'type' => 'array', 'format' => 'explode', 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'customerId' => '', 'msg' => '');
        $customerId = $this->customerId;

        $domain = new Domain_Customer_CURD();

        foreach ($customerId as $row) {
            $customer = $domain->getForUD($row);
            if (!$customer) {
                $rs['msg'] = '没有权限';
                break;
            }
        }

        if ($rs['msg']) return $rs;

        $id = $domain->delete($customerId);
        if ($id === false) {
            $rs['msg'] = '删除失败';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['customerId'] = $customerId;

        return $rs;
    }


}
