<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 11:33:32
         compiled from "D:\wwwroot\erp\include\template\message\price_sets.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1630159fd350c8996c1-01601543%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f316ddbf95f742eb8950d9f8286e567397b32331' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\message\\price_sets.tpl',
      1 => 1504840862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1630159fd350c8996c1-01601543',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    '_GET' => 0,
    'list' => 0,
    'v' => 0,
    'page_html' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd350c90bb23_74141265',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd350c90bb23_74141265')) {function content_59fd350c90bb23_74141265($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="1" title="增加设置" layerUrl="price_setting" layerW="450px" layerH="300px" layerT="2"><i class="icon-plus"></i> 新增</a>
        <a class="btn btn-primary layerModel" action="2" title="修改设置" layerUrl="price_modify" layerW="450px" layerH="300px" layerT="2"><i class="icon-pencil"></i> 编辑</a>
        <a class="btn btn-primary layerModel" action="3"  title="删除设置"><i class="icon-trash"></i> 删除</a>
    </div>

    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['keyword'];?>
" placeholder="" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">列表</a>
    <div id="page-stats" class="block-body collapse in">
        <form method="post" action="price_del.php">
            <table class="table table-striped" id="data_list">
                <thead>
                <tr>
                    <th>#</th>
                    <th>商品</th>
                    <th>采购价格上涨预警百分比</th>
                    <th>采购下跌预警百分比</th>
                    <th>公司</th>
                    <th>时间</th>
                </tr>
                </thead>
                <tbody>
                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                    <tr>
                        <td><input type="checkbox" data-name="id" name="id[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"></td>
                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['goodsName'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['upPercent'];?>
%</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['downPercent'];?>
%</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['companyName'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['createTime'];?>
</td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </form>
        <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>


<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
