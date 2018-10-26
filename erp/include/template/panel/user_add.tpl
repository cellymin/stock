<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
    
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
							 <input type="text" name="user_name" value="<{$_POST.user_name}>" class="input-xlarge" autofocus="true" required="true" >
						 </td>
						 <td>
							 <label>公司</label>
							 <{html_options name=companyId id="companyId" class="input-xlarge" options=$company_options selected=0 required="true"}>
						 </td>
					 </tr>
					 <tr>
						 <td>
							 <label>密码</label>
							 <input type="password" name="password" value="<{$_POST.password}>" class="input-xlarge" required="true" >
						 </td>
						 <td>
							 <label>部门</label>
							 <{html_options name=departmentId id="departmentId" class="input-xlarge" options=$department_options selected=0 required="true"}>
						 </td>
					 </tr>
					 <tr>
						 <td>
							 <label>姓名</label>
							 <input type="text" name="real_name" value="<{$_POST.real_name}>" class="input-xlarge" required="true" >
						 </td>
						 <td>
							 <label>员工</label>
							 <{html_options name=employeeId id="employeeId" class="input-xlarge" options=$employee_options selected=0 required="true"}>
						 </td>
					 </tr>
					 <tr>
						 <td>
							 <label>手机</label>
							 <input type="text" name="mobile" value="<{$_POST.mobile}>" class="input-xlarge" required pattern="\d{11}">
						 </td>
						 <td>
							 <label>账号组</label>
							 <{html_options name=user_group id="DropDownTimezone" class="input-xlarge" options=$group_options selected=0}>
						 </td>
					 </tr>
					 <tr>
						 <td>
							 <label>邮件</label>
							 <input type="email" name="email" value="<{$_POST.email}>"  class="input-xlarge" required="true" >
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
							 <textarea name="user_desc" rows="3" class="input-xlarge"><{$_POST.user_desc}></textarea>
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
<{include file="footer.tpl" }>