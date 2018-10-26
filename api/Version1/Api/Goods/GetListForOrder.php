<?php

class Api_Goods_GetListForOrder extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'page_no' => array('name' => 'page_no', 'type' => 'int', 'min' => 1, 'require' => true),
                'page_size' => array('name' => 'page_size', 'type' => 'int', 'min' => 1, 'require' => true),
                'keyword' => array('name' => 'keyword', 'type' => 'string', 'default' => '', 'require' => false),
                'goodsCateId' => array('name' => 'goodsCateId', 'type' => 'int', 'min' => 0, 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_Goods_CURD();
        $list = $domain->getListV2($this->page_no, $this->page_size, $this->keyword, $this->goodsCateId);

        $rs['code'] = 1;
        $rs['content'] = $list;

        return $rs;
    }
}