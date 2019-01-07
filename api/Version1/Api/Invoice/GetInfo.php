<?php

/**
 * Created by PhpStorm.
 * User: b
 * Date: 2017/8/31
 * Time: 15:18
 */
class Api_Invoice_GetInfo extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go'=>array(
                'invoiceId' => array('name'    => 'invoiceId',
                    'type'    => 'array',
                    'format'  => 'explode',
                    'require' => true
                ),
                'lionIds' => array('name' => 'lionIds',
                    'type'    => 'array',
                    'format'  => 'explode',
                    'require' => false
                ),
                'lionNo' =>array('name' => 'lionNo','type' => 'string','require' => false)
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $goodinfo = array();
        $domain = new Domain_Invoice_CURD();
        $list = $domain->getIndoById($this->invoiceId);
        $goods = $list['goods'];
        $order = $list['order'];
        foreach ($this->invoiceId as $k=>$v){
           foreach ($goods as $kk=>$vv){
               if(intval($v)==$vv['invoiceId']){
                   $goodinfo[$v][]=$vv;
                   $tt[$v] = count( $goodinfo[$v]);
               }
           }
        }
        $orderNo = array();
        foreach ($order as $k=>$v){
            $orderNo[$v['invoiceId']]['ifhe'] = 0;//未合并
            if(!empty($this->lionIds)){
                if(in_array($v['invoiceId'],$this->lionIds)){
                    $orderNo[$v['invoiceId']]['ifhe'] = 1;
                }
            }
            $orderNo[$v['invoiceId']]['orderNo'] = $v['orderNo'];
        }
        if ($list) {
            $rs['code'] = 1;
            $rs['content'] = $goodinfo;
            $rs['order'] = $orderNo;
            $rs['count'] = count($goods);
            $rs['kk'] = $tt;
        }
        unset($list);
        unset($goods);
        unset($order);
        unset($goodinfo);
        unset($orderNo);
        unset($tt);
        $rs['msg'] = '没有数据';

        return $rs;
    }

}