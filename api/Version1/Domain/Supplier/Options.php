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
}