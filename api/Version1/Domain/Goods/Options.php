<?php

class Domain_Goods_Options
{
    public function get($goodsCateId)
    {
        $model = new Model_Goods();

        $options = array();
        $list = $model->options($goodsCateId);
        if ($list) {
            foreach ($list as $item) {
                $options[$item['goodsId']] = $item['goodsName'];
            }
        }

        return $options;
    }

}