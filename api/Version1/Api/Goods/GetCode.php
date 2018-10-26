<?php

class Api_Goods_GetCode extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array()
        );
    }

    public function go()
    {
        $rs = array('code'=>0,'content'=>'','msg'=>'');

        $domain = new Domain_Goods_Code();
        $code = $domain->create();
        if($code){
            $rs['code'] = 1;
            $rs['content'] = $code;
            return $rs;
        }
        $rs['msg'] = '条码获取失败';
        return $rs;
    }
}