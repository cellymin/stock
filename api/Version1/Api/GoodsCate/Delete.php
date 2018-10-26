<?php

class Api_GoodsCate_Delete extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'cateId' => array('name' => 'cateId', 'type' => 'array', 'format' => 'explode', 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'cateId' => '', 'msg' => '');
        if(!is_array($this->cateId)){
            $rs['msg'] = '参数错误';
            return $rs;
        }

        if(DI()->userInfo['userGroup']!=1){
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员',3);
        }

        $domain = new Domain_GoodsCate_CURD();

        $id = $domain->delete($this->cateId);
        if ($id === false) {
            $rs['msg'] = '删除失败';
            return $rs;
        }
        $rs['code'] = 1;
        $rs['cateId'] = $this->cateId;

        return $rs;
    }
}