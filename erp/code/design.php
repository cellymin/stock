<?php
include '../include/init.inc.php';
$goodsId = $code = $data = "";
extract($_REQUEST, EXTR_IF_EXISTS);

if (Common::isPost()) {
    if (!$data || !is_array($data)) {
        echo json_encode(array('code' => 0, 'data' => '', 'msg' => '参数错误'));
        exit();
    }
    $filter = 1;
    foreach ($data as $key => $value) {
        if (in_array($key, array('goodsSn', 'goodsName', 'cateName', 'goodsQRCode', 'goodsBarCode', 'printArea'))) {
            if ($key != 'printArea' && (!isset($value['top']) || !isset($value['left']) || !isset($value['offsetTop']) || !isset($value['offsetLeft']) || !isset($value['initTop']) || !isset($value['initLeft']) || !isset($value['height']) || !isset($value['width']))) {
                $filter = 0;
                break;
            }
            if ($key == 'printArea' && (!is_numeric($value) || $value < 240 || $value > 450)) {
                $filter = 0;
                break;
            }
        } else {
            $filter = 0;
            break;
        }
    }
    if (!$filter) {
        echo json_encode(array('code' => 0, 'data' => '', 'msg' => '参数错误'));
        exit();
    }

    $input = array(
        'companyId' => $_SESSION[UserSession::SESSION_NAME]['companyId'],
        'sets'      => json_encode($data),
    );

    error_log(print_r($data,1));
    $id = PrintTemplate::save($input);
    if ($id!==false) {
        echo json_encode(array('code' => 1, 'data' => '', 'msg' => '设置成功'));
        exit();
    }
    echo json_encode(array('code' => 0, 'data' => '', 'msg' => '设置失败'));
    exit();
}


if ($code == 1) {
    //条码字体
    $font = new BCGFontFile('../assets/font/Arial.ttf', 12);

    //颜色条形码
    $color_black = new BCGColor(0, 0, 0);
    $color_white = new BCGColor(255, 255, 255);

    $drawException = null;
    try {
        $code = new BCGcode128();
        $code->setScale(1);
        $code->setThickness(35); // 条形码的厚度
        $code->setForegroundColor($color_black); // 条形码颜色
        $code->setBackgroundColor($color_white); // 空白间隙颜色
        $code->setFont($font); //
        $code->parse(101502174002); // 条形码需要的数据内容
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

    $url = 101502174002;
    $errorCorrectionLevel = "L"; // 纠错级别：L、M、Q、H
    $matrixPointSize = "5"; // 点的大小：1到10
    QRcode::png($url, false, $errorCorrectionLevel, $matrixPointSize, 0);
    exit();
}

$companySet = PrintTemplate::select($_SESSION[UserSession::SESSION_NAME]['companyId']);

Template::assign('set', $companySet['sets']);
Template::display('code/design.tpl');