<?php /* Smarty version Smarty-3.1.15, created on 2018-10-23 13:38:11
         compiled from "D:\phpPro\wwwroot\StockManager\erp\include\template\finance\pay_order.tpl" */ ?>
<?php /*%%SmartyHeaderCode:59705bceb3c306f546-13206805%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8294880b8f42fe939f368ecac5373fffb7063e5d' => 
    array (
      0 => 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\template\\finance\\pay_order.tpl',
      1 => 1508294362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59705bceb3c306f546-13206805',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    '_GET' => 0,
    'suppliers_options' => 0,
    'supplierId' => 0,
    'list' => 0,
    'value' => 0,
    'page_html' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5bceb3c3163787_83271304',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bceb3c3163787_83271304')) {function content_5bceb3c3163787_83271304($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<form class="form_search" action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="4" title="新增财务" layerUrl="pay_add" layerW="850px"
           layerH="665px" layerT="2"><i class="icon-plus"></i> 财务</a>
    </div>
    <div class="btn-toolbar" style="float:right;padding-top:15px;margin-right: 10px;">
        <a class="btn btn-primary layerModel" action="2" title="收票" layerUrl="pay_collect" layerW="850px"
           layerH="665px" layerT="2"><i class="icon-plus"></i> 收票</a>
    </div>
    <div style="float:left;margin-right:5px">
        <label>选择付款状态</label>
        <select name="payStatus" id="">
            <option value="0" <?php if ($_smarty_tpl->tpl_vars['_GET']->value['payStatus']==0) {?>selected<?php }?>>全部</option>
            <option value="1" <?php if ($_smarty_tpl->tpl_vars['_GET']->value['payStatus']==1) {?>selected<?php }?>>未付款</option>
            <option value="2" <?php if ($_smarty_tpl->tpl_vars['_GET']->value['payStatus']==2) {?>selected<?php }?>>已付款</option>
        </select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>选择供应商</label>
        <?php echo smarty_function_html_options(array('name'=>'supplierId','id'=>"supplierId",'class'=>"input-large",'options'=>$_smarty_tpl->tpl_vars['suppliers_options']->value,'selected'=>$_smarty_tpl->tpl_vars['supplierId']->value),$_smarty_tpl);?>

    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['keyword'];?>
" placeholder="输入发票单号,采购入库单号">
        <input type="hidden" name="search" value="1">
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">采购发票列表</a>
    <div id="page-stats" class="block-body collapse in">
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>发票号</th>
                <th>供应商</th>
                <th>公司</th>
                <th>采购入库单号</th>
                <th>金额</th>
                <th>付款状态</th>
                <th>收票状态</th>
                <th>创建时间</th>
                <th>预计收票时间</th>
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
                    <td><input type="checkbox" data-name="invoiceId" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['invoiceId'];?>
"></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['invoiceNo'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['supplierName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['companyName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['orderNo'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['totalMoney'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['payFlag'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['invoiceFlag'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['createTime'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['endTime'];?>
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
