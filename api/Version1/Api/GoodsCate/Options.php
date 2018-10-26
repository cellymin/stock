<?php

class Api_GoodsCate_Options extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'parentId' => array('name' => 'parentId', 'type' => 'int', 'min' => 0, 'require' => true)
            )
        );
    }

    public function go(){
        $rs = array('code'=>0,'content'=>'','msg'=>'');

        $domain = new Domain_GoodsCate_CURD();
        $list   = $domain->getChildByPid($this->parentId);

        $rs['code']    = 1;
        $rs['content'] = $list;

        return $rs;
    }
}