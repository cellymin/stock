<?php

class Domain_Company_Options
{

    public function get() {
        $model = new Model_Company();

        $list = $model->getOptions();
        $options = array('0'=>'全部');
        if($list){
            foreach ($list as $row){
                $options[$row['companyId']] = $row['companyName'];
            }
        }

        return $options;
    }
}