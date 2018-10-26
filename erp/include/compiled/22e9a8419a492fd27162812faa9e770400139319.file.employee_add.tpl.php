<?php /* Smarty version Smarty-3.1.15, created on 2018-10-23 13:37:34
         compiled from "D:\phpPro\wwwroot\StockManager\erp\include\template\sys\employee_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:154955bceb39e665359-15994014%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22e9a8419a492fd27162812faa9e770400139319' => 
    array (
      0 => 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\template\\sys\\employee_add.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '154955bceb39e665359-15994014',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'company_options' => 0,
    'department_options' => 0,
    '_POST' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5bceb39e6a23e2_88170288',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bceb39e6a23e2_88170288')) {function content_5bceb39e6a23e2_88170288($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>


<div class="form_div">
    <form id="form_data" method="post" action="">
        <table>
        	 <tr>
                <td><b>公司</b></td>
                <td><?php echo smarty_function_html_options(array('name'=>'companyId','id'=>"DropDownTimezone",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['company_options']->value,'selected'=>0),$_smarty_tpl);?>
</td>
            </tr>
             <tr>
                <td><b>部门</b></td>
                <td><?php echo smarty_function_html_options(array('name'=>'departmentId','id'=>"DropDownTimezone",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['department_options']->value,'selected'=>0),$_smarty_tpl);?>
</td>
            </tr>
            <tr>
                <td><b>员工姓名</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="employeeName" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['employeeName'];?>
"  required="true" autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>地址</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="employeeAddress" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['employeeAddress'];?>
"  placeholder=""  required="true" >
                </td>
            </tr>
            <tr>
                <td><b>电话</b></td>
                <td><input class="input-xlarge" type="text" name="employeePhone" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['employeePhone'];?>
"  required="true" autofocus="true"></td>
            </tr>
            <tr>
            	<tr>
                <td><b>邮箱</b></td>
                <td><input class="input-xlarge" type="text" name="employeeEmail" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['employeeEmail'];?>
"  required="true" autofocus="true"></td>
            </tr>
            <tr>
            	<tr>
                <td><b>QQ</b></td>
                <td><input class="input-xlarge" type="text" name="employeeQQ" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['employeeQQ'];?>
"  required="true" autofocus="true"></td>
            </tr>  
            <tr>
                <td><b>职务</b></td>
                <td><input class="input-xlarge" type="text" name="employeeJob" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['employeeJob'];?>
"  required="true" autofocus="true"></td>
            </tr>
            <tr>
                <td></td>
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
