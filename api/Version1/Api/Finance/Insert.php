<?php

class Api_Finance_Insert extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'money'      => array('name' => 'money', 'type' => 'float', 'min' => 0, 'require' => true),
                'type'       => array('name' => 'type', 'type' => 'enum', 'range' => array(1, 2), 'require' => true),
                'cate'       => array('name'    => 'cate',
                                      'type'    => 'enum',
                                      'range'   => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10),
                                      'require' => true
                ),
                'remark'     => array('name' => 'remark', 'type' => 'string', 'require' => false),
                'invoiceIds' => array('name'    => 'invoiceIds',
                                      'type'    => 'array',
                                      'format'  => 'explode',
                                      'require' => false
                ),
            )
        );
    }

    public function go()
    {
        if (($this->cate==8 || $this->type==9) && !is_array($this->invoiceIds)) {
            throw new PhalApi_Exception_BadRequest('参数错误', 0);
        }

        $rs = array('code' => 0, 'financeId' => '', 'msg' => '');

        $domain = new Domain_Finance_CURD();

        $data = array(
            'invoiceIds' => $this->invoiceIds,
            'money'      => $this->money,
            'remark'     => $this->remark,
            'type'       => $this->type,
            'cate'       => $this->cate,
        );

        $id = $domain->insert($data);
        if ($id) {
            $rs['code'] = 1;
            $rs['financeId'] = $id;
            return $rs;
        }
        $rs['msg'] = '保存失败';
        return $rs;
    }
}