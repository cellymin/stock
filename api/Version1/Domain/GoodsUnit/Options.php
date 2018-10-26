<?php

class Domain_GoodsUnit_Options
{
    public function get(){
        $rs = array();
        $model = new Model_GoodsUnit();

        $list = $model->getOptions();
        if($list){
            foreach ($list as $row){
                $rs[$row['unitId']] = $row['unitName'];
            }
            return $rs;
        }
        return $rs;
    }
}