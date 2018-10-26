<?php /* Smarty version Smarty-3.1.15, created on 2018-09-19 17:27:33
         compiled from "D:\phpPro\wwwroot\StockManager\erp\include\template\sys\suppliers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:73785ba21685aec2c2-30013265%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c21c36462b5fe42349278ba9ccfd51be5c81edf' => 
    array (
      0 => 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\template\\sys\\suppliers.tpl',
      1 => 1507772012,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '73785ba21685aec2c2-30013265',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    '_GET' => 0,
    'list' => 0,
    'value' => 0,
    'page_html' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5ba21685bbdfb4_64988370',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ba21685bbdfb4_64988370')) {function content_5ba21685bbdfb4_64988370($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="1" title="新增供应商" layerUrl="suppliers_add" layerW="780px" layerH="650px" layerT="2"><i class="icon-plus"></i> 新增</a>
        <a class="btn btn-primary layerModel" action="2" title="编辑供应商" layerUrl="suppliers_modify" layerW="780px" layerH="650px" layerT="2"><i class="icon-pencil"></i> 编辑</a>
        <a class="btn btn-primary layerModel" action="2" title="审核供应商" layerUrl="suppliers_review" layerW="780px" layerH="650px" layerT="2"><i class="icon-pencil"></i> 审核</a>
        <a class="btn btn-primary layerModel" action="3" title="删除供应商"><i class="icon-trash"></i> 删除</a>
    </div>

    <div style="float:left;margin-right:5px">
        <label>选择状态</label>
        <select name="status">
	  		<option value ="0" <?php if ($_smarty_tpl->tpl_vars['_GET']->value['status']==0) {?>selected<?php }?>>全部</option>
	  		<option value ="1" <?php if ($_smarty_tpl->tpl_vars['_GET']->value['status']==1) {?>selected<?php }?>>未审核</option>
	  		<option value ="2" <?php if ($_smarty_tpl->tpl_vars['_GET']->value['status']==2) {?>selected<?php }?>>已审核</option>
		</select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['keyword'];?>
" placeholder="输入名称" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">供应商列表</a>
    <div id="page-stats" class="block-body collapse in">
    	<form method="post" action="suppliers_del.php">
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>名称</th>
                <th>地址</th>
                <th>电话</th>
                <th>负责人</th>
                <th>负责人电话</th>
                <th>负责人邮箱</th>
                <th>负责人QQ</th>
                <th>银行名称</th>
                <th>账户</th>
                <th>开户银行</th>
                <th>开卡人姓名</th>
                <th>开卡人电话</th>
                <th>金额</th>
                <th>备注</th>
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

                    <td><input type="checkbox" name="supplierId[]" data-name="supplierId" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['supplierId'];?>
"></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['supplierName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['supplierAddress'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['supplierTel'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['supplierUserName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['supplierUserPhone'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['supplierUserEmail'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['supplierUserQQ'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['bankName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['bankAccount'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['bankOpenName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['cardUserName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['cardUserPhone'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['cardMoney'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['remark'];?>
</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>


<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
