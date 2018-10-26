<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 11:21:00
         compiled from "D:\wwwroot\erp\include\template\sys\employee_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:708659fd321c1f5bd2-92233277%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c3fd8d8487a2f2f43eccc066db48f04573e95a46' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\sys\\employee_modify.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '708659fd321c1f5bd2-92233277',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'employee' => 0,
    'company_options' => 0,
    'department_options' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd321c276293_18271808',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd321c276293_18271808')) {function content_59fd321c276293_18271808($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wwwroot\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>


<div class="form_div">
    <form id="form_data" method="post" action="">
    	<input type="hidden" name="employeeId" value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['employeeId'];?>
">
        <table>
            <tr>
                <td><b>公司</b></td>
                <td><?php echo smarty_function_html_options(array('name'=>'companyId','id'=>"DropDownTimezone",'selected'=>$_smarty_tpl->tpl_vars['employee']->value['companyId'],'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['company_options']->value),$_smarty_tpl);?>
</td>
            </tr>
             <tr>
                <td><b>部门</b></td>
                <td><?php echo smarty_function_html_options(array('name'=>'departmentId','id'=>"DropDownTimezone",'selected'=>$_smarty_tpl->tpl_vars['employee']->value['departmentId'],'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['department_options']->value),$_smarty_tpl);?>
</td>
            </tr>
            <tr>
                <td><b>员工姓名</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="employeeName" value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['employeeName'];?>
"  required="true" autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>员工地址</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="employeeAddress" value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['employeeAddress'];?>
"  placeholder=""  required="true" >
                </td>
            </tr>
            <tr>
                <td><b>联系方式</b></td>
                <td><input class="input-xlarge" type="text" name="employeePhone" value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['employeePhone'];?>
"  required="true" autofocus="true"></td>
            </tr>
            <tr>
            	<tr>
                <td><b>邮箱</b></td>
                <td><input class="input-xlarge" type="text" name="employeeEmail" value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['employeeEmail'];?>
"  required="true" autofocus="true"></td>
            </tr>
            <tr>
            	<tr>
                <td><b>QQ</b></td>
                <td><input class="input-xlarge" type="text" name="employeeQQ" value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['employeeQQ'];?>
"  required="true" autofocus="true"></td>
            </tr>  
            <tr>
                <td><b>职务</b></td>
                <td><input class="input-xlarge" type="text" name="employeeJob" value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['employeeJob'];?>
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
