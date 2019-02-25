<?php

/**
 * Created by PhpStorm.
 * User: b
 * Date: 2017/8/31
 * Time: 15:18
 */
class Api_Invoice_Get extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'invoiceId' => array('name' => 'invoiceId',
                    'type' => 'array',
                    'format' => 'explode',
                    'require' => true
                ),
                'action' => array('name' => 'action',
                    'type' => 'int',
                    'require' => false
                ),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $resid = '';
        $departprisum = 0;
        if (!is_array($this->invoiceId)) {
            throw new PhalApi_Exception_BadRequest('参数错误', 0);
        }
        if ($this->action) {
            $domain = new Domain_Invoice_CURD();
            if ($this->action == 2) {
                $listIds = $domain->getListInfo($this->invoiceId, 1);
            } else {
                $listIds = $domain->getListInfo($this->invoiceId);
            }
            if (!empty($listIds[1])) {
                $resid = explode(',', $listIds[1]);
                $this->invoiceId = array_unique(array_merge($this->invoiceId, $resid));
            } else if (!empty($listIds['invoiceids'])) {
                foreach ($listIds['invoiceids'] as $v) {
                    if ($resid == '') {
                        $resid = $v;
                    } else {
                        $resid .= ',' . $v;
                    }
                }
                if (!empty($resid)) {
                    $resid = explode(',', $resid);//合并调整表中所有id
                    $departid = array_unique(array_diff( $this->invoiceId,$resid));
                    if($departid){
                        $departpri = DI()->notorm->invoices->select('adjustamount')->where('invoiceId',$departid)->fetchAll();
                        if($departpri){
                            foreach ($departpri as $v){
                                $departprisum = $departprisum + floatval($v['adjustamount']);
                            }
                        }
                        $listIds['departprinum'] = $departprisum;
                    }
                    $this->invoiceId = array_unique(array_merge($this->invoiceId, $resid));
                    $listIds['inids'] = $this->invoiceId;
                }
            }else{ //合并表里没有
                $departpri = DI()->notorm->invoices->select('adjustamount')->where('invoiceId', $this->invoiceId)->fetchAll();
                if($departpri){
                    foreach ($departpri as $v){
                        $departprisum = $departprisum + floatval($v['adjustamount']);
                    }
                }
                $listIds['departprinum'] = $departprisum;
            }

            if ($this->action == 2) {
                $list = $domain->get($this->invoiceId, 1);
            } else {
                $list = $domain->get($this->invoiceId);
            }
            if ($list) {
                $rs['code'] = 1;
                $rs['content'] = $list;
                $rs['lionid'] = $listIds;
                return $rs;
            }
            $rs['msg'] = '没有数据';
            return $rs;
        } else {
            $domain = new Domain_Invoice_CURD();
            $list = $domain->get($this->invoiceId);
            if ($list) {
                $rs['code'] = 1;
                $rs['content'] = $list;
                return $rs;
            }
        }

        $rs['msg'] = '没有数据';

        return $rs;
    }

}