<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 10:51:32
         compiled from "D:\wwwroot\erp\include\template\order\create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1776959fd2b3448b013-04831651%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b553c5570f93ae7a6b46347afcd2f620a52cd18a' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\order\\create.tpl',
      1 => 1508307654,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1776959fd2b3448b013-04831651',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'form_url' => 0,
    'type' => 0,
    'suppliers_options' => 0,
    'depots_options' => 0,
    'customer_options' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd2b34506fc4_99042302',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd2b34506fc4_99042302')) {function content_59fd2b34506fc4_99042302($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wwwroot\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form action="<?php echo $_smarty_tpl->tpl_vars['form_url']->value;?>
" method="post">
        <table>
            <tr>
                <?php if ($_smarty_tpl->tpl_vars['type']->value==1) {?>
                <td width="40%" >供应商</td>
                <td><?php echo smarty_function_html_options(array('name'=>'supplierId','id'=>"DropDownTimezone",'options'=>$_smarty_tpl->tpl_vars['suppliers_options']->value,'selected'=>0),$_smarty_tpl);?>
</td>
                <?php } elseif ($_smarty_tpl->tpl_vars['type']->value==2) {?>
                <td width="40%" >仓库</td>
                <td><?php echo smarty_function_html_options(array('name'=>'depotId','id'=>"DropDownTimezone",'options'=>$_smarty_tpl->tpl_vars['depots_options']->value,'selected'=>0),$_smarty_tpl);?>
</td>
                <?php } else { ?>
                <td width="40%" >客户</td>
                <td><?php echo smarty_function_html_options(array('name'=>'customerId','id'=>"DropDownTimezone",'options'=>$_smarty_tpl->tpl_vars['customer_options']->value,'selected'=>0),$_smarty_tpl);?>
</td>
                <?php }?>
            </tr>
            <?php if ($_smarty_tpl->tpl_vars['type']->value==3) {?>
            <tr>
                <td>预计发货时间</td>
                <td><input type="text" name="deliverTime" class="time_input" readonly></td>
            </tr>
            <?php }?>
            <tr>
                <td>备注</td>
                <td>
                    <textarea name="remark" id="" cols="30" rows="5"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="nonceStr" value="<?php echo $_smarty_tpl->tpl_vars['nonceStr']->value;?>
">
                </td>
                <td>
                    <button type="submit" class="btn btn-primary" style="margin-top: 30px;float: right">创建</button>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php }} ?>
