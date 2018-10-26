<?php

class Api_GoodsUnit_Options extends PhalApi_Api
{
    public function getRules()
    {
        return array();
    }

    public function go(){
        $rs = array('code'=>0,'content'=>'','msg'=>'');

        $domain = new Domain_GoodsUnit_Options();

        $list = $domain->get();
        if($list){
            $rs['code'] = 1;
            $rs['content'] = $list;
            return $rs;
        }
        return $rs;
    }
}