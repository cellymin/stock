<?php

class Api_Goods_UpdateName extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'goodsId'        => array('name' => 'goodsId', 'type' => 'int', 'min' => 1, 'require' => true),
                'goodsName'      => array('name' => 'goodsName', 'type' => 'string', 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'goodsId' => '', 'msg' => '');

        if (DI()->userInfo['userGroup'] != 1) {
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员', 0);
        }
        $input = array(
            'goodsName'      => $this->goodsName,
        );

        $domain = new Domain_Goods_CURD();
        $goods = $domain->getForUD($this->goodsId);
        if (!$goods) {
            $rs['msg'] = '没有权限';
            return $rs;
        }

        $ifexist = $domain->getForName($this->goodsName);
        if($ifexist){
            if($ifexist['goodsId'] == $this->goodsId){
                $rs['msg'] = '未修改';
                return $rs;
            }else{
                $rs['msg'] = '名称重复';
                return $rs;
            }
        }
        $goodsId = $domain->update($this->goodsId, $input);
        if ($goodsId === false) {
            $rs['msg'] = '保存失败';
            return $rs;
        }
        $rs['code'] = 1;
        $rs['goodsId'] = $this->goodsId;
        $rs['msg'] = '修改成功';
        return $rs;
    }
}