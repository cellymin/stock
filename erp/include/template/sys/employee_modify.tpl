<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="form_div">
    <form id="form_data" method="post" action="">
    	<input type="hidden" name="employeeId" value="<{$employee.employeeId}>">
        <table>
            <tr>
                <td><b>公司</b></td>
                <td><{html_options name=companyId id="DropDownTimezone" selected=$employee.companyId class="input-xlarge" options=$company_options}></td>
            </tr>
             <tr>
                <td><b>部门</b></td>
                <td><{html_options name=departmentId id="DropDownTimezone" selected=$employee.departmentId class="input-xlarge" options=$department_options}></td>
            </tr>
            <tr>
                <td><b>员工姓名</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="employeeName" value="<{$employee.employeeName}>"  required="true" autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>员工地址</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="employeeAddress" value="<{$employee.employeeAddress}>"  placeholder=""  required="true" >
                </td>
            </tr>
            <tr>
                <td><b>联系方式</b></td>
                <td><input class="input-xlarge" type="text" name="employeePhone" value="<{$employee.employeePhone}>"  required="true" autofocus="true"></td>
            </tr>
            <tr>
            	<tr>
                <td><b>邮箱</b></td>
                <td><input class="input-xlarge" type="text" name="employeeEmail" value="<{$employee.employeeEmail}>"  required="true" autofocus="true"></td>
            </tr>
            <tr>
            	<tr>
                <td><b>QQ</b></td>
                <td><input class="input-xlarge" type="text" name="employeeQQ" value="<{$employee.employeeQQ}>"  required="true" autofocus="true"></td>
            </tr>  
            <tr>
                <td><b>职务</b></td>
                <td><input class="input-xlarge" type="text" name="employeeJob" value="<{$employee.employeeJob}>"  required="true" autofocus="true"></td>
            </tr>
            <tr>
                <td><b></b></td>
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
