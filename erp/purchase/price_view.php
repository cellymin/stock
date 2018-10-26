<?php
include '../include/init.inc.php';
$goodsId = $year = "";
extract($_GET, EXTR_IF_EXISTS);

if(empty($year)){
    $year = date("Y", time());
}

$thisYear = date('Y', time());
$years = array();
for ($i = 0; $i < 3; $i++) {
    $years[] = ($thisYear - $i);
}

if(!in_array($year,$years)){
    Common::closeWithMessage('年度错误','error');
}

$list = Goods::suppliersGoodsTop($goodsId, $year);
$myChart = array();
$myChart2 = array();
$priceTop = array();
if ($list) {
    //按供应商分组
    $groupBySupplier = array();
    $priceList = array();
    $totalCnt = 0;

    foreach ($list as $g) {
        if (!isset($groupBySupplier[$g['supplierId']])) {
            $groupBySupplier[$g['supplierId']]['supplierId'] = $g['supplierId'];
            $groupBySupplier[$g['supplierId']]['supplierName'] = $g['supplierName'];
            $groupBySupplier[$g['supplierId']]['supplierTel'] = $g['supplierTel'];
            $groupBySupplier[$g['supplierId']]['subTotalCnt'] = 0;
            $groupBySupplier[$g['supplierId']]['minPrice'] = $g['goodsPrice'];
        }
        $groupBySupplier[$g['supplierId']]['subTotalCnt'] += $g['goodsCnt'];

        if ($groupBySupplier[$g['supplierId']]['minPrice'] > $g['goodsPrice']) {
            $groupBySupplier[$g['supplierId']]['minPrice'] = $g['goodsPrice'];
        }

        $myChart['axis'][] = date('m-d', strtotime($g['createTime']));
        $myChart['series_data1'][] = $g['goodsPrice'];
        $myChart['series_data2'][] = $g['goodsCnt'];

        $totalCnt += $g['goodsCnt'];
    }

    function sortByPrice($a, $b)
    {
        return $a['minPrice'] > $b['minPrice'];
    }

    //按价格排序
    usort($groupBySupplier, "sortByPrice");

    $priceTop = array_slice($groupBySupplier, 0, 5);

    function sortByCnt($a, $b)
    {
        return $a['subTotalCnt'] < $b['subTotalCnt'];
    }

    usort($groupBySupplier, "sortByCnt");

    $cntTop = array_slice($groupBySupplier, 0, 5);

    $cntTopPercent = 0;
    $cnt = 0;
    $myChart2 = array();

    foreach ($cntTop as $g) {
        $percent = sprintf('%.2f', $g['subTotalCnt'] / $totalCnt) * 100;
        $myChart2['legend_data'][] = $g['supplierName'];
        $myChart2['series_data'][] = array(
            'value' => $g['subTotalCnt'],
            'name'  => $g['supplierName']
        );
        $cntTopPercent += $percent;
        $cnt += $g['subTotalCnt'];
    }

    $otherPercent = 100 - $cntTopPercent;
    if ($otherPercent != 0) {
        $myChart2['legend_data'][] = '其他';
        $myChart2['series_data'][] = array(
            'value' => $totalCnt - $cnt,
            'name'  => '其他'
        );
    }
}


Template::assign('myChart2', json_encode($myChart2));
Template::assign('myChart', json_encode($myChart));
Template::assign('years', $years);
Template::assign('_GET', $_GET);
Template::assign('priceTop', $priceTop);
Template::display('purchase/price_view.tpl');