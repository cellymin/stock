<?php

class Domain_Goods_PriceSearch
{
    public function go($input)
    {
        $model = new Model_Goods();

        $row_count = $model->countHistoryPo($input['supplierId'], $input['goodsId']);
        $row_count = $row_count ? $row_count[0]['count'] : 0;

        $total_page = $row_count % $input['page_size'] == 0 ? $row_count / $input['page_size'] : ceil($row_count / $input['page_size']);
        $total_page = $total_page < 1 ? 1 : $total_page;
        $page_no = $input['page_no'] > ($total_page) ? ($total_page) : $input['page_no'];
        $start = ($page_no - 1) * $input['page_size'];

        $list = $model->getHistoryPo($start, $input['page_size'], $input['goodsId'], $input['supplierId'],$input['sortType']);

        $rs = array(
            'row_count'  => $row_count,
            'total_page' => $total_page,
            'page_no'    => $page_no,
            'page_size'  => $input['page_size'],
            'list'       => $list ? $list : array()
        );

        return $rs;
    }
}