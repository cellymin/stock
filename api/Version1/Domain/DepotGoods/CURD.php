<?php

class Domain_DepotGoods_CURD
{
    private $page_no;
    private $page_size;
    private $keyword;
    private $depotId;
    private $depotSubId;


    public function __set($name, $value)
    {
        $this->$name = $value;
    }


    public function getList()
    {

        $model = new Model_DepotGoods();

        //总条数
        $row_count = $model->count($this->keyword,$this->depotId, $this->depotSubId);
        $row_count = $row_count ? $row_count[0]['count'] : 0;

        $total_page = $row_count % $this->page_size == 0 ? $row_count / $this->page_size : ceil($row_count / $this->page_size);
        $total_page = $total_page < 1 ? 1 : $total_page;
        $page_no    = $this->page_no > ($total_page) ? ($total_page) : $this->page_no;
        $start      = ($page_no - 1) * $this->page_size;

        $list = $model->getList($start, $this->page_size, $this->keyword, $this->depotId, $this->depotSubId);

        $rs = array(
            'row_count'  => $row_count,
            'total_page' => $total_page,
            'page_no'    => $page_no,
            'page_size'  => $this->page_size,
            'list'       => $list
        );

        return $rs;
    }

    public function get($id)
    {
        $model = new Model_DepotGoods();

        $depotGoods = $model->get($id);
        if (!$depotGoods || $depotGoods['flag'] != 1) {
            return array();
        }

        $goods_model = new Model_Goods();
        $goods       = $goods_model->fetch($depotGoods['goodsId']);

        $supplier_model = new Model_Supplier();
        $supplier       = $supplier_model->fetch($depotGoods['supplierId']);

        $depotSub_model = new Model_DepotSub();
        $depotSub       = $depotSub_model->fetch($depotGoods['depotSubId']);

        $depotGoods['goodsName']    = $goods ? $goods['goodsName'] : '';
        $depotGoods['supplierName'] = $supplier ? $supplier['supplierName'] : '';
        $depotGoods['depotSubName'] = $depotSub ? $depotSub['depotSubName'] : '';

        return $depotGoods;
    }
}

