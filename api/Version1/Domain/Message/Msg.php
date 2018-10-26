<?php

class Domain_Message_Msg
{
    public static function send($fromUser, $toUser, $content, $type, $companyId, $showType = 0)
    {
        $input = array(
            'fromUser'   => $fromUser,
            'toUser'     => $toUser,
            'content'    => $content,
            'type'       => $type,
            'companyId'  => $companyId,
            'showType'   => $showType,
            'flag'       => 0,
            'targetId'   => 0,
            'createTime' => date('Y-m-d H:i:s'),
        );

        $model = new Model_Message();
        return $model->insert($input);
    }

    //价格预警
    public static function priceWarning($goodsId, $companyId, $lastPrice, $thisPrice, $goodsName)
    {
        //查询公司的价格预警设置
        $setting = Model_MSettingPrice::searchPriceSetting($companyId, $goodsId);
        if ($setting) {
            $upSetting = $setting['upPercent'];     //上涨设置
            $downSetting = $setting['downPercent']; //下跌设置

            if ($lastPrice != 0 && $upSetting != 0 && $thisPrice > $lastPrice) {
                $percent = sprintf('%.2f', ($thisPrice - $lastPrice) / $lastPrice) * 100;
                if ($percent > $upSetting) {
                    //消息
                    return array('goodsName' => $goodsName, 'type' => 'up', 'value' => $percent);
                }
            }
            if ($lastPrice != 0 && $upSetting != 0 && $thisPrice < $lastPrice) {
                $percent = sprintf('%.2f', ($lastPrice - $thisPrice) / $lastPrice) * 100;
                if ($percent > $downSetting) {
                    //消息
                    return array('goodsName' => $goodsName, 'type' => 'down', 'value' => $percent);
                }
            }
        }
        return array();
    }

    public static function depotWarning($companyId, $userId)
    {
        $sets = Model_MSettingDepot::searchDepotSetting($companyId);

        if ($sets) {
            foreach ($sets as $set) {
                $count = Model_DepotGoods::sumCompanyDepotGoods($companyId, $set['depotSubId'], $set['goodsId']);
                if ($count <= $set['minWarnNum']) {
                    //发送消息
                    $count = $count ? $count : 0;
                    $content = '库存预警：库位:' . $set['depotSubName'] . ',商品:' . $set['goodsName'] . ',库存:' . $count;

                    self::send(0, $userId, $content, 1, $companyId, 1);
                }
            }
        }
    }

    public static function depotError($goodsCnt, $depotSubId, $batchNo, $toUser, $companyId, $type)
    {
        $depotSubName = Model_DepotSub::getName($depotSubId);

        if ($type == 'OTHER_OUT') {
            $content = '库存异常：库位:' . $depotSubName . ',商品批次:' . $batchNo . ',系统库存比盘点库存少数量：' . $goodsCnt;
        } else {
            $content = '库存异常：库位:' . $depotSubName . ',商品批次:' . $batchNo . ',系统库存比盘点库存多数量：' . $goodsCnt;
        }

        return self::send(0, $toUser, $content, 1, $companyId, 3);
    }

    public static function InvoiceWaning($companyId)
    {
        $list = Model_Invoice::searchNeedNotice($companyId);
        $msg_model = new Model_Message();
        if ($list) {
            foreach ($list as $item) {
                $exists = $msg_model->invoiceMsgExists($item['invoiceId']);
                if(!$exists){
                    $content = '催票提醒：发票号:' . $item['invoiceNo'] . ',预计收票时间:' . $item['endTime'];

                    $input = array(
                        'fromUser'   => 0,
                        'toUser'     => $item['createUser'],
                        'content'    => $content,
                        'type'       => 3,
                        'companyId'  => $companyId,
                        'showType'   => 4,
                        'flag'       => 0,
                        'targetId'   => $item['invoiceId'],
                        'createTime' => date('Y-m-d H:i:s'),
                    );
                    $model = new Model_Message();
                    $model->insert($input);
                }
            }
        }
    }

    public static function DeliverWarning($companyId){
        $list = Model_Order::getNeedSendDeliverMsg($companyId);
        $msg_model = new Model_Message();
        if ($list) {
            foreach ($list as $item) {
                $exists = $msg_model->invoiceMsgExists($item['orderId']);
                if(!$exists){
                    $content = '发货提醒：单号:' . $item['orderNo'] . ',预计发货时间:' . $item['deliverTime'];

                    $input = array(
                        'fromUser'   => 0,
                        'toUser'     => $item['reviewer'],
                        'content'    => $content,
                        'type'       => 3,
                        'companyId'  => $companyId,
                        'showType'   => 0,
                        'flag'       => 0,
                        'targetId'   => $item['orderId'],
                        'createTime' => date('Y-m-d H:i:s'),
                    );
                    $model = new Model_Message();
                    $model->insert($input);
                }
            }
        }
    }

}