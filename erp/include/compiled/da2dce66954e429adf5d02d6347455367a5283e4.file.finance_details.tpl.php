<?php /* Smarty version Smarty-3.1.15, created on 2017-12-07 10:35:54
         compiled from "D:\wwwroot\erp\include\template\finance\finance_details.tpl" */ ?>
<?php /*%%SmartyHeaderCode:130445a28a90a4dd855-04855763%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da2dce66954e429adf5d02d6347455367a5283e4' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\finance\\finance_details.tpl',
      1 => 1508232988,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '130445a28a90a4dd855-04855763',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'finance' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5a28a90a56c394_10445372',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a28a90a56c394_10445372')) {function content_5a28a90a56c394_10445372($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form id="" method="post" action="">
        <table width="100%" class="table">
            <?php if ($_smarty_tpl->tpl_vars['finance']->value['cate']==8||$_smarty_tpl->tpl_vars['finance']->value['cate']==9) {?>
            <tr>
                <td width="150" colspan="1">发票对象</td>
                <td colspan="3">
                    <?php if ($_smarty_tpl->tpl_vars['finance']->value['cate']==8) {?>
                    <?php echo $_smarty_tpl->tpl_vars['finance']->value['supplierName'];?>

                    <?php } else { ?>
                    <?php echo $_smarty_tpl->tpl_vars['finance']->value['customerName'];?>

                    <?php }?>
                </td>
            </tr>
            <tr>
                <td colspan="1"><?php if ($_smarty_tpl->tpl_vars['finance']->value['cate']==8) {?>采购发票<?php } else { ?>销售发票<?php }?></td>
                <td colspan="3">
                    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['finance']->value['invoices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
                    <?php echo $_smarty_tpl->tpl_vars['i']->value['invoiceNo'];?>
 <a>#</a>
                    <?php } ?>
                </td>
            </tr>
            <?php }?>
            <tr>
                <td colspan="1">合计金额</td>
                <td colspan="3"><a style="color: red;font-size: 14px;">&yen; <b><?php echo sprintf('%.2f',$_smarty_tpl->tpl_vars['finance']->value['invoicesTotalMoney']);?>
</b></a></td>
            </tr>
            <tr>
                <td>发票类型</td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['finance']->value['cateDesc'];?>

                </td>
            </tr>
            <tr>
                <td>类型</td>
                <td>收入</td>
            </tr>
            <tr>
                <td colspan="1">备注</td>
                <td colspan="3">
                    <?php echo $_smarty_tpl->tpl_vars['finance']->value['remark'];?>

                </td>
            </tr>
        </table>
    </form>
</div>
<script>

</script>

<?php }} ?>
