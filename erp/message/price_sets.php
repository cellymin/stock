<?php
include '../include/init.inc.php';
$page_no = $keyword = "";
extract($_GET,EXTR_IF_EXISTS);

//START 数据库查询及分页数据
$page_size = PAGE_SIZE;
$page_no = $page_no < 1 ? 1 : $page_no;

$row_count = MsgSetting::countSetPrice($keyword);
$total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
$total_page = $total_page < 1 ? 1 : $total_page;
$page_no = $page_no > ($total_page) ? ($total_page) : $page_no;
$start = ($page_no - 1) * $page_size;
$list = MsgSetting::listSetPrice($start, $page_size, $keyword);

$page_html=Pagination::showPager("price_sets.php?keyword=$keyword",$page_no,$page_size,$row_count);

Template::assign('page_html',$page_html);
Template::assign('_GET',$_GET);
Template::assign('list',$list);
Template::display('message/price_sets.tpl');