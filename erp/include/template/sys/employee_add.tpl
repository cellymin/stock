<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="form_div">
    <form id="form_data" method="post" action="">
        <table>
        	 <tr>
                <td><b>公司</b></td>
                <td><{html_options name=companyId id="DropDownTimezone" class="input-xlarge" options=$company_options selected=0}></td>
            </tr>
             <tr>
                <td><b>部门</b></td>
                <td><{html_options name=departmentId id="DropDownTimezone" class="input-xlarge" options=$department_options selected=0}></td>
            </tr>
            <tr>
                <td><b>员工姓名</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="employeeName" value="<{$_POST.employeeName}>"  required="true" autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>地址</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="employeeAddress" value="<{$_POST.employeeAddress}>"  placeholder=""  required="true" >
                </td>
            </tr>
            <tr>
                <td><b>电话</b></td>
                <td><input class="input-xlarge" type="text" name="employeePhone" value="<{$_POST.employeePhone}>"  required="true" autofocus="true"></td>
            </tr>
            <tr>
            	<tr>
                <td><b>邮箱</b></td>
                <td><input class="input-xlarge" type="text" name="employeeEmail" value="<{$_POST.employeeEmail}>"  required="true" autofocus="true"></td>
            </tr>
            <tr>
            	<tr>
                <td><b>QQ</b></td>
                <td><input class="input-xlarge" type="text" name="employeeQQ" value="<{$_POST.employeeQQ}>"  required="true" autofocus="true"></td>
            </tr>  
            <tr>
                <td><b>职务</b></td>
                <td><input class="input-xlarge" type="text" name="employeeJob" value="<{$_POST.employeeJob}>"  required="true" autofocus="true"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div class="btn-toolbar">
                        <input type="hidden" name="nonceStr" value="<{$nonceStr}>">
                        <button type="submit" class="btn btn-primary"><strong>保存</strong></button>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
