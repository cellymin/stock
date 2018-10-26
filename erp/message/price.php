<?php
include '../include/init.inc.php';
$page_no = "";
extract($_GET, EXTR_IF_EXISTS);

//START 数据库查询及分页数据
$page_size = PAGE_SIZE;
$page_no = $page_no < 1 ? 1 : $page_no;

$row_count = Message::count(2);
$total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
$total_page = $total_page < 1 ? 1 : $total_page;
$page_no = $page_no > ($total_page) ? ($total_page) : $page_no;
$start = ($page_no - 1) * $page_size;
$list = Message::warningMsg($start, $page_size, 2);

foreach ($list as &$item) {
    $temp = json_decode($item['content']);
    $item['content'] = array();
    $item['content']['goodsName'] = $temp->goodsName;
    $item['content']['type'] = $temp->type;
    $item['content']['value'] = $temp->value;
}


$page_html = Pagination::showPager("price.php", $page_no, $page_size, $row_count);

Template::assign('list', $list);
Template::assign('page_html', $page_html);
Template::display('message/price.tpl');