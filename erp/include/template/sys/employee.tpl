<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="1" title="新增员工" layerUrl="employee_add" layerW="600px" layerH="500px" layerT="2"><i class="icon-plus"></i> 新增</a>
        <a class="btn btn-primary layerModel" action="2" title="修改员工" layerUrl="employee_modify" layerW="600px" layerH="500px" layerT="2"><i class="icon-pencil"></i> 编辑</a>
        <a class="btn btn-primary layerModel"  action="3"  title="删除员工"><i class="icon-trash"></i> 删除</a>
    </div>

    <div style="float:left;margin-right:5px">
        <label>选择公司</label>
        <{html_options name=companyId id="DropDownTimezone" class="input-xlarge" options=$company_options selected=$_GET.companyId}>
    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入姓名" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>
<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">员工列表</a>
    <div id="page-stats" class="block-body collapse in">
    	<form method="post" action="employee_del.php">
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>公司</th>
                <th>部门</th>
                <th>员工姓名</th>
                <th>员工地址</th>
                <th>联系方式</th>
                <th>邮箱</th>
                <th>QQ</th>
                <th>职务</th>
                <th>公司名称</th>
                <th>部门名称</th>
            </tr>
            </thead>
            <tbody>
            <{foreach name=module from=$list key=index item=value}>
                <tr>
                    <td><input type="checkbox" name="employeeId[]" data-name="employeeId" value="<{$value.employeeId}>"></td>
                    <td><{$value.companyId}></td>
                    <td><{$value.departmentId}></td>
                    <td><{$value.employeeName}></td>
                    <td><{$value.employeeAddress}></td>
                    <td><{$value.employeePhone}></td>
                    <td><{$value.employeeEmail}></td>
                    <td><{$value.employeeQQ}></td>
                    <td><{$value.employeeJob}></td>
                    <td><{$value.companyName}></td>
                    <td><{$value.departmentName}></td>
                </tr>
                <{/foreach}>
            </tbody>
        </table>
        <{$page_html}>
    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>

<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>