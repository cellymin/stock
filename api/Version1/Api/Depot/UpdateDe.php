<?php

class Api_Depot_UpdateDe extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'orderId' => array('name' => 'orderId', 'type' => 'int', 'require' => true),
                'oldGoosNamesstr' => array('name' => 'oldGoosNamesstr', 'type' => 'array', 'format' => 'explode', 'require' => false),
                'goosL' => array('name' => 'goosL', 'type' => 'array', 'format' => 'json', 'require' => true),
                'supplierId' => array('name' => 'suppId', 'type' => 'int', 'require' => true),
                'depotId' => array('name' => 'depotId', 'type' => 'int', 'require' => true),
                'depotSubId' => array('name' => 'depotSubId', 'type' => 'int', 'require' => true),
                'toalNum' => array('name' => 'toalNum', 'type' => 'float', 'require' => true),
                'totalPri' => array('name' => 'totalPri', 'type' => 'float', 'require' => true),
                'taxrate' => array('name' => 'taxrate', 'type' => 'float', 'require' => true),
                'beizhu' => array('name' => 'beizhu', 'type' => 'string', 'require' => false),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $domain = new Domain_Depot_CURD();

        $depot = $domain->get($this->depotId);
        if (!$depot) {
            $rs['msg'] = '仓库不存在';
            return $rs;
        }
        $suppmodel = new Model_Supplier();
        $supplier = $suppmodel->getForOrder($this->supplierId);
        if(!$supplier){
            $rs['msg'] = '供应商不存在';
            return $rs;
        }
        $supplierId = $this->supplierId;
        $depotId = $this->depotId;
        $depotSubId = $this->depotSubId;
        $goosL =$this->goosL;
        try {
            DI()->notorm->beginTransaction('db_demo');
            $orderInfo = array(
                'supplierId' => $supplierId,
                'totalMoney' => $this->totalPri,
                'totalCnt' => $this->toalNum,
                'flag' => 0,
                'updateUser' =>  DI()->userInfo['userId'],
                'updateTime' => date('Y-m-d H:i:s'),
                'remark' => $this->beizhu,
            );
            $goodsmodel = new Model_OrderGoods();
            $log_model = new Model_LogOrder();
            $res = DI()->notorm->orders_ip->where('orderId',$this->orderId)->update($orderInfo);
            if ($res>0) {
                $orderId = $this->orderId;
                foreach ($goosL as $k => $v) {
                    if (empty($v['goodsId'])) {
                        $rs['msg'] = '没有商品ID';
                        return $rs;
                    }
                    $input = array(
                        'supplierId' => $supplierId,
                        'goodsId' => $v['goodsId'],
                        'orderId' => $orderId,
                        'goodsCnt' => $v['goodsCnt'],
                        'depotId' => $depotId,
                        'depotSubId' => $depotSubId,
                        'goodsPrice' => $v['goodsPrice'],//成本价
                        'ratepri' => $v['ratepri'],//含税价
                        'usecostpri' => $v['usecostpri'],//不含税价
                        'orderSubNo' => 'PN' . date('ymdHis') . rand(1000, 9999),
                        'flag' => 1,
                        'createUser' => DI()->userInfo['userId'],
                        'createTime' => date('Y-m-d H:i:s')

                    );

                    if(!empty($this->oldGoosNamesstr) && in_array($v['goodsId'],$this->oldGoosNamesstr)){
                        unset($input['goodsId']);
                        unset($input['orderId']);
                        unset($input['orderSubNo']);
                        unset($input['createUser']);
                        unset($input['createTime']);
                        $rrid = DI()->notorm->orders_ip_goods->where('orderId',$orderId)->where('goodsId',$v['goodsId'])->update($input);
                        if($rrid>0){
                            $logId[] = $log_model->insert(array(
                                'logUser' => DI()->userInfo['userId'],
                                'logType' => 'UPDATE',
                                'logContent' => json_encode($input),
                                'orderId' => $orderId,
                                'orderType' => 'PURCHASE_IN',
                                'createTime' => date('Y-m-d H:i:s')
                            ));
                        }
                    }else{
                        DI()->notorm->orders_ip_goods->insert($input);
                        $logId[] = $log_model->insert(array(
                            'logUser' => DI()->userInfo['userId'],
                            'logType' => 'INSERT',
                            'logContent' => json_encode($input),
                            'orderId' => $orderId,
                            'orderType' => 'PURCHASE_IN',
                            'createTime' => date('Y-m-d H:i:s')
                        ));
                    }
                }
            }
            DI()->notorm->commit('db_demo');
            $rs['code'] = 1;
            $rs['msg'] = '提交成功';
            return $rs;

        } catch (PDOException $e) {
            DI()->notorm->rollback('db_demo');
            throw new PhalApi_Exception_InternalServerError('服务器错误', 0);
        }
        $rs['code'] = 1;
        $rs['msg'] = '保存成功';
        return $rs;
    }
}