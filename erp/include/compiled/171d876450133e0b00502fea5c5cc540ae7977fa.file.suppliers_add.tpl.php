<?php /* Smarty version Smarty-3.1.15, created on 2018-09-19 17:27:35
         compiled from "D:\phpPro\wwwroot\StockManager\erp\include\template\sys\suppliers_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:290915ba21687764177-20050220%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '171d876450133e0b00502fea5c5cc540ae7977fa' => 
    array (
      0 => 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\template\\sys\\suppliers_add.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '290915ba21687764177-20050220',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_POST' => 0,
    'reviewer_options' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5ba21687845286_41886115',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ba21687845286_41886115')) {function content_5ba21687845286_41886115($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->


<div class="form_div">
    <form id="" method="post" action="">
        <table width="100%">
            <tr>
                <td><b>供应商名称</b></td>
                <td>
                    <input type="text" name="supplierName" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['supplierName'];?>
"  required="true"  autofocus="true">
                </td>
                <td><b>供应商地址</b></td>
                <td>
                    <input type="text" name="supplierAddress" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['supplierAddress'];?>
"  required="true"  autofocus="true">
                </td>
            </tr>
             <tr>
                <td><b>供应商电话</b></td>
                <td>
                    <input type="text" name="supplierTel" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['supplierTel'];?>
"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
                <td><b>负责人</b></td>
                <td>
                    <input type="text" name="supplierUserName" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['supplierUserName'];?>
"  required="true"  autofocus="true">
                </td>
                <td><b>负责人电话</b></td>
                <td>
                    <input type="text" name="supplierUserPhone" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['supplierUserPhone'];?>
"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>负责人邮箱</b></td>
                <td>
                    <input type="text" name="supplierUserEmail" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['supplierUserEmail'];?>
"  required="true"  autofocus="true">
                </td>
                <td><b>负责人QQ</b></td>
                <td>
                    <input type="text" name="supplierUserQQ" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['supplierUserQQ'];?>
"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
                <td><b>银行名称</b></td>
                <td>
                    <input type="text" name="bankName" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['bankName'];?>
"  required="true"  autofocus="true">
                </td>
                <td><b>开户银行</b></td>
                <td>
                    <input type="text" name="bankOpenName" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['bankOpenName'];?>
"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>开卡人姓名</b></td>
                <td>
                    <input type="text" name="cardUserName" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['cardUserName'];?>
"  required="true"  autofocus="true">
                </td>
                <td><b>开卡人电话</b></td>
                <td>
                    <input type="text" name="cardUserPhone" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['cardUserPhone'];?>
"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>账户</b></td>
                <td>
                    <input type="text" name="bankAccount" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['bankAccount'];?>
"  required="true"  autofocus="true">
                </td>
                <td><b>金额</b></td>
                <td>
                    <input type="text" name="cardMoney" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['cardMoney'];?>
"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
                <td><b>选择审核人</b></td>
                <td><?php echo smarty_function_html_options(array('name'=>'reviewer','id'=>"DropDownTimezone",'options'=>$_smarty_tpl->tpl_vars['reviewer_options']->value,'selected'=>0),$_smarty_tpl);?>
</td>
            </tr>
            <tr>
                <td><b>备注</b></td>
                <td colspan="3"><textarea style="width:80%;resize: none" name="remark"  value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['remark'];?>
" rows="3" ></textarea></td>
            </tr>
            <tr>
                <td><b></b></td>
                <td>
                    <div class="btn-toolbar">
                        <input type="hidden" name="nonceStr" value="<?php echo $_smarty_tpl->tpl_vars['nonceStr']->value;?>
">
                        <button type="submit" class="btn btn-primary"><strong>保存</strong></button>
                    </div>
                </td>
            </tr>

        </table>
    </form>
</div>
<?php }} ?>
