<?php

class Domain_Department_CURD
{

    public function insert($input){
        $model = new Model_Department();

        return $model->insert($input);
    }

    public function update($data,$departmentId){
        $model = new Model_Department();

        return $model->update($departmentId,$data);
    }

    public function delete($departmentId){
        $model = new Model_Department();

        return $model->delete($departmentId);
    }

    public function getList($page_no, $page_size, $keyword) {
        $model = new Model_Department();

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

    public function get($departmentId) {
        $model = new Model_Department();

        return $model->get($departmentId);
    }

    public function getForUD($departmentId) {
        $model = new Model_Department();

        return $model->getForUD($departmentId);
    }
}