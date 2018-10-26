<?php
include '../include/init.inc.php';
$goodsId = $code = "";
extract($_GET,EXTR_IF_EXISTS);

$goods = Goods::getGoodsInfo($goodsId);
if($goods){
    if ($code == 1) {
        //条码字体
        $font = new BCGFontFile('../assets/font/Arial.ttf', 12);

        //颜色条形码
        $color_black = new BCGColor(0, 0, 0);
        $color_white = new BCGColor(255, 255, 255);

        $drawException = null;
        try {
//            error_log(print_r($goods['cateNo'].$goods['goodsBarCode'],1));
            $text = $goods['goodsBarCode'];
            $code = new BCGcode128();
            $code->setScale(1);
            $code->setThickness(40); // 条形码的厚度
            $code->setForegroundColor($color_black); // 条形码颜色
            $code->setBackgroundColor($color_white); // 空白间隙颜色
            $code->setFont($font); //
            $code->parse(strval($text.' ')); // 条形码需要的数据内容
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
    if ($code == 2) {
        $url = floatval($goods['cateNo'].$goods['goodsBarCode']);
        $errorCorrectionLevel = "L"; // 纠错级别：L、M、Q、H
        $matrixPointSize = "5"; // 点的大小：1到10
        QRcode::png($url, false, $errorCorrectionLevel, $matrixPointSize, 0);
        exit();
    }
}else{
    Common::closeWithMessage('商品不存在','error');
}
$set = PrintTemplate::select($_SESSION[UserSession::SESSION_NAME]['companyId']);


Template::assign('set',$set['sets']);
Template::assign('goods',$goods);
Template::display('code/preview.tpl');