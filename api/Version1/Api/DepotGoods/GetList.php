<?php

class Api_DepotGoods_GetList extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'page_no'    => array('name' => 'page_no', 'type' => 'int', 'min' => 1, 'require' => true),
                'page_size'  => array('name' => 'page_size', 'type' => 'int', 'min' => 1, 'require' => true),
                'keyword'    => array('name' => 'keyword', 'type' => 'string', 'default' => '', 'require' => false),
                'depotId'    => array('name' => 'depotId', 'type' => 'int', 'min' => 0, 'require' => true),
                'depotSubId' => array('name' => 'depotSubId', 'type' => 'int', 'min' => 0, 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_DepotGoods_CURD();

        $domain->page_no    = $this->page_no;
        $domain->page_size  = $this->page_size;
        $domain->keyword    = $this->keyword;
        $domain->depotId    = $this->depotId;
        $domain->depotSubId = $this->depotSubId;

        $list = $domain->getList();
        if ($list) {
            $rs['code']    = 1;
            $rs['content'] = $list;
            return $rs;
        }
        $rs['msg'] = '没有数据';
        return $rs;
    }
}