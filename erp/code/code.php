<?php
require('phpqrcode.php');
$goodsBarCode = $_GET['goodsBarCode'];
$level = 'L';
$size = 5;
\QRcode::png($goodsBarCode, false, $level, $size);
?>