<?php

class Api_Employee_Options extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'companyId' => array('name' => 'companyId', 'type' => 'int', 'min' => 0, 'require' => true),
                'departmentId' => array('name' => 'departmentId', 'type' => 'int', 'min' => 0, 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $domain = new Domain_Employee_Options();

        $options = $domain->get($this->companyId, $this->departmentId);
        if ($options) {
            $rs['code'] = 1;
            $rs['content'] = $options;
        }
        return $rs;
    }
}