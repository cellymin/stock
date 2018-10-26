<?php

class Domain_GoodsUnit_CURD
{
    public function insert($input)
    {
        $model = new Model_GoodsUnit();

        return $model->insert($input);
    }

    public function update($unitId,$input){
        $model = new Model_GoodsUnit();

        return $model->update($unitId,$input);
    }

    public function delete($unitId){
        $model = new Model_GoodsUnit();

        return $model->delete($unitId);
    }

    public function get($unitId)
    {
        $model = new Model_GoodsUnit();

        return $model->get($unitId, 'unitId,unitName,unitNo');
    }

    public function getForUD($unitId){
        $model = new Model_GoodsUnit();

        return $model->getForUD($unitId, 'unitId,unitName,unitNo');
    }

    public function getList($page_no, $page_size, $keyword)
    {
        $model = new Model_GoodsUnit();

        //总条数
        $row_count = $model->count($keyword);
        $total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
        $total_page = $total_page < 1 ? 1 : $total_page;
        $page_no = $page_no > ($total_page) ? ($total_page) : $page_no;
        $start = ($page_no - 1) * $page_size;

        $list = $model->getList($start, $page_size, $keyword);

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