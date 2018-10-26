<?php

class Api_Reviewer_Options extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'type' => array('name' => 'type', 'type' => 'enum', 'range' => array('supplier','PLAN', 'ARRIVAL', 'RETURN', 'PURCHASE_IN', 'ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY','SALE_OUT'), 'reuqire' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content', 'msg' => '');

        $domain = new Domain_Reviewer_Options();

        $list = $domain->getReviewers($this->type);
        if (!$list) {
            return $rs;
        }

        $rs['code'] = 1;
        $rs['content'] = $list;
        return $rs;
    }
}