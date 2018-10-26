<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 10:04:18
         compiled from "C:\wamp\www\jxc.com\erp\include\template\sys\customer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2450559fd202253f115-82215661%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc5224a92c5a1ffecd73ed2dddbf47e2f3a7e43f' => 
    array (
      0 => 'C:\\wamp\\www\\jxc.com\\erp\\include\\template\\sys\\customer.tpl',
      1 => 1507772086,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2450559fd202253f115-82215661',
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
  'unifunc' => 'content_59fd202273d929_56169217',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd202273d929_56169217')) {function content_59fd202273d929_56169217($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="1" title="增加客户" layerUrl="customer_add" layerW="700px" layerH="450px" layerT="2"><i class="icon-plus"></i> 新增</a>
        <a class="btn btn-primary layerModel" action="2" title="编辑客户" layerUrl="customer_modify" layerW="700px" layerH="450px" layerT="2"><i class="icon-pencil"></i> 编辑</a>
        <a class="btn btn-primary layerModel" action="3" title="删除客户" layerUrl="customer_del" layerW="700px" layerH="450px" layerT="2"><i class="icon-trash"></i> 删除</a>
    </div>

    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['keyword'];?>
" placeholder="" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">列表</a>
    <div id="page-stats" class="block-body collapse in">
        <form method="post" action="customer_del.php">
            <table class="table table-striped" id="data_list">
                <thead>
                <tr>
                    <th>#</th>
                    <th>客户名称</th>
                    <th>地址</th>
                    <th>联系人</th>
                    <th>联系方式</th>
                    <th>联系邮箱</th>
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
	                    <td><input type="checkbox" name="customerId[]" data-name="customerId" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['customerId'];?>
"></td>
	                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['customerName'];?>
</td>
	                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['customerAddress'];?>
</td>
	                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['customerUserName'];?>
</td>
	                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['customerUserPhone'];?>
</td>
	                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['customerUserEmail'];?>
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
