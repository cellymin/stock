<?php /* Smarty version Smarty-3.1.15, created on 2018-09-28 13:48:53
         compiled from "D:\phpPro\wwwroot\StockManager\erp\include\template\code\depotSub_qrcode.tpl" */ ?>
<?php /*%%SmartyHeaderCode:134815badc0c5319751-69160190%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2f09cabb12feb3fc98c0af494a41b4f9e097fc0' => 
    array (
      0 => 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\template\\code\\depotSub_qrcode.tpl',
      1 => 1509759878,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '134815badc0c5319751-69160190',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'depot_options' => 0,
    'depotId' => 0,
    '_GET' => 0,
    'list' => 0,
    'value' => 0,
    'page_html' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5badc0c53567e5_77569664',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5badc0c53567e5_77569664')) {function content_5badc0c53567e5_77569664($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="2" title="预览" layerUrl="depotSub_preview" layerW="400px" layerH="400px" layerT="2"><i class="icon-plus"></i> 预览</a>
        <!--<a id="goods_qrcode_print" class="btn btn-primary"><i class="icon-plus"></i> 打印</a>-->
    </div>

    <div style="float:left;margin-right:5px">
        <label>选择仓库</label>
        <?php echo smarty_function_html_options(array('name'=>'depotId','id'=>"depotId",'options'=>$_smarty_tpl->tpl_vars['depot_options']->value,'selected'=>$_smarty_tpl->tpl_vars['depotId']->value),$_smarty_tpl);?>

    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['keyword'];?>
" placeholder="输入货号,助记词,产品名称" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">库位列表</a>
    <div id="page-stats" class="block-body collapse in">
          <form method="post" action="">
             <table class="table table-striped" id="data_list">
                <thead>
                <tr>
                    <th width="40"><input type="checkbox" id="chkAll"></th>
                    <th width="150">库位</th>
                    <th width="150">所属仓库</th>
                    <th width="150">所属公司</th>
                </tr>
                </thead>
                <tbody>
                <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
                   <tr>
                        <td><input type="checkbox" name="depotSubId[]" data-name="depotSubId" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['depotSubId'];?>
"></td>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['depotSubName'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['depotName'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['companyName'];?>
</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

        </form>
    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>


<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
