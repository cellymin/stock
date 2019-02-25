<?php

class Api_App_OutDepot extends PhalApi_Api
{
    protected function filterCheck()
    {
    }

    public function getRules()
    {
        return array(
            'set' => array(),
            'getInfo' => array(
                'goodsBarCode' => array(
                    'name' => 'goodsBarCode',
                    'type' => 'string',
                    'require' => true,
                ),
            ),
        );
    }

//获取出库部门、部门负责人及库位接口
    public function set()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');
        $domain = new Domain_Department_Options();
        $departmentList = $domain->appget();
        $rs['content']['department'] = $departmentList;
        $domain = new Domain_Depot_CURD();
        $depotList = $domain->getList();
        $rs['content']['depot'] = $depotList;

        if (isset($_POST['departmentId'])) {
            $departmentId = $_POST['departmentId'];
        }
        if (isset($departmentId)) {
            $domain = new Domain_Employee_Options();
            $options = $domain->appget(32, $departmentId);
            if ($options) {
                $rs['content']['employee'] = $options;
            } else {
                $rs['content']['employee'] = '';

                return $rs;
            }
        }
        $rs['code'] = 1;

        return $rs;
    }

//出库扫码获取商品信息接口
    public function getInfo()
    {
        $rs = array('code' => 0, 'content' => null, 'msg' => '');
        $domain = new Domain_Goods_CURD();
        $goods = $domain->getInfo($this->goodsBarCode);
        if (!$goods) {

            $rs['msg'] = '商品不存在';

            return $rs;
        }

        $domain = new Domain_DepotGoods_CURD();
        if (is_null($_POST['depotId'])||is_null($goods['goodsId'])){
            $rs['msg']='请选择仓库';
            return $rs;
        }

        $depotGoods = $domain->appget(intval($goods['goodsId']), intval($_POST['depotId']));
//        $rs['content']=$depotGoods;
//        return $rs;

        if (is_null($depotGoods)){
            $rs['msg']='库存异常';
            return $rs;
        }
        if (!is_null($depotGoods[0]['sumCnt'])) {
            if ($depotGoods[0]['sumCnt'] == 0) {
                $rs['msg'] = '商品库存不足';
                return $rs;
            }
        } else {
            $rs['msg'] = '库存商品不存在';

            return $rs;
        }

        $rs['code'] = 1;
        $rs['content']['goodsId'] = $goods['goodsId'];
        $rs['content']['goodsName'] = $goods['goodsName'];
        $rs['content']['goodsPrice'] = 0;
        $rs['content']['goodsCnt'] = $depotGoods[0]['sumCnt'];
        $rs['msg'] = '获取商品信息成功';

        return $rs;

    }

