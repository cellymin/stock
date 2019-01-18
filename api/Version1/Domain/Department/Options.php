<?php

class Domain_Department_Options
{

    public function get() {
        $model = new Model_Department();

        $list = $model->getOptions();
        $options = array('0'=>'== 请选择 ==');
        if($list){
            foreach ($list as $row){
                $options[$row['departmentId']] = $row['departmentName'];
            }
        }

        return $options;
    }
    public function appget(){
        $model = new Model_Department();

        $list = $model->getOptions();
        if($list){
            foreach ($list as $row){
                $options[] = array(
                    'departmentId'=>$row['departmentId'],
                    'departmentName'=>$row['departmentName']
                );
            }
        }

        return $options;
    }
}