<?php

/**
 * 新增产品分类
 * Class Api_GoodsCate_Insert
 */
class Api_GoodsCate_Insert extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'parentId' => array('name' => 'parentId', 'type' => 'int', 'min' => 0, 'require' => true),
                'cateName' => array('name'    => 'cateName',
                                    'type'    => 'string',
                                    'min'     => 1,
                                    'max'     => 15,
                                    'format'  => 'utf8',
                                    'require' => true
                ),
                'cateSort' => array('name' => 'cateSort', 'type' => 'int', 'min' => 1, 'require' => true),
                'cateNo'   => array('name' => 'cateNo', 'type' => 'string', 'require' => true)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'cateId' => '', 'msg' => '');

        if (DI()->userInfo['userGroup'] != 1) {
            throw new PhalApi_Exception_BadRequest('没有权限,您不是超级管理员', 3);
        }

        //验证
        if(empty($this->cateNo)){
            throw new PhalApi_Exception_BadRequest('请输入分类编号', 0);
        }

        $domain = new Domain_GoodsCate_CURD();

        if($domain->cateNoIsExists($this->cateNo)){
            throw new PhalApi_Exception_BadRequest('分类编号已存在', 0);
        }

        $parent = array();
        if ($this->parentId) {
            $parent = $domain->getForUD($this->parentId);
            if (!$parent) {
                $rs['msg'] = '父级分类不存在';
                return $rs;
            }
        }

        $input = array(
            'parentId'      => $this->parentId,
            'ppid'          => $this->parentId ? $parent['parentId'] : 0,
            'cateName'      => $this->cateName,
            'cateSort'      => $this->cateSort,
            'cateNo'        => $this->cateNo,
            'flag'          => 1,
            'createCompany' => DI()->userInfo['companyId'],
            'createUser'    => DI()->userInfo['userId'],
            'createTime'    => date('Y-m-d H:i:s')
        );

        $cateId = $domain->insert($input);
        if ($cateId === false) {
            $rs['msg'] = '保存失败';
            return $this;
        }
        $rs['code'] = 1;
        $rs['cateId'] = $cateId;
        return $rs;
    }
}