//出库单提交审核接口
    public function toReview()
    {
//        先创建出库单单号
        $rs = array('code' => 0, 'content' => null, 'msg' => '');

        try {
            DI()->notorm->beginTransaction('db_demo');
            $postModel = file_get_contents('php://input');
            $postModel = json_decode($postModel, true);
            $type = 'USE_OUT';
            $totalcnt = 0;
            $totalmoney = 0;
            $domain = new Domain_Order_Create();
            $domain->type = $type;
            $input = array();
            if (in_array($type, array('ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY'))) {
                $input['depotId'] = $_REQUEST['depotId'];
                $input['createUser'] = $_REQUEST['user_id'];
                $input['remark'] = null;
            }
            $orderId = $domain->appCreate($input);
            $log_model = new Model_LogOrder();
            if ($orderId == false) {
                $rs['msg'] = '单号创建失败';

                return $rs;
            }
//        再在订单商品表里插入出库单对应商品
            $id = $orderId['id'];

            if ($postModel['goodsList']) {

                foreach ($postModel['goodsList'] as $k => $v) {
                    $outputgoods[] = self::getBatchInfo($v['goodsId'], $v['num'],$input['depotId']);
                    foreach ($outputgoods[$k] as $kk => $vv) {
                        $input = array(
                            'orderId' => $id,
                            'goodsId' => $vv['goodsId'],
                            'supplierId'=>$vv['supplierId'],
                            'goodsPrice' => $vv['goodsPrice'],
                            'orderSubNo' => $vv['batchNo'],
                            'depotGoodsId' => $vv['depotGoodsId'],
                            'goodsCnt' => $vv['goodsCnt'],
                            'depotId' => $vv['depotId'],
                            'depotSubId' => $vv['depotSubId'],
                            'departmentId' => $_REQUEST['departmentId'],
                            'employeeId' => $_REQUEST['employeeId'],
                            'flag' => 1,
                            'createUser' => $_REQUEST['user_id'],
                            'createCompany' => 32,
                            'createTime' => date('Y-m-d H:i:s'),
                        );
                        $orderId = DI()->notorm->orders_oy_goods->insert($input);
                        if ($orderId === false) {
                            $rs['msg'] = '保存失败';

                            return $rs;
                        }
                        $totalcnt = floatval($vv['goodsCnt']) + $totalcnt;
                        $totalmoney = floatval($vv['goodsCnt']) * $vv['goodsPrice'] + $totalmoney;

                        $logId[] = $log_model->insert(array(
                            'logUser'    => intval($_REQUEST['user_id']),
                            'logType'    => 'INSERT',
                            'logContent' => json_encode($input),
                            'orderId'    => $id,
                            'orderType'  => 'USE_OUT',
                            'createTime' => date('Y-m-d H:i:s')
                        ));

                    }
                    $orderUpdate = array(
                        'totalMoney' => $totalmoney,
                        'totalCnt' => $totalcnt,
                        'updateTime' => date('Y-m-d H:i:s'),
                        'updateUser' => $_REQUEST['user_id'],
                    );
                    $num = DI()->notorm->orders_oy->where('orderId', $id)->update($orderUpdate);

                }
            } else {
                $rs['msg'] = '请保证至少一件商品';

                return $rs;
            }
            DI()->notorm->commit('db_demo');
            $rs['code'] = 1;
            $rs['msg'] = '提交审核成功';
            return $rs;
        } catch (PDOException $e) {
            DI()->notorm->rollback('db_demo');
            throw new PhalApi_Exception_InternalServerError('服务器错误', 0);
        }

    }

    public static function getBatchInfo($goodsTd, $goodsCnt,$depotId)
    {
        $list = DI()->notorm->depot_goods->select('id,batchNo,depotId,depotSubId,supplierId,goodsId,goodsPrice,goodsCnt')->where(
            'goodsId',
            $goodsTd
        )->where('flag', 1)->where('depotId',$depotId)->where('goodsCnt > ?',0)->fetchAll();
        foreach ($list as $k => $v) {
            $v['goodsCnt'] = floatval($v['goodsCnt']);
            $goodsCnt = floatval($goodsCnt);
            if ($v['goodsCnt'] != 0 && $v['goodsCnt'] < $goodsCnt) {
                $goodsCnt = $goodsCnt - $v['goodsCnt'];
                $uu[] = array(
                    'depotGoodsId' => $v['id'],
                    'goodsId' => $v['goodsId'],
                    'batchNo' => $v['batchNo'],
                    'depotSubId'=>$v['depotSubId'],
                    'goodsPrice'=>$v['goodsPrice'],
                    //  'orderId'    => $orderId,
                    'goodsCnt' => $v['goodsCnt'],
                    'depotId' => $v['depotId'],
                    //'departmentId' => $departmentId,
                    //  'employeeId'   => $employeeId,
                    // 'remark'       => $remark,
//                    'type'         => 'USE_OUT',
                    'supplierId' => $v['supplierId'],
                );
            } else {
                $uu[] = array(
                    'depotGoodsId' => $v['id'],
                    'goodsId' => $v['goodsId'],
                    'batchNo' => $v['batchNo'],
                    'depotSubId'=>$v['depotSubId'],
                    'goodsPrice'=>$v['goodsPrice'],
                    //  'orderId'    => $orderId,
                    'goodsCnt' => $goodsCnt,
                    'depotId' => $v['depotId'],
                    //'departmentId' => $departmentId,
                    //  'employeeId'   => $employeeId,
                    // 'remark'       => $remark,
//                    'type'         => 'USE_OUT',
                    'supplierId' => $v['supplierId'],
                );
                break;
            }
        }

        return $uu;

    }

}