<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="2" title="详情" layerUrl="finance_detail" layerW="850px"
           layerH="640px" layerT="2"><i class="icon-pencil"></i> 详情</a>
        <a class="btn btn-primary layerModel" action="4" title="新增" layerUrl="finance_add" layerW="1000px"
           layerH="650px" layerT="2"><i class="icon-plus"></i> 新增</a>
    </div>
    <div style="float:left;margin-right:5px">
        <label>类型</label>
        <select name="type" id="">
            <option value="0" <{if $_GET.type eq 0}>selected<{/if}>>全部</option>
            <option value="1" <{if $_GET.type eq 1}>selected<{/if}>>支出</option>
            <option value="2" <{if $_GET.type eq 2}>selected<{/if}>>收入</option>
        </select>
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
    <a href="#page-stats" class="block-heading" data-toggle="collapse">财务列表</a>
    <div id="page-stats" class="block-body collapse in">
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>类型</th>
                <th>收支类型</th>
                <th>对象</th>
                <th>公司</th>
                <th>日期</th>
                <th>金额</th>
            </tr>
            </thead>
            <tbody>
            <{foreach name=module from=$list key=index item=value}>
                <tr>
                    <td><input type="checkbox" data-name="financeId" value="<{$value.financeId}>"></td>
                    <td><{$value.typeDesc}></td>
                    <td><{$value.cateDesc}></td>
                    <td><{$value.targetName}></td>
                    <td><{$value.companyName}></td>
                    <td><{$value.createTime}></td>
                    <td><{$value.money}></td>
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