<?php

class Api_Order_GetList extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'type' => array('name' => 'type', 'type' => 'enum', 'range' => array('PLAN', 'ARRIVAL', 'RETURN', 'PURCHASE_IN', 'ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY', 'OTHER_IN', 'OTHER_OUT','SALE_OUT'), 'require' => true),
                'page_no' => array('name' => 'page_no', 'type' => 'int', 'min' => 1, 'require' => true),
                'page_size' => array('name' => 'page_size', 'type' => 'int', 'min' => 1, 'require' => true),
                'keyword' => array('name' => 'keyword', 'type' => 'string', 'default' => '', 'require' => false),
                'status' => array('name' => 'status', 'type' => 'enum', 'range' => array(0, 1, 2, 3, 4), 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_Order_List(DI()->request->get('type'));
        $list = $domain->get($this->page_no, $this->page_size, $this->keyword, $this->status);

        $rs['code'] = 1;
        $rs['content'] = $list;

        return $rs;
    }
}