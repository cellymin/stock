<?php

class Api_Goods_Delete extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'goodsId' => array('name' => 'goodsId', 'type' => 'array', 'format' => 'explode', 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'goodsId' => '', 'msg' => '');

        if (DI()->userInfo['userGroup'] != 1) {
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员', 0);
        }

        if(!is_array($this->goodsId)){
            $rs['msg'] = '参数错误';
            return $rs;
        }
        $domain = new Domain_Goods_CURD();

        $id = $domain->delete($this->goodsId);
        if ($id === false) {
            $rs['msg'] = '删除失败';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['goodsId'] = $this->goodsId;

        return $rs;
    }
}