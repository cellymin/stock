<?php

class Domain_Customer_CURD
{

    public function insert($input)
    {
        $model = new Model_Customer();

        return $model->insert($input);
    }

    public function update($customerId,$input){
        $model = new Model_Customer();

        return $model->update($customerId,$input);
    }

    public function delete($customerId){
        $model = new Model_Customer();

        return $model->delete($customerId);
    }

    public function get($customerId)
    {
        $model = new Model_Customer();

        return $model->get($customerId, 'customerId,customerName,customerAddress,customerUserName,customerUserPhone,customerUserEmail');
    }

    public function getForUD($customerId){
        $model = new Model_Customer();

        return $model->getForUD($customerId, 'customerId,customerName,customerAddress,customerUserName,customerUserPhone,customerUserEmail');
    }

    public function getList($page_no, $page_size, $keyword)
    {
        $model = new Model_Customer();

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

    public function options(){
        $model = new Model_Customer();
        $list = $model->listAll();
        $options=array();
        if($list){
            foreach ($list as $row){
                $options[$row['customerId']] = $row['customerName'];
            }
            return $options;
        }
        return array();
    }
}