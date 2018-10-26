<?php

class Domain_Supplier_CURD
{
    public function insert($input)
    {
        $model = new Model_Supplier();

        return $model->insert($input);
    }

    public function update($supplierId, $input)
    {
        $model = new Model_Supplier();

        return $model->update($supplierId, $input);
    }

    public function delete($supplierId)
    {
        $model = new Model_Supplier();

        return $model->delete($supplierId);
    }

    public function review($supplierId)
    {
        $model = new Model_Supplier();

        return $model->update($supplierId, array('flag' => '1'));
    }

    public function get($supplierId)
    {
        $model = new Model_Supplier();

        return $model->get($supplierId);
    }

    public function getForOrder($supplierId)
    {
        $model = new Model_Supplier();

        return $model->getForOrder($supplierId);
    }

    public function getForUD($supplierId)
    {
        $model = new Model_Supplier();

        return $model->getForUD($supplierId);
    }

    public function getList($page_no, $page_size, $keyword, $status)
    {
        $model = new Model_Supplier();

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