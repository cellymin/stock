<?php

class Domain_DepotSub_Options
{
    public function get($depotId)
    {
        $model = new Model_DepotSub();
        $options = array();

        $list = $model->getForOptions($depotId);
        if ($list) {
            foreach ($list as $row) {
                $options[$row['depotSubId']] = $row['depotSubName'];
            }
        }

        return $options;
    }
}