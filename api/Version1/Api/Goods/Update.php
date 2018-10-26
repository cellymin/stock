<?php

class Api_Goods_Update extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'goodsId'        => array('name' => 'goodsId', 'type' => 'int', 'min' => 1, 'require' => true),
                'goodsSn'        => array('name' => 'goodsSn', 'type' => 'string', 'require' => true),
                'goodsName'      => array('name' => 'goodsName', 'type' => 'string', 'require' => true),
                'goodsSpec'      => array('name' => 'goodsSpec', 'type' => 'string', 'require' => false),
                'goodsCateId1'   => array('name' => 'goodsCateId1', 'type' => 'int', 'min' => 1, 'require' => true),
                'goodsCateId2'   => array('name' => 'goodsCateId2', 'type' => 'int', 'min' => 0, 'require' => false),
                'goodsCateId'    => array('name' => 'goodsCateId', 'type' => 'int', 'min' => 0, 'require' => false),
                'goodsUnitId'    => array('name' => 'goodsUnitId', 'type' => 'int', 'min' => 1, 'require' => true),
                'productionDate' => array('name' => 'productionDate', 'type' => 'date', 'require' => true),
                'invalidDate'    => array('name' => 'invalidDate', 'type' => 'date', 'require' => true),
                'searchKey'      => array('name' => 'searchKey', 'type' => 'string', 'require' => false),
                'remark'         => array('name' => 'remark', 'type' => 'string', 'require' => false),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'goodsId' => '', 'msg' => '');

        if (DI()->userInfo['userGroup'] != 1) {
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员', 0);
        }

        $domain = new Domain_GoodsCate_CURD();
        $cate = $domain->get($this->goodsCateId1);
        if (!$cate) {
            $rs['msg'] = '一级分类不存在';
            return $rs;
        }

        $domain = new Domain_GoodsUnit_CURD();
        $unit = $domain->get($this->goodsUnitId);
        if (!$unit) {
            $rs['msg'] = '计量单位不存在';
            return $rs;
        }

        $input = array(
            'goodsSn'        => $this->goodsSn,
            'goodsName'      => $this->goodsName,
            'goodsSpec'      => $this->goodsSpec,
            'goodsCateId1'   => $this->goodsCateId1,
            'goodsCateId2'   => $this->goodsCateId2,
            'goodsCateId'    => $this->goodsCateId,
            'goodsUnitId'    => $this->goodsUnitId,
            'productionDate' => $this->productionDate,
            'invalidDate'    => $this->invalidDate,
            'searchKey'      => $this->searchKey,
            'remark'         => $this->remark,
        );

        $domain = new Domain_Goods_CURD();
        $goods = $domain->getForUD($this->goodsId);
        if (!$goods) {
            $rs['msg'] = '没有权限';
            return $rs;
        }

        $goodsId = $domain->update($this->goodsId, $input);
        if ($goodsId === false) {
            $rs['msg'] = '保存失败';
            return $rs;
        }
        $rs['code'] = 1;
        $rs['goodsId'] = $this->goodsId;

        return $rs;
    }
}