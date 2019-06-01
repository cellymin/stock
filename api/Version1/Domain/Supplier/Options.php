<?php

class Domain_Supplier_Options
{
    public function get(){
        $rs = array();
        $model = new Model_Supplier();

        $options = $model->getOptions();

        if($options){
            foreach ($options as $row){
                $rs[$row['supplierId']] = $row['supplierName'];
            }
        }

        return $rs;
    }
    public function gettwo(){
        $rs = array();
        $model = new Model_Supplier();

        $options = $model->getOptions();

        if($options){
            foreach ($options as $row){
                $rs[$row['supplierId']]['supplierName'] = $row['supplierName'];
                $rs[$row['supplierId']]['taxrate'] = $row['taxrate'];
                $rs[$row['supplierId']]['quanpin'] = $row['quanpin'];
                $rs[$row['supplierId']]['jianxie'] = $row['jianxie'];
            }
        }

        return $rs;
    }
}