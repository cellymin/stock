<?php

/**
 * 更新计量单位信息
 * Class Api_GoodsUnit_Update
 */
class Api_GoodsUnit_Update extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'unitName' => array('name' => 'unitName', 'type' => 'string', 'min' => 1, 'max' => 15, 'format' => 'utf8', 'require' => true),
                'unitNo' => array('name' => 'unitNo', 'type' => 'string', 'min' => 1, 'max' => 15, 'format' => 'utf8', 'require' => true),
                'unitId' => array('name' => 'unitId', 'type' => 'int', 'min' => 1, 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'unitId' => '', 'msg' => '');

        if (DI()->userInfo['userGroup'] != 1) {
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员', 0);
        }

        $domain = new Domain_GoodsUnit_CURD();

        $unit = $domain->getForUD($this->unitId);
        if (!$unit) {
            $rs['msg'] = '计量单位不存在';
            return $rs;
        }

        $input = array(
            'unitName' => $this->unitName,
            'unitNo' =>$this->unitNo
        );

        $unitId = $domain->update($this->unitId, $input);
        if ($unitId === false) {
            $rs['msg'] = '保存失败';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['unitId'] = $this->unitId;
        return $rs;
    }
}