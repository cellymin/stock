<?php

class Api_GoodsCate_GetList extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array()
        );
    }

    public function go(){
        $rs = array('code'=>0,'content'=>'','msg'=>'');

        $domain = new Domain_GoodsCate_CURD();
        $list   = $domain->getList();

        $rs['code']    = 1;
        $rs['content'] = $list;

        return $rs;
    }
}