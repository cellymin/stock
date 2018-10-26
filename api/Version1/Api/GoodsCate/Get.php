<?php

class Api_GoodsCate_Get extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go'=>array(
                'cateId' => array('name' => 'cateId', 'type' => 'int', 'min' => 1, 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $domain = new Domain_GoodsCate_CURD();

        $cate = $domain->get($this->cateId);
        if (!$cate) {
            $rs['msg'] = '分类不存在';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['content'] = $cate;
        return $rs;
    }
}