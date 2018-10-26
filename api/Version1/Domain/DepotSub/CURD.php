<?php

class Domain_DepotSub_CURD
{

    public function insert($input)
    {
        $model = new Model_DepotSub();

        return $model->insert($input);
    }

    public function update($depotSubId, $input)
    {
        $model = new Model_DepotSub();

        return $model->update($depotSubId, $input);
    }

    public function delete($depotSubId)
    {
        $model = new Model_DepotSub();

        return $model->delete($depotSubId);
    }

    public function get($depotSubId)
    {
        $model = new Model_DepotSub();

        return $model->get($depotSubId);
    }

    public function getForUD($depotSubId)
    {
        $model = new Model_DepotSub();

        return $model->getForUD($depotSubId);
    }

    public function getList($depotId)
    {
        $model = new Model_DepotSub();

        $list = $model->getList($depotId);

        if ($list) {
            $model = new Model_DepotGoods();

            foreach ($list as &$d) {
                $d['goods'] = $model->listAll($d['depotSubId']);
            }
        }

        return $list;
    }
}