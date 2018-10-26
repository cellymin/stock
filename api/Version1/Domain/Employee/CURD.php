<?php

class Domain_Employee_CURD
{
    public function insert($input)
    {
        $model = new Model_Employee();

        return $model->insert($input);
    }

    public function update($employeeId, $input)
    {
        $model = new Model_Employee();

        return $model->update($employeeId, $input);
    }

    public function delete($employeeId)
    {
        $model = new Model_Employee();

        return $model->delete($employeeId);
    }

    public function get($employeeId)
    {
        $model = new Model_Employee();

        return $model->get($employeeId);
    }

    public function getList($page_no, $page_size, $keyword,$companyId)
    {
        $model = new Model_Employee();

        //总条数
        $row_count = $model->count($keyword,$companyId);
        $total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
        $total_page = $total_page < 1 ? 1 : $total_page;
        $page_no = $page_no > ($total_page) ? ($total_page) : $page_no;
        $start = ($page_no - 1) * $page_size;

        $list = $model->getList($start, $page_size, $keyword,$companyId);

        $rs = array(
            'row_count' => $row_count,
            'total_page' => $total_page,
            'page_no' => $page_no,
            'page_size' => $page_size,
            'list' => $list
        );

        return $rs;
    }

    public function getForUD($employeeId){
        $model = new Model_Employee();

        return $model->getForUD($employeeId);
    }
}