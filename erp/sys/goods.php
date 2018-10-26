<?php
include '../include/init.inc.php';
header("Content-type:text/html;charset=utf-8");

$page_no = $page_size = $keyword = $goodsCateId = $method = "";
extract($_REQUEST,EXTR_IF_EXISTS);
$page_html='';
$list = array();
$page_size = PAGE_SIZE;
$page_no=$page_no<1?1:$page_no;

if(Common::isPost()){
    if($method=='excel'){
        if(empty($_FILES['excel'])) {
            Common::exitWithError("没有选择文件！","sys/goods.php",2);
        }else{
            $fileType = $_FILES['excel']['type'];            
            if($fileType!='application/vnd.ms-excel' && $fileType!='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
                Common::exitWithError("文件类型错误！","sys/goods.php",2);
            }
            $result = Goods::loadData();
            if($result!==true){
                Common::exitWithError($result,"sys/goods.php",2);
            }
            Common::exitWithSuccess('导入成功',"sys/goods.php",2);
        }
    }
    exit();


}

$client = new PhalApiClient();

//分类
$cateList = array();
$client = new PhalApiClient();
$rs = $client->request('GoodsCate_GetList.Go',$_POST);
if ($client->getRet() == PhalApiClient::RET_OK) { 
    $cateList = $rs['content'];
}

//列表
$res = $client->request('Goods_GetList.Go',array(
		'page_no' => $page_no,
		'page_size' => $page_size,
		'keyword' => $keyword,
		'goodsCateId' => $goodsCateId
));
if ($client->getRet() == PhalApiClient::RET_OK){
	$page_no = $res['content']['page_no'];
	$page_size = $res['content']['page_size'];
	$row_count = $res['content']['row_count'];
	$list = $res['content']['list'];
	
	$page_html=Pagination::showPager("goods.php?keyword=$keyword&goodsCateId=$goodsCateId",$page_no,$page_size,$row_count); 
}


Template::assign('cateList', $cateList);
Template::assign('list',$list);
Template::assign('page_html',$page_html);
Template::assign('_GET', $_GET);
Template::display('sys/goods.tpl');