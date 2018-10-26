<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<style>
    table tbody tr:last-child{ font-weight: 700;font-size: 14px;color: #000}

</style>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">


    <div style="float:left;margin-right:5px">
        <label>选择公司</label>
        <{html_options name=companyId id="companyId" class="input-xlarge" options=$company_options selected=$_GET.companyId}>
    </div>
    <div style="float:left;margin-right:5px">
        <label>日期段</label>
        <input type="text" name="startTime" class="time_input" readonly value="<{$_GET.startTime}>">
    </div>
    <div style="float:left;margin-right:5px">
        <label>至</label>
        <input type="text" name="endTime" class="time_input" readonly value="<{$_GET.endTime}>">
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">领用明细表</a>
    <div id="page-stats" class="block-body collapse in">
        <table class="table table-striped" border="1" id="data_list">
            <thead>
            <tr>
                <td>分类\部门</td>
                <{foreach from=$departments item=dep}>
                <td><{$dep.departmentName}></td>
                <{/foreach}>
                <td>小计</td>
            </tr>
            </thead>
            <tbody>
            <{foreach from=$list item=g}>
            <tr>
                <td><{$g.cateName}></td>
                <{foreach from=$g.moneys item=d}>
                <td><{$d.money}></td>
                <{/foreach}>
                <td><{$g.subTotal}></td>
            </tr>
            <{/foreach}>
            <tr>
                <td>合计</td>
                <{foreach from=$departments item=dep}>
                <td><{$dep.subTotal}></td>
                <{/foreach}>
                <td><{$total}></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>

<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>