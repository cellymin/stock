<?php

class Api_GoodsUnit_Get extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'unitId' => array('name' => 'unitId', 'type' => 'int', 'min' => 1, 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $domain = new Domain_GoodsUnit_CURD();

        $unit = $domain->get($this->unitId);
        if (!$unit) {
            $rs['msg'] = '没有找到计量单位';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['content'] = $unit;

        return $rs;
    }
}