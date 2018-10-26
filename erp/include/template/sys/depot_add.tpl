<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->



<div class="form_div">
    <form id="form_data" method="post" action="">
        <table width="80%">
            <tr>
                <td><b>公司</b></td>
                <td><{html_options name=companyId id="companyId"  options=$company_options selected=$_GET.companyId}></td>
            </tr>
            <tr>
                <td><b>部门</b></td>
                <td><{html_options name=departmentId id="departmentId" options=$department_options selected=$_GET.departmentId}></td>
            </tr>
            <tr>
                <td><b>负责人</b></td>
                <td><{html_options name=employeeId id="employeeId" options=$employee_options selected=$_GET.employeeId required="true"}></td>
            </tr>
            <tr>
                <td><b>仓库名称</b></td>
                <td>
                    <input type="text" name="depotName" value="<{$_GET.depotName}>"  required="true">
                </td>
            </tr>
            <tr>
                <td><b>仓库编码</b></td>
                <td>
                    <input type="text" name="depotNo" value="<{$_GET.depotNo}>" placeholder="英文+字母" required="true">
                </td>
            </tr>
            <tr>
                <td><b>是否默认</b></td>
                <td>
                    <select name="isDefault"  >
                        <option value="0" selected >否</option>
                        <option value="1">是</option>
                    </select>
                </td>
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

<script type="text/javascript">
$(function(){
	$('#companyId, #departmentId').change(function(){
		var companyId = $('#companyId').val();
		var departmentId = $('#departmentId').val();
		window.location.href = "depot_add.php?companyId="+companyId+"&departmentId="+departmentId
	})
})
</script>
