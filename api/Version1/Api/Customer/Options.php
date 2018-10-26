<?php

class Api_Customer_Options extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go'=>array()
        );
    }

    public function go(){
        $rs = array('code'=>0,'content'=>'','msg'=>'');

        $domain = new Domain_Customer_CURD();
        $list = $domain->options();

        $rs['code'] = 1;
        $rs['content'] = $list;

        return $rs;
    }
}