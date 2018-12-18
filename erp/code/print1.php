<?php
include '../include/init.inc.php';
$goodsId = $goodsBarCode = "";
extract($_REQUEST, EXTR_IF_EXISTS);

if(!empty($goodsBarCode)){
    $errorCorrectionLevel = "L"; // 纠错级别：L、M、Q、H
    $matrixPointSize = "5"; // 点的大小：1到10
    QRcode::png($goodsBarCode, false, $errorCorrectionLevel, $matrixPointSize, 0);
	exit;
}

$list = Goods::prints($goodsId);



Template::assign('list', $list);
Template::display('code/print1.tpl')
?>