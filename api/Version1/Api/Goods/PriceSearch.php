<?php

class Api_Goods_PriceSearch extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'goodsId'    => array('name' => 'goodsId', 'type' => 'int', 'min' => 0, 'require' => true),
                'page_no'    => array('name' => 'page_no', 'type' => 'int', 'min' => 1, 'require' => true),
                'page_size'  => array('name' => 'page_size', 'type' => 'int', 'min' => 1, 'require' => true),
                'supplierId' => array('name' => 'supplierId', 'type' => 'int', 'min' => 0, 'require' => false),
                'sortKey'    => array('name'    => 'sortKey',
                                      'type'    => 'enum',
                                      'range'   => array('goodsPrice'),
                                      'default' => 'goodsPrice',
                                      'require' => false
                ),
                'sortType'   => array('name'    => 'sortType',
                                      'type'    => 'enum',
                                      'range'   => array('desc', 'asc'),
                                      'default' => 'desc',
                                      'require' => false
                ),
            )
        );
    }

    public function go()
    {
        $rs = array('code'=>0,'content'=>'','msg'=>'');
        $domain = new Domain_Goods_PriceSearch();

        $input = array(
            'goodsId'    => $this->goodsId,
            'page_no'    => $this->page_no,
            'page_size'  => $this->page_size,
            'supplierId' => $this->supplierId,
            'sortKey'    => $this->sortKey,
            'sortType'   => $this->sortType,
        );

        $list = $domain->go($input);
        if($list){
            $rs['code']=1;
            $rs['content']=$list;
            return $rs;
        }

        return $rs;
    }
}