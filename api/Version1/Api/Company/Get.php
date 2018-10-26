<?php

/**
 * 公司信息
 * Class Company_Insert
 */
class Api_Company_Get extends PhalApi_Api
{
    public function getRules() {
        return array(
            'go' => array(
                'companyId' => array('name' => 'companyId', 'type' => 'int', 'min' => 1, 'require' => true),
            )
        );
    }

    public function go() {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_Company_CURD();
        $data   = $domain->get($this->companyId);
        if ($data) {
            $rs['code']    = 1;
            $rs['content'] = $data;

            return $rs;
        }
        $rs['msg'] = '公司不存在';

        return $rs;
    }
}