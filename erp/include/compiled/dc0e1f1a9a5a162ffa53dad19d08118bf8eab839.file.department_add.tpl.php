<?php /* Smarty version Smarty-3.1.15, created on 2017-11-22 16:44:16
         compiled from "D:\wwwroot\erp\include\template\sys\department_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:261495a1538e0345f28-69043448%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc0e1f1a9a5a162ffa53dad19d08118bf8eab839' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\sys\\department_add.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '261495a1538e0345f28-69043448',
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
  'unifunc' => 'content_5a1538e0365f50_88457470',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1538e0365f50_88457470')) {function content_5a1538e0365f50_88457470($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->



<div class="form_div">
	<form id="form_data" method="post" action="">
	    <table>
	        <tr>
	            <td><b>部门名称</b></td>
	            <td>
	                <input type="text" name="departmentName" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['departmentName'];?>
"  required="true" autofocus="true">
	            </td>
	        </tr>
	        <tr>
	            <td><b>备注</b></td>
	            <td><textarea name="remark" rows="3" ></textarea></td>
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
