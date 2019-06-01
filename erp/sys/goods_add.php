<?php
include '../include/init.inc.php';
$goodsSn = $goodsBarCode = $goodsName = $goodsSpec = $goodsCateId1 = $goodsCateId2 = $goodsCateId = $goodsUnitId =
$productionDate = $invalidDate = $searchKey = $remark = $nonceStr = $method = $parentId = "";
extract($_POST, EXTR_IF_EXISTS);

$client = new PhalApiClient();
$pinyin = new PinYin();
//分类
$cateList = array();
//计量单位
$unitList = array();

//条形码
$code = '';

if (Common::isPost()) {
	$input_data = array();
	$input_data['goodsSn'] = $goodsSn;
	$input_data['goodsBarCode'] = $goodsBarCode;
	$input_data['goodsName'] = $goodsName;
	$input_data['goodsSpec'] = $goodsSpec;
	$input_data['goodsCateId1'] = $goodsCateId1;
	$input_data['goodsCateId2'] = $goodsCateId2;
	$input_data['goodsCateId'] = $goodsCateId;
	$input_data['goodsUnitId'] = $goodsUnitId;
	$input_data['productionDate'] = $productionDate;
	$input_data['invalidDate'] = $invalidDate;
	$input_data['searchKey'] = $searchKey;
	$input_data['remark'] = $remark;
	$input_data['flag'] = 1;
	$input_data['createTime'] = date('Y-m-d H:i:s');
    $input_data['quanpin'] = strtoupper($pinyin->getpy($goodsName));
    $input_data['jianxie'] = strtoupper($pinyin->getpy($goodsName,false));
	
	
	
	
    if ($method == 'opt') {
        $list = array();
        $rs = $client->request('GoodsCate_Options.Go', array('parentId' => $parentId));
        if ($client->getRet() == PhalApiClient::RET_OK) {
            $list = $rs['content'];
        }
        echo json_encode($list);
        exit;
    }else{
    	$result = Goods::add($input_data);
	
		if($result['goodsId']){
			Common::closeWithMessage('操作成功');
			Common::unsetNonceStr();
			SysLog::addLog(UserSession::getUserName(), 'ADD', 'Goods', $result['goodsId'], json_encode($_POST));
		}else{
			Common::resetNonceStr();
			Common::tipWithMessage($result['msg'], 'error');
		}
    }
//else {
//      if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
//          $res = $client->request('Goods_Insert.Go', $_POST);
//          if ($client->getRet() == PhalApiClient::RET_OK) {
//              Common::closeWithMessage('操作成功');
//              Common::unsetNonceStr();
//              SysLog::addLog(UserSession::getUserName(), 'ADD', 'Goods', $rs['goodsId'], json_encode($_POST));
//              $_POST = null;
//          } else {
//              Common::resetNonceStr();
//              Common::tipWithMessage($client->getMsg(), 'error');
//          }
//      } else {
//          Common::unsetNonceStr();
//          Common::closeWithMessage('表单已失效','error');
//      }
//  }

}

$rs = $client->request('GoodsUnit_Options.Go', $_POST);
if ($client->getRet() == PhalApiClient::RET_OK) {
    $unitList = $rs['content'];
}

$rs = $client->request('Goods_GetCode.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $code = $rs['content'];
}
$code = time();
Template::assign('unitList', $unitList);
Template::assign('cateList', $cateList);
Template::assign('code', $code);
Template::assign('_POST', $_POST);
Template::display('sys/goods_add.tpl');