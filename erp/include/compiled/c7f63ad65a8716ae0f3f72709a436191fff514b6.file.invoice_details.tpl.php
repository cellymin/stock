<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 11:27:48
         compiled from "D:\wwwroot\erp\include\template\purchase\invoice_details.tpl" */ ?>
<?php /*%%SmartyHeaderCode:776859fd33b4d57546-38128358%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c7f63ad65a8716ae0f3f72709a436191fff514b6' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\purchase\\invoice_details.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '776859fd33b4d57546-38128358',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'js_confirm' => 0,
    'order' => 0,
    'invoice' => 0,
    'v' => 0,
    'page_html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd33b4e24da6_96678543',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd33b4e24da6_96678543')) {function content_59fd33b4e24da6_96678543($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->tpl_vars['js_confirm']->value;?>

<div class="form_div">
    <div id="order_head">
        <input type="hidden" name="orderId" value="<?php echo $_smarty_tpl->tpl_vars['order']->value['orderId'];?>
">
        <input type="hidden" name="url" value="plan_order_add">
        <table class="table">
            <tr>
                <td>发票号</td>
                <td><?php echo $_smarty_tpl->tpl_vars['invoice']->value['invoiceNo'];?>
</td>
                <td>创建时间</td>
                <td><?php echo $_smarty_tpl->tpl_vars['order']->value['createTime'];?>
</td>
            </tr>
            <tr>
                <td>供应商</td>
                <td><?php echo $_smarty_tpl->tpl_vars['order']->value['supplierName'];?>
</td>
                <td>采购入库单号</td>
                <td><?php echo $_smarty_tpl->tpl_vars['order']->value['orderNo'];?>
</td>
            </tr>
            <tr>
                <td>总金额</td>
                <td><?php echo $_smarty_tpl->tpl_vars['order']->value['totalMoney'];?>
</td>
                <td>预计收票时间</td>
                <td><?php echo $_smarty_tpl->tpl_vars['invoice']->value['endTime'];?>
</td>
            </tr>
        </table>
    </div>
    <h6>入库单商品列表</h6>
    <table class="table table-striped" id="data_list">
        <thead>
        <tr>
            <th>#</th>
            <th>名称</th>
            <th>规格</th>
            <th>单位</th>
            <th>批次号</th>
            <th>供应商</th>
            <th>仓库</th>
            <th>库位</th>
            <th>数量</th>
            <th>价格</th>
            <th>部门</th>
            <th>备注</th>
        </tr>
        </thead>
        <tbody>
        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order']->value['goods']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
            <tr data-id="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" datatype="1">
                <td><input type="checkbox" name="id[]" data-name="id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"></td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['goodsName'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['goodsSpec'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['unitName'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['orderSubNo'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['supplierName'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['depotName'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['depotSubName'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['goodsCnt'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['goodsPrice'];?>
</td>
                <td>
                    <?php if ($_smarty_tpl->tpl_vars['v']->value['remark']) {?>
                    <a><i title="<?php echo $_smarty_tpl->tpl_vars['v']->value['remark'];?>
" class="icon-comment"></i></a>
                    <?php } else { ?>
                    <a style="color: #888"><i title="<?php echo $_smarty_tpl->tpl_vars['v']->value['remark'];?>
" class="icon-comment"></i></a>
                    <?php }?>
                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['remark'];?>
" name="remark">
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

</div>

<?php }} ?>
