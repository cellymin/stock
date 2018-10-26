<?php /* Smarty version Smarty-3.1.15, created on 2018-09-19 16:38:24
         compiled from "D:\phpPro\wwwroot\StockManager\erp\include\template\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:248135ba20b007a1209-02210727%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53eba960546cfac7f4ab1a2da14300f9a16cc9c8' => 
    array (
      0 => 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\template\\header.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '248135ba20b007a1209-02210727',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_title' => 0,
    'user_info' => 0,
    'JSAlert' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5ba20b0081b323_57997982',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ba20b0081b323_57997982')) {function content_5ba20b0081b323_57997982($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
 - <?php echo @constant('ADMIN_TITLE');?>
</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="<?php echo @constant('ADMIN_URL');?>
/assets/lib/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" href="<?php echo @constant('ADMIN_URL');?>
/assets/stylesheets_<?php echo $_smarty_tpl->tpl_vars['user_info']->value['template'];?>
/theme.css">
    <link rel="stylesheet" href="<?php echo @constant('ADMIN_URL');?>
/assets/lib/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo @constant('ADMIN_URL');?>
/assets/lib/layer/skin/default/layer.css">
    <link rel="stylesheet" href="<?php echo @constant('ADMIN_URL');?>
/assets/css/other.css">
    <link rel="stylesheet" href="<?php echo @constant('ADMIN_URL');?>
/assets/css/jquery-ui.css"/>

    <script src="<?php echo @constant('ADMIN_URL');?>
/assets/lib/jquery-1.8.1.min.js"></script>
    <script src="<?php echo @constant('ADMIN_URL');?>
/assets/lib/jquery.cookie.js"></script>
    <script src="<?php echo @constant('ADMIN_URL');?>
/assets/lib/bootstrap/js/bootbox.min.js"></script>
    <script src="<?php echo @constant('ADMIN_URL');?>
/assets/lib/bootstrap/js/bootstrap-modal.js"></script>
    <script src="<?php echo @constant('ADMIN_URL');?>
/assets/js/other.js"></script>
    <script src="<?php echo @constant('ADMIN_URL');?>
/assets/js/jquery-ui.js"></script>
    <script src="<?php echo @constant('ADMIN_URL');?>
/assets/js/extend.js"></script>
    <script src="<?php echo @constant('ADMIN_URL');?>
/assets/lib/layer/layer.js"></script>
    <script src="<?php echo @constant('ADMIN_URL');?>
/assets/lib/echarts.min.js"></script>
   
    <script src="<?php echo @constant('ADMIN_URL');?>
/assets/lib/jQuery.print.min.js"></script>


    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height: 300px;
            width: 800px;
            margin: 0px auto;
            margin-top: 1em;
        }

        .brand {
            font-family: georgia, serif;
        }

        .brand .first {
            color: #ccc;
            font-style: italic;
        }

        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="<?php echo @constant('ADMIN_URL');?>
/assets/js/html5.js"></script>
    <![endif]-->
    <?php echo $_smarty_tpl->tpl_vars['JSAlert']->value;?>

    <script>

    </script>
</head>

<!--[if lt IE 7 ]>
<body class="ie ie6"> <![endif]-->
<!--[if IE 7 ]>
<body class="ie ie7 "> <![endif]-->
<!--[if IE 8 ]>
<body class="ie ie8 "> <![endif]-->
<!--[if IE 9 ]>
<body class="ie ie9 "> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<?php }} ?>
