<?php

class Api_Customer_GetList extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go'=>DI()->config->get('app.apiListCommonRules')
        );
    }

    public function go(){
        $rs = array('code'=>0,'content'=>'','msg'=>'');

        $domain = new Domain_Customer_CURD();
        $list = $domain->getList($this->page_no,$this->page_size,$this->keyword);

        $rs['code'] = 1;
        $rs['content'] = $list;

        return $rs;
    }
}