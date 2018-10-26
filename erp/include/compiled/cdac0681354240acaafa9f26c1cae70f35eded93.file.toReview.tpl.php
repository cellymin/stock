<?php /* Smarty version Smarty-3.1.15, created on 2017-10-18 15:50:46
         compiled from "E:\wwwroot\jxc.com\erp\include\template\order\toReview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2858959e707d6c16ba4-15171485%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cdac0681354240acaafa9f26c1cae70f35eded93' => 
    array (
      0 => 'E:\\wwwroot\\jxc.com\\erp\\include\\template\\order\\toReview.tpl',
      1 => 1504681991,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2858959e707d6c16ba4-15171485',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url' => 0,
    'orderId' => 0,
    'type' => 0,
    'nonceStr' => 0,
    'reviewer_options' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59e707d6c4d6a9_49651469',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e707d6c4d6a9_49651469')) {function content_59e707d6c4d6a9_49651469($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'E:\\wwwroot\\jxc.com\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form action="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" method="post">
        <input type="hidden" name="orderId" value="<?php echo $_smarty_tpl->tpl_vars['orderId']->value;?>
">
        <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
        <input type="hidden" name="nonceStr" value="<?php echo $_smarty_tpl->tpl_vars['nonceStr']->value;?>
">
        <table>
            <tr>
                <td>审核人</td>
                <td>
                    <?php echo smarty_function_html_options(array('name'=>'reviewer','id'=>"DropDownTimezone",'options'=>$_smarty_tpl->tpl_vars['reviewer_options']->value,'selected'=>0),$_smarty_tpl);?>

                </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: right;padding-top: 20px;">
                    <button class="btn btn-primary">提交</button>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php }} ?>
