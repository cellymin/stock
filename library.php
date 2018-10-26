<?php
header("Content-type:text/html;charset=utf-8");

try {
    $pdo = new PDO('mysql:host=192.168.0.74;dbname=jxc', 'root', '',
        array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
} catch (PDOException $e) {
    die('数据库连接失败');
}

$sql = 'SELECT  a.TABLE_NAME "表",   
    a.COLUMN_NAME "列",   
    a.COLUMN_TYPE "类型",       
    a.COLUMN_DEFAULT "默认值",   
    a.IS_NULLABLE "是否为空",   
    a.CHARACTER_SET_NAME "表字符集",
    a.COLLATION_NAME  "校验字符集",  
    CONCAT(a.COLUMN_COMMENT," ",a.COLUMN_KEY," ", a.EXTRA) "列备注",  
    b.TABLE_COMMENT "表备注" ,  
    b.ENGINE "引擎"  
FROM information_schema.COLUMNS a,information_schema.TABLES b   
WHERE a.TABLE_SCHEMA=b.TABLE_SCHEMA   
AND a.TABLE_SCHEMA="jxc"  
AND a.TABLE_NAME=b.TABLE_NAME';

$list = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

if (!$list) {
    die('表不存在');
}

$tmp = array();
foreach ($list as $item) {
    $tmp[$item['表']]['列'][] = $item;
    $tmp[$item['表']]['表'] = $item['表'];
    $tmp[$item['表']]['表备注'] = $item['表备注'];
    $tmp[$item['表']]['引擎'] = $item['引擎'];
    $tmp[$item['表']]['表字符集'] = $item['表字符集'];
    $tmp[$item['表']]['校验字符集'] = $item['校验字符集'];
}

$ul = '<ul style="position: fixed;top:0;left: 0;max-height: 500px;overflow: auto;width: 300px;">';
$html = '<div style="float: right">';
foreach ($tmp as $table) {
    $ul .= '<li><a href="#' . $table['表'] . '">' . $table['表'] . '</a></li>';
    $html .= '<table id="' . $table['表'] . '" border="1" cellspacing="0" cellpadding="5">';
    $html .= '<caption>表名：' . $table['表'] . '&nbsp;&nbsp;表备注：' . $table['表备注'] . '</caption>';
    $html .= '<theaed>';
    $html .= '<tr>';
    $html .= '<td>列</td>';
    $html .= '<td>类型</td>';
    $html .= '<td>默认值</td>';
    $html .= '<td>是否为空</td>';
    $html .= '<td>列备注</td>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';

    foreach ($table['列'] as $columns) {
        $html .= '<tr>';
        $html .= '<td>' . $columns['列'] . '</td>';
        $html .= '<td>' . $columns['类型'] . '</td>';
        $html .= '<td>' . $columns['默认值'] . '</td>';
        $html .= '<td>' . $columns['是否为空'] . '</td>';
        $html .= '<td>' . $columns['列备注'] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody>';
    $html .= '</table>';

}

$ul .= '</ul>';
$html .= '</div>';
echo $html;
echo $ul;

