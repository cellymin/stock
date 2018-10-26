<?php

class Domain_Order_List
{
    public $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function get($page_no,$page_size,$keyword,$status){
        $model = new Model_Order();

        //总条数
        $row_count = $model->count($keyword, $status);

        $total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
        $total_page = $total_page < 1 ? 1 : $total_page;
        $page_no = $page_no > ($total_page) ? ($total_page) : $page_no;
        $start = ($page_no - 1) * $page_size;

        $list = $model->getList($start, $page_size, $keyword, $status);

        $rs = array(
            'row_count' => $row_count,
            'total_page' => $total_page,
            'page_no' => $page_no,
            'page_size' => $page_size,
            'list' => $list
        );

        return $rs;
    }
}