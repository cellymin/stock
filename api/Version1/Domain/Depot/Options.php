<?php

class Domain_Depot_Options
{
    public function get()
    {
        $model = new Model_Depot();
        $options = array();

        $list = $model->getForOptions();
        if ($list) {
            foreach ($list as $row) {
                $options[$row['depotId']] = $row['depotName'];
            }
        }

        return $options;
    }
}