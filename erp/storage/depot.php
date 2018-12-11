<?php
/**
 * Created by PhpStorm.
 * User: sp
 * Date: 2018/9/30
 * Time: 9:10
 */
include '../include/init.inc.php';
//$res = Depot::getAllDepotSubs();
$res = Depot::getAllDepot();//获取所有仓库
$info = [];
if($_GET['depotid']){//如果传过来的
    $sub = Depot::getDepotSubByDepotId($_GET['depotid']);//通过仓库id获取库位
    $info['depot_subs'] = $sub;
}
$sup = Depot::getAllSuppliers();//获取所有供应商
$info['depots'] = $res;
$info['suppliers'] = $sup;

echo '<pre/>';
var_dump($info);


die();
?>