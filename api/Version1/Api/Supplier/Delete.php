<?php

class Api_Supplier_Delete extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go'=>array(
                'supplierId'=>array('name'=>'supplierId','type'=>'array','format'=>'explode','require'=>true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'supplierId' => '', 'msg' => '');

        if (!is_array($this->supplierId)) {
            $rs['msg'] = '参数错误';
            return $rs;
        }
        $domain = new Domain_Supplier_CURD();

        $supplierId = $this->supplierId;
        foreach ($supplierId as $row) {
            $supplier = $domain->getForUD($row);
            if (!$supplier) {
                $rs['msg'] = '没有权限';
                break;
            }
        }

        if ($rs['msg']) return $rs;

        $id = $domain->delete($supplierId);
        if ($id === false) {
            $rs['msg'] = '删除失败';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['supplierId'] = $supplierId;
        return $rs;
    }
}