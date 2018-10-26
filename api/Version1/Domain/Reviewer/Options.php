<?php

class Domain_Reviewer_Options
{
    public function getReviewers($type)
    {
        $rs = array();
        $model = new Model_User();

        $role = $this->getRole($type);
        $users = $model->getReviewers($role);

        if (!$users) {
            return $rs;
        }

        foreach ($users as $row) {
            $rs[$row['user_id']] = $row['user_name'];
        }
        return $rs;
    }

    public function getRole($type)
    {
        $roles = array(
            'supplier'  => 175,
            'PLAN'      => 193,
            'ARRIVAL'   => 194,
            'RETURN'    => 195,
            'PURCHASE_IN'   => 196,
            'ALLOT_IN'      => 198,
            'ALLOT_OUT'     => 201,
            'USE_OUT'       => 199,
            'INVENTORY'     => 202,
            'SALE_OUT'=>275
        );

        $role = array_key_exists($type, $roles) ? $roles[$type] : 0;

        return $role;
    }
}