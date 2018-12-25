<?php
class Domain_User_CURD
{
    public function insert($input)
    {
        $model = new Model_User();

        return $model->insert($input);
    }

    public function update($user_id,$input){
        $model = new Model_User();

        return $model->update($user_id,$input);
    }

    public function delete($user_id){
        $model = new Model_User();

        return $model->delete($user_id);
    }

//    app接口路由
    public function checkPassword($user_name,$password){
        $model = new Model_User();
        return $model->checkPassword($user_name,$password);
    }
}