<?php

class Domain_Goods_Code
{
    public function create()
    {
        //判断是否存在已获取的的条码
        $code = $this->getByUser(DI()->userInfo['userId']);

        if (!$code) {
            $input['createUser'] = DI()->userInfo['userId'];

            $model = new Model_Code();
            $id = $model->insert($input);
            if ($id === false) {
                return false;
            }

            return $id;
        }

        return $code['code'];
    }

    public function getByCode($code)
    {
        $model = new Model_Code();

        return $model->getByCode($code);
    }

    public function getByUser($userId)
    {
        $model = new Model_Code();

        return $model->getByUser($userId);
    }
}