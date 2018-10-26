<?php

class Api_GoodsCate_Update extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'cateId'   => array('name' => 'cateId', 'type' => 'int', 'min' => 1, 'require' => true),
                'parentId' => array('name' => 'parentId', 'type' => 'int', 'min' => 0, 'require' => true),
                'cateName' => array(
                    'name'    => 'cateName',
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

        if (empty($this->cateNo)) {
            throw new PhalApi_Exception_BadRequest('请输入分类编号', 0);
        }

        $domain = new Domain_GoodsCate_CURD();

        $cate = $domain->getForUD($this->cateId);
        if (!$cate) {
            $rs['msg'] = '分类不存在';
            return $rs;
        }

        if ($this->cateId == $this->parentId) {
            $rs['msg'] = '不能选择自己作为父级分类';
            return $rs;
        }

        $parent = array();
        if ($this->parentId) {
            $parent = $domain->getForUD($this->parentId);
            if (!$parent) {
                $rs['msg'] = '父级分类不存在';
                return $rs;
            }
        }

        if ($cate['cateNo']!=$this->cateNo && $domain->cateNoIsExists($this->cateNo)) {
            throw new PhalApi_Exception_BadRequest('分类编号已存在', 0);
        }

        $input = array(
            'parentId' => $this->parentId,
            'ppid'     => $this->parentId ? $parent['parentId'] : 0,
            'cateName' => $this->cateName,
            'cateSort' => $this->cateSort,
            'cateNo'   => $this->cateNo,
        );

        $cateId = $domain->update($this->cateId, $input);
        if ($cateId === false) {
            $rs['msg'] = '保存失败';
            return $this;
        }
        $rs['code'] = 1;
        $rs['cateId'] = $this->cateId;
        return $rs;
    }
}