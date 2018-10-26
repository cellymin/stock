<?php

class Domain_Order_Get
{
    public $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function get($orderId, $page_no, $page_size)
    {
        $model = new Model_Order();

        $order = $model->getById($orderId);
        if (!$order || $order[0]['flag'] == -1) {
            return false;
        }
        $order_goods_model = new Model_OrderGoods();

        $row_count = $order_goods_model->count($orderId);

        //总条数
        $start = 0;
        $total_page = 1;
        if($page_size){
            $total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
            $total_page = $total_page < 1 ? 1 : $total_page;
            $page_no = $page_no > ($total_page) ? ($total_page) : $page_no;
            $start = ($page_no - 1) * $page_size;
        }
        $rs = array(
            'row_count' => $row_count,
            'total_page' => $total_page,
            'page_no' => $page_no,
            'page_size' => $page_size,
            'list' => $order_goods_model->getList($orderId, $start, $page_size)
        );

        $order[0]['goods'] = $rs;
        return $order[0];
    }

}