<?php

class Domain_Order_Delete
{
    public $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function del($orderId)
    {
        $model = new Model_Order();

        if (!is_array($orderId)) {
            throw new PhalApi_Exception_BadRequest('参数错误', 1);
        }

        $flag = 0;
        //验证
        foreach ($orderId as $id) {
            $order = $model->get($id);
            if (!$order || !in_array($order['flag'], array(0, 1, -3)) || (DI()->userInfo['userGroup']!=1 && DI()->userInfo['userId'] != $order['createUser'])) {
                $flag = 1;
                break;
            }
        }

        if ($flag == 1) {
            throw new PhalApi_Exception_BadRequest('存在不可操作项', 0);
        }

        return $model->delete($orderId);

    }
}