<?php

/**
 * 商品单位
 * Class Api_GoodsUnit_Insert
 */
class Api_GoodsUnit_Insert extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'unitName' => array('name' => 'unitName', 'type' => 'string', 'min' => 1, 'max' => 15, 'format' => 'utf8', 'require' => true),
                'unitNo' => array('name' => 'unitNo', 'type' => 'string', 'min' => 1, 'max' => 15, 'format' => 'utf8', 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'unitId' => '', 'msg' => '');

        if(DI()->userInfo['userGroup']!=1){
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员',3);
        }

        $input = array(
            'unitName' => $this->unitName,
            'unitNo' =>$this->unitNo,
            'flag' => 1,
            'createCompany' => DI()->userInfo['companyId'],
            'createUser' =>  DI()->userInfo['userId'],
            'createTime' => date('Y-m-d H:i:s')
        );

        $domain = new Domain_GoodsUnit_CURD();
        $unitId = $domain->insert($input);
        if ($unitId === false) {
            $rs['msg'] = '保存失败';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['unitId'] = $unitId;
        return $rs;
    }
}