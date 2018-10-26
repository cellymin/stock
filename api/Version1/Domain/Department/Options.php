<?php

class Domain_Department_Options
{

    public function get() {
        $model = new Model_Department();

        $list = $model->getOptions();
        $options = array('0'=>'全部');
        if($list){
            foreach ($list as $row){
                $options[$row['departmentId']] = $row['departmentName'];
            }
        }

        return $options;
    }
}