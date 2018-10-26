<?php

class Domain_Company_CURD
{

    public function insert($data) {
        $model = new Model_Company();

        return $model->insert($data);
    }

    public function update($companyId,$data){
        $model = new Model_Company();

        return $model->update($companyId,$data);
    }

    public function delete($companyId){
        $model = new Model_Company();

        return $model->delete($companyId);
    }


    public function getList($page_no, $page_size, $keyword) {
        $model = new Model_Company();

        //总条数
        $row_count  = $model->count($keyword);
        $total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
        $total_page = $total_page < 1 ? 1 : $total_page;
        $page_no    = $page_no > ($total_page) ? ($total_page) : $page_no;
        $start      = ($page_no - 1) * $page_size;

        $list = $model->getList($start, $page_size, $keyword);

        $rs = array(
            'row_count'  => $row_count,
            'total_page' => $total_page,
            'page_no'    => $page_no,
            'page_size'  => $page_size,
            'list'       => $list
        );

        return $rs;
    }

    public function get($companyId) {
        $model = new Model_Company();

        return $model->get($companyId);
    }

    public function getForUD($companyId){
        $model = new Model_Company();

        return $model->getForUD($companyId);
    }

}