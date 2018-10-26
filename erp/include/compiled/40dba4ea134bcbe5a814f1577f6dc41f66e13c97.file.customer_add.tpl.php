<?php /* Smarty version Smarty-3.1.15, created on 2017-11-22 16:33:59
         compiled from "D:\wwwroot\erp\include\template\sys\customer_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:154075a153677364909-45580208%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40dba4ea134bcbe5a814f1577f6dc41f66e13c97' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\sys\\customer_add.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '154075a153677364909-45580208',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_POST' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5a1536773a6ce3_63718543',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1536773a6ce3_63718543')) {function content_5a1536773a6ce3_63718543($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form id="form_data" method="post" action="">
        <table>
            <tr>
                <td><b>公司名称</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="customerName" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['customerName'];?>
"  required="true" autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>公司地址</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="customerAddress" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['customerAddress'];?>
"  placeholder=""  required="true" >
                </td>
            </tr>
            <tr>
                <td><b>联系人</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="customerUserName" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['customerUserName'];?>
"  placeholder=""  required="true" >
                </td>
            </tr>
            <tr>
                <td><b>联系电话</b></td>
                <td><input class="input-xlarge" type="text" name="customerUserPhone" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['customerUserPhone'];?>
"  required="true"></td>
            </tr>
            <tr>
                <td><b>联系邮箱</b></td>
                <td><input class="input-xlarge" type="text" name="customerUserEmail" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['customerUserEmail'];?>
"  required="true"></td>
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
