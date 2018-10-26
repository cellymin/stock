<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 11:20:18
         compiled from "D:\wwwroot\erp\include\template\sys\company_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1602959fd31f24bd8c1-07250203%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9271482dbbc6c68f3fec89cce1a7f8595efba3d' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\sys\\company_modify.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1602959fd31f24bd8c1-07250203',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'company' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd31f250f8a1_58728532',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd31f250f8a1_58728532')) {function content_59fd31f250f8a1_58728532($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->



<div class="form_div">
    <form id="form_data" method="post" action="">
    	<input type="hidden" name="companyId" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['companyId'];?>
">
        <table>
            <tr>
                <td><b>公司名称</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="companyName" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['companyName'];?>
"  required="true" autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>公司地址</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="companyAddress" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['companyAddress'];?>
"  placeholder=""  required="true" >
                </td>
            </tr>
            <tr>
	            <td><b>公司电话</b></td>
	            <td>
	                <input class="input-xlarge" type="text" name="companyTel" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['companyTel'];?>
"  placeholder=""  required="true" >
	            </td>
	        </tr>
            <tr>
                <td><b>联系人</b></td>
                <td><input class="input-xlarge" type="text" name="companyUserName" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['companyUserName'];?>
"  required="true" autofocus="true"></td>
            </tr>
            <tr>
                <td><b>联系电话</b></td>
                <td><input class="input-xlarge" type="text" name="companyUserPhone" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['companyUserPhone'];?>
"  required="true" autofocus="true"></td>
            </tr>
            <tr>
                <td><b>联系邮箱</b></td>
                <td><input class="input-xlarge" type="text" name="companyUserEmail" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['companyUserEmail'];?>
"  required="true" autofocus="true"></td>
            </tr>
              <tr>
                <td><b>联系人QQ</b></td>
                <td><input class="input-xlarge" type="text" name="companyUserQQ" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['companyUserQQ'];?>
"  required="true" autofocus="true"></td>
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
