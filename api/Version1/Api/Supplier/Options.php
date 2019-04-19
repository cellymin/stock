<?php

class Api_Supplier_Options extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'type' => array('name' => 'type', 'type' => 'int', 'min' => 1, 'require' => false),
            )
        );
    }

    public function go(){
        $rs = array('code'=>0,'content'=>'','msg'=>'');

        $domain = new Domain_Supplier_Options();

        $options = $domain->get();
        if($this->type==1){
            $options = $domain->gettwo();
        }

        $rs['code'] = 1;
        $rs['content'] = $options;

        return $rs;
    }
}