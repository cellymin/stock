<?php
include '../include/init.inc.php';
$code = $depotSubId="";
extract($_GET,EXTR_IF_EXISTS);

$depotSub = DepotSub::getDepotSubById($depotSubId);
if(!$depotSub){
    Common::exitWithError('库位不存在','code/depotSub_qrcode.php');
}

if($code==1) {
    //条码字体
    $font = new BCGFontFile('../assets/font/Arial.ttf', 12);

    //颜色条形码
    $color_black = new BCGColor(0, 0, 0);
    $color_white = new BCGColor(255, 255, 255);

    $drawException = null;
    try {
        $code = new BCGcode128();
        $code->setScale(1);
        $code->setThickness(40); // 条形码的厚度
        $code->setForegroundColor($color_black); // 条形码颜色
        $code->setBackgroundColor($color_white); // 空白间隙颜色
        $code->setFont($font); //
        $code->parse($depotSub['depotSubNo'].' '); // 条形码需要的数据内容
    } catch (Exception $exception) {
        $drawException = $exception;
    }

    //根据以上条件绘制条形码
    $drawing = new BCGDrawing('', $color_white);
    if ($drawException) {
        $drawing->drawException($drawException);
    } else {
        $drawing->setBarcode($code);
        $drawing->draw();
    }

    // 生成PNG格式的图片
    header('Content-Type: image/png');

    $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
    exit();
}


Template::assign('depotSub',$depotSub);
Template::display('code/depotSub_preview.tpl');