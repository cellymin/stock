<?php

class Api_Finance_Get extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'financeId' => array('name' => 'financeId', 'type' => 'int', 'min' => 1, 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_Finance_CURD();
        $finance = $domain->get($this->financeId);
        if ($finance) {
            $rs['code'] = 1;
            $rs['content'] = $finance;
            return $rs;
        }
        $rs['msg'] = '财务不存在';
        return $rs;
    }

}