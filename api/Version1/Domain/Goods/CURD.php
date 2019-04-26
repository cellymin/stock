<?php

class Domain_Goods_CURD
{
    public function insert($input,$code)
    {
        $model = new Model_Goods();

        return $model->add($input,$code);
    }

    public function update($goodsId,$input){
        $model = new Model_Goods();

        return $model->update($goodsId,$input);
    }

    public function delete($goodsId){
        $model = new Model_Goods();

        return $model->delete($goodsId);
    }

    public function get($goodsId)
    {
        $model = new Model_Goods();

        return $model->get($goodsId, 'goodsId,goodsSn,goodsBarCode,goodsName,goodsSpec,goodsCateId1,goodsCateId2,goodsCateId,goodsUnitId,lastPrice,minPrice,maxPrice,avgPrice,productionDate,invalidDate,searchKey,remark');
    }
    public function getInfo($goodsBarCode){
        $model = new Model_Goods();
        return $model->getInfo($goodsBarCode, 'goodsId,goodsSn,goodsBarCode,goodsName,goodsSpec,goodsCateId1,goodsCateId2,goodsCateId,goodsUnitId,lastPrice,minPrice,maxPrice,avgPrice,productionDate,invalidDate,searchKey,remark');
    }
    public function getForOrder($goodsId){
        $model = new Model_Goods();

        return $model->getForOrder($goodsId, 'goodsId,goodsSn,goodsBarCode,goodsName,goodsSpec,goodsCateId1,goodsCateId2,goodsCateId,goodsUnitId,lastPrice,minPrice,maxPrice,avgPrice,usecostpri,productionDate,invalidDate,searchKey,remark');
    }

    public function getForUD($goodsId){
        $model = new Model_Goods();

        return $model->getForUD($goodsId, 'goodsId,goodsSn,goodsBarCode,goodsName,goodsSpec,goodsCateId1,goodsCateId2,goodsCateId,goodsUnitId,lastPrice,minPrice,maxPrice,avgPrice,productionDate,invalidDate,searchKey,remark');
    }

    public function getForName($goodsName)
    {
        $model = new Model_Goods();

        return $model->getForName($goodsName, 'goodsId');
    }


    public function getList($page_no, $page_size, $keyword, $goodsCateId)
    {
        $model = new Model_Goods();

        //总条数
        $row_count = $model->count($keyword, $goodsCateId);
        $total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
        $total_page = $total_page < 1 ? 1 : $total_page;
        $page_no = $page_no > ($total_page) ? ($total_page) : $page_no;
        $start = ($page_no - 1) * $page_size;
        if($page_size==999){
            $list = $model->getList($start,0, $keyword, $goodsCateId);
        } else {
            $list = $model->getList($start, $page_size, $keyword, $goodsCateId);
        }

        $rs = array(
            'row_count' => $row_count,
            'total_page' => $total_page,
            'page_no' => $page_no,
            'page_size' => $page_size,
            'list' => $list
        );

        return $rs;
    }

    public function getListV2($page_no, $page_size, $keyword, $goodsCateId)
    {
        $model = new Model_Goods();

        //总条数
        $row_count = $model->count($keyword, $goodsCateId);
        $total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
        $total_page = $total_page < 1 ? 1 : $total_page;
        $page_no = $page_no > ($total_page) ? ($total_page) : $page_no;
        $start = ($page_no - 1) * $page_size;

        $list = $model->listAll($start, $page_size, $keyword, $goodsCateId);

        $rs = array(
            'row_count' => $row_count,
            'total_page' => $total_page,
            'page_no' => $page_no,
            'page_size' => $page_size,
            'list' => $list
        );

        return $rs;
    }
    public function  getRequestList($page_no, $page_size, $keyword, $status){
       $model = new Model_Goods();
       $count = $model->countRequest($keyword,$status);
       if($count){
           $row_count = $count[0]['count'];
           $total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
           $total_page = $total_page < 1 ? 1 : $total_page;
           $page_no = $page_no > ($total_page) ? ($total_page) : $page_no;
           $start = ($page_no - 1) * $page_size;
       }
       $list = $model->getRequestList($start,$page_size,$keyword,$status);
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