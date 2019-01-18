<?php

class Domain_Employee_Options
{
    public function get($companyId,$departmentId){
        $rs = array();
        $model = new Model_Employee();

        $list = $model->getOptins($companyId,$departmentId);
        $rs[]=array('employeeId'=>0,'employeeName'=>'==请选择==');
        if($list){
            foreach ($list as $row){
                $rs[] = array(
                    'employeeId'=>$row['employeeId'],
                    'employeeName'=>$row['employeeName']
                );
            }
            return $rs;
        }
        return $rs;
    }

    public function appget($companyId,$departmentId){
        $rs = array();
        $model = new Model_Employee();

        $list = $model->getOptins($companyId,$departmentId);
        if($list){
            foreach ($list as $row){
                $rs[] = array(
                    'employeeId'=>$row['employeeId'],
                    'employeeName'=>$row['employeeName']
                );
            }
            return $rs;
        }
        return $rs;
    }
}