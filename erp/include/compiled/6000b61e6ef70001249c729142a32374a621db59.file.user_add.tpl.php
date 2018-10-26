<?php /* Smarty version Smarty-3.1.15, created on 2017-11-03 08:27:31
         compiled from "D:\wwwroot\jxc.com\erp\include\template\panel\user_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1624459fbb7f3a420a7-05947449%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6000b61e6ef70001249c729142a32374a621db59' => 
    array (
      0 => 'D:\\wwwroot\\jxc.com\\erp\\include\\template\\panel\\user_add.tpl',
      1 => 1504681991,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1624459fbb7f3a420a7-05947449',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    '_POST' => 0,
    'company_options' => 0,
    'department_options' => 0,
    'employee_options' => 0,
    'group_options' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fbb7f3b055a5_48527662',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fbb7f3b055a5_48527662')) {function content_59fbb7f3b055a5_48527662($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wwwroot\\jxc.com\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

    
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">请填写账号资料</a></li>
    </ul>	
	
	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">
			  <form id="tab" method="post" action="" autocomplete="off">
				 <table width="100%">
					 <tr>
						 <td width="400">
							 <label>登录名</label>
							 <input type="text" name="user_name" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['user_name'];?>
" class="input-xlarge" autofocus="true" required="true" >
						 </td>
						 <td>
							 <label>公司</label>
							 <?php echo smarty_function_html_options(array('name'=>'companyId','id'=>"companyId",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['company_options']->value,'selected'=>0,'required'=>"true"),$_smarty_tpl);?>

						 </td>
					 </tr>
					 <tr>
						 <td>
							 <label>密码</label>
							 <input type="password" name="password" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['password'];?>
" class="input-xlarge" required="true" >
						 </td>
						 <td>
							 <label>部门</label>
							 <?php echo smarty_function_html_options(array('name'=>'departmentId','id'=>"departmentId",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['department_options']->value,'selected'=>0,'required'=>"true"),$_smarty_tpl);?>

						 </td>
					 </tr>
					 <tr>
						 <td>
							 <label>姓名</label>
							 <input type="text" name="real_name" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['real_name'];?>
" class="input-xlarge" required="true" >
						 </td>
						 <td>
							 <label>员工</label>
							 <?php echo smarty_function_html_options(array('name'=>'employeeId','id'=>"employeeId",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['employee_options']->value,'selected'=>0,'required'=>"true"),$_smarty_tpl);?>

						 </td>
					 </tr>
					 <tr>
						 <td>
							 <label>手机</label>
							 <input type="text" name="mobile" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['mobile'];?>
" class="input-xlarge" required pattern="\d{11}">
						 </td>
						 <td>
							 <label>账号组</label>
							 <?php echo smarty_function_html_options(array('name'=>'user_group','id'=>"DropDownTimezone",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['group_options']->value,'selected'=>0),$_smarty_tpl);?>

						 </td>
					 </tr>
					 <tr>
						 <td>
							 <label>邮件</label>
							 <input type="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['email'];?>
"  class="input-xlarge" required="true" >
						 </td>
						 <td>
							 <label>查看权限</label>
							 <select name="selectAll" class="input-xlarge">
								 <option value="0">查看所属公司</option>
								 <option value="1">全部公司</option>
							 </select>
						 </td>
					 </tr>
					 <tr>
						 <td>
							 <label>描述</label>
							 <textarea name="user_desc" rows="3" class="input-xlarge"><?php echo $_smarty_tpl->tpl_vars['_POST']->value['user_desc'];?>
</textarea>
						 </td>
						 <td></td>
					 </tr>
				 </table>
				  <div class="btn-toolbar">
					  <button type="submit" class="btn btn-primary"><strong>提交</strong></button>
					  <div class="btn-group"></div>
				  </div>
			  </form>
        </div>
    </div>
</div>
<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<script>
	$(function(){
		$("#companyId").trigger('change');
	});

	$(document).on('change','#companyId,#departmentId',function () {
		var companyId = $("#companyId").val();
		var departmentId = $("#departmentId").val();
		$.ajax({
			url:'user_add.php',
			data:{method:'getEmployee',companyId:companyId,departmentId:departmentId},
			type:'post',
			dataType:'json',
			success:function(e){
				var html = '<select name="employeeId" id="employeeId" class="input-xlarge" required="true">';
				for (var i=0 in e){
					html += '<option value="'+e[i].employeeId+'">'+e[i].employeeName+'</option>';
				}
				html+='</select>';

				$("#employeeId").replaceWith(html);
			}
		})
	})
</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
