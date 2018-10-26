<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 11:26:50
         compiled from "D:\wwwroot\erp\include\template\order\review.tpl" */ ?>
<?php /*%%SmartyHeaderCode:464559fd337acd2c81-57991851%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06353644c22b7d05569c78c747c93656dacb5b0b' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\order\\review.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '464559fd337acd2c81-57991851',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url' => 0,
    'orderId' => 0,
    'type' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd337acf99c6_84797421',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd337acf99c6_84797421')) {function content_59fd337acf99c6_84797421($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<form action="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" method="post" style="margin-top: 15px;">
    <input type="hidden" name="orderId" value="<?php echo $_smarty_tpl->tpl_vars['orderId']->value;?>
">
    <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
    <input type="hidden" name="nonceStr" value="<?php echo $_smarty_tpl->tpl_vars['nonceStr']->value;?>
">
    <table>
        <tr>
            <td width="180px">审核</td>
            <td>
                <select name="result" id="">
                    <option value="pass">通过</option>
                    <option value="nopass">不通过</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>备注：</td>
            <td>
                <textarea name="memo" id="" cols="20" rows="5" style="resize: none"></textarea>
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
<?php }} ?>
