<?php

class Api_Order_Change extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'type' => array('name' => 'type', 'type' => 'enum', 'range' => array('PLAN', 'ARRIVAL', 'RETURN', 'PURCHASE_IN', 'ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY', 'OTHER_IN', 'OTHER_OUT','SALE_OUT','SALE_RETURN'), 'require' => true),
                'orderId' => array('name' => 'orderId', 'type' => 'int', 'min' => 1, 'require' => true),

            )
        );
    }

    public function go(){
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        try{
            DI()->notorm->beginTransaction('db_demo');
            $type=$this->type;
            if ($type=='SALE_RETURN'){
                $saleOrder=DI()->notorm->orders_so->select('customerId','totalMoney','totalCnt','flag')->where('orderId',$this->orderId)->fetch();
            }elseif($type=='RETURN'){
                $saleOrder=DI()->notorm->orders_dh->select('supplierId','totalMoney','totalCnt','flag')->where('orderId',$this->orderId)->fetch();
            }else if($type == 'USE_OUT'){
                $saleOrder=DI()->notorm->orders_oy->select('supplierId','depotId','totalMoney','totalCnt','flag','orderNo')->where('orderId',$this->orderId)->fetch();
            }
            if ($saleOrder['flag']!=3){
                $rs['msg']='请选择审核通过订单';
                return $rs;
            }
            if ($type=='SALE_RETURN'){
                $returnOrder=array(
                    'orderNo'=>'SR'. date('ymdHis') . rand(1000, 9999),
                    'customerId'=>$saleOrder['customerId'],
                    'totalMoney'=>$saleOrder['totalMoney'],
                    'totalCnt'=>$saleOrder['totalCnt'],
                    'flag'=>0,
                    'createCompany'=>DI()->userInfo['companyId'],
                    'contactNo'=>$saleOrder['orderNo'],
                    'createUser'=>DI()->userInfo['userId'],
                    'createTime' => date('Y-m-d H:i:s')
                );
                $orderId=DI()->notorm->orders_soth->insert($returnOrder);
                $goodsList=DI()->notorm->orders_so_goods->select('orderSubNo','depotGoodsId','goodsId','depotSubId','depotId'
                    ,'goodsCnt','goodsPrice')->where('orderId',$this->orderId)->where('flag',1)->fetchAll();
                foreach($goodsList as $k=>$v){
                    $returnList[]=$input=array(
                        'orderId'=>$orderId,
                        'orderSubNo'=>$v['orderSubNo'],
                        'depotGoodsId'=>$v['depotGoodsId'],
                        'goodsId'=>$v['goodsId'],
                        'depotSubId'=>$v['depotSubId'],
                        'depotId'=>$v['depotId'],
                        'goodsCnt'=>$v['goodsCnt'],
                        'goodsPrice'=>$v['goodsPrice'],
                        'flag'=>1,
                        'createCompany'=>DI()->userInfo['companyId'],
                        'createUser'=>DI()->userInfo['userId'],
                        'createTime'=>date('Y-m-d H:i:s')
                    );
                    DI()->notorm->orders_soth_goods->insert($input);
                }
                DI()->notorm->commit('db_demo');
                $rs['code'] = 1;
                $rs['msg'] = '退货单生成成功';
                return $rs;
            }elseif($type=='RETURN') {

                $returnOrder = array(
                    'orderNo' => 'TH'.date('ymdHis').rand(1000, 9999),
                    'supplierId' => $saleOrder['supplierId'],
                    'totalMoney' => $saleOrder['totalMoney'],
                    'totalCnt' => $saleOrder['totalCnt'],
                    'flag' => 0,
                    'createCompany' => DI()->userInfo['companyId'],
                    'contactNo'=>$saleOrder['orderNo'],
                    'createUser' => DI()->userInfo['userId'],
                    'createTime' => date('Y-m-d H:i:s')
                );
                $orderId = DI()->notorm->orders_th->insert($returnOrder);
                $goodsList = DI()->notorm->orders_dh_goods->select(
                    'orderSubNo',
                    'supplierId',
                    'goodsId',
                    'depotSubId',
                    'depotId',
                    'goodsCnt',
                    'goodsPrice'
                )->where('orderId', $this->orderId)->where('flag', 1)->fetchAll();
                foreach ($goodsList as $k => $v) {
                    $returnList[] = $input = array(
                        'orderId' => $orderId,
                        'orderSubNo' => $v['orderSubNo'],
                        'supplierId' => $v['supplierId'],
                        'goodsId' => $v['goodsId'],
                        'depotSubId' => $v['depotSubId'],
                        'depotId' => $v['depotId'],
                        'goodsCnt' => $v['goodsCnt'],
                        'goodsPrice' => $v['goodsPrice'],
                        'flag' => 1,
                        'createCompany' => DI()->userInfo['companyId'],
                        'createUser' => DI()->userInfo['userId'],
                        'createTime' => date('Y-m-d H:i:s')
                    );
                    DI()->notorm->orders_th_goods->insert($input);
                }

                DI()->notorm->commit('db_demo');
                $rs['code'] = 1;
                $rs['msg'] = '退货单生成成功';
                return $rs;
            }else if($type == 'USE_OUT'){
                //领用退货单
                $returnOrder=array(
                    'orderNo'=>'UR'. date('ymdHis') . rand(1000, 9999),
                    'supplierId' => $saleOrder['supplierId'],
                    'depotId' => $saleOrder['depotId'],
                    'totalMoney'=>$saleOrder['totalMoney'],
                    'totalCnt'=>$saleOrder['totalCnt'],
                    'flag'=>0,
                    'createCompany'=>DI()->userInfo['companyId'],
                    'createUser'=>DI()->userInfo['userId'],
                    'createTime' => date('Y-m-d H:i:s'),
                    'contactNo' => $saleOrder['orderNo']
                );
                $orderId=DI()->notorm->orders_oyth->insert($returnOrder);
                $goodsList=DI()->notorm->orders_oy_goods->select('orderSubNo','depotGoodsId','goodsId','depotSubId','depotId'
                    ,'goodsCnt','goodsPrice')->where('orderId',$this->orderId)->where('flag',1)->fetchAll();
                foreach($goodsList as $k=>$v){
                    $returnList[]=$input=array(
                        'orderId'=>$orderId,
                        'orderSubNo'=>$v['orderSubNo'],
                        'depotGoodsId'=>$v['depotGoodsId'],
                        'goodsId'=>$v['goodsId'],
                        'depotSubId'=>$v['depotSubId'],
                        'depotId'=>$v['depotId'],
                        'goodsCnt'=>$v['goodsCnt'],
                        'goodsPrice'=>$v['goodsPrice'],
                        'flag'=>1,
                        'createCompany'=>DI()->userInfo['companyId'],
                        'createUser'=>DI()->userInfo['userId'],
                        'createTime'=>date('Y-m-d H:i:s')
                    );
                    DI()->notorm->orders_soth_goods->insert($input);
                }
                DI()->notorm->commit('db_demo');
                $rs['code'] = 1;
                $rs['msg'] = '退货单生成成功';
                return $rs;
            }
        }catch (PDOException $e){
            DI()->notorm->rollback('db_demo');
            throw new PhalApi_Exception_InternalServerError('服务器错误', 0);
        }

    }
}