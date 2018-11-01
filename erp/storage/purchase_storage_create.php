<?php
include '../include/init.inc.php';
include '../include/lib/PinYin.class.php';
$supplierId = $nonceStr = $remark = "";
extract($_POST, EXTR_IF_EXISTS);
$suppliers_options = array();
$client = new PhalApiClient();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        if ($supplierId != 0) {
            $rs = $client->request('Order_Create.Go', array(
                'type'    => 'PURCHASE_IN',
                'remark'      => $remark,
                'supplierId' => $supplierId
            ));
            if ($client->getRet() == PhalApiClient::RET_OK) {
                Common::unsetNonceStr();
                Common::closeWithMessage('新建成功', 'success');
            } else {
                Common::resetNonceStr();
                Common::tipWithMessage($client->getMsg(), 'error');
            }
        } else {
            Common::tipWithMessage('请选择供应商', 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}

$rs = $client->request('Supplier_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $pinyin = new PinYin();
    $suppliers_options = $rs['content'];
    $suppliers_options[0] = "== 请选择 ==";
    $new_suppliers_options=array();
    foreach ($suppliers_options as $k=>$v) {
        $new_suppliers_options[$k]['id']=$k;
        $new_suppliers_options[$k]['name']=$v;
        $new_suppliers_options[$k]['pinyin']=$pinyin->getpy($v);
        $new_suppliers_options[$k]['jianxie']=$pinyin->getpy($v,false);
    }
    //echo '<pre/>';
    //var_dump($new_suppliers_options);
}

Template::assign('form_url', 'purchase_storage_create.php');
Template::assign('type', '1');
Template::assign('isgai', '1');
Template::assign('suppliers_options', $new_suppliers_options);
Template::display('order/create.tpl');