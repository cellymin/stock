<?php

class Domain_Depot_CURD
{

    public function insert($input)
    {
        $model = new Model_Depot();

        return $model->insert($input);
    }

    public function update($depotId,$input){
        $model = new Model_Depot();

        return $model->update($depotId,$input);
    }

    public function rmDefault($depotId){
        $model = new Model_Depot();

        return $model->rmDefault($depotId);
    }

    public function delete($depotId){
        $model = new Model_Depot();

        return $model->delete($depotId);
    }

    public function get($depotId)
    {
        $model = new Model_Depot();

        return $model->get($depotId);
    }

    public function getForUD($depotId){
        $model = new Model_Depot();

        return $model->getForUD($depotId);
    }

    public function getList()
    {
        $rs = array();
        $model = new Model_Depot();

        $list = $model->getList();

        return $list;
    }
}