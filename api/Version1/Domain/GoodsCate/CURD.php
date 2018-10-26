<?php

class Domain_GoodsCate_CURD
{
    static $arr;

    public function insert($input)
    {
        $model = new Model_GoodsCate();

        return $model->insert($input);
    }

    public function update($cateId, $input)
    {
        $model = new Model_GoodsCate();

        return $model->update($cateId, $input);
    }

    public function delete($cateId)
    {
        $model = new Model_GoodsCate();

        $id = $model->delete($cateId);
        if ($id === false) {
            return false;
        }
        foreach ($cateId as $row) {
            $ids = $model->getChildIds($row);

            if ($ids['ids']) {
                $ids = explode(',', $ids['ids']);
                $this->delete($ids);
            }
        }
        return true;
    }

    public function get($cateId)
    {
        $model = new Model_GoodsCate();

        return $model->get($cateId);
    }

    public function getForUD($cateId)
    {
        $model = new Model_GoodsCate();

        return $model->getForUD($cateId);
    }

    public function getList($parentId = 0, $level = 0)
    {
        $model = new Model_GoodsCate();

        $list = $model->getList($parentId);
        $level++;
        if ($list) {
            foreach ($list as &$row) {
                $row['level'] = $level;
                self::$arr[] = $row;
                $this->getList($row['cateId'], $level);
            }
        }

        return self::$arr;
    }


    public function cateNoIsExists($cateNo)
    {
        $model = new Model_GoodsCate();

        $cate = $model->getByCateNo($cateNo);
        if($cate){
            return $cate;
        }
        return false;
    }

    public function getChildByPid($parentId){
        $model = new Model_GoodsCate();
        $list = $model->getList($parentId);
        if($list){
            return $list;
        }
        return array();
    }
}