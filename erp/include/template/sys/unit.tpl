<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="1" title="新增单位" layerUrl="unit_add" layerW="400PX" layerH="200PX" layerT="2"><i class="icon-plus"></i> 新增</a>
        <a class="btn btn-primary layerModel" action="2" title="修改单位" layerUrl="unit_modify" layerW="400PX" layerH="200PX" layerT="2"><i class="icon-pencil"></i> 编辑</a>
        <a class="btn btn-primary layerModel" action="3" title="删除单位" ><i class="icon-trash"></i> 删除</a>
    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入名称" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">单位列表</a>
    <div id="page-stats" class="block-body collapse in">
    	<form method="post" action="unit_del.php">
        <table class="table table-striped" id="data_list" >
            <thead>
            <tr>
                <th width="50">#</th>
                <th width="100">编号</th>
                <th width="">名称</th>
            </tr>
            </thead>
            <tbody>
            <{foreach name=module from=$list key=index item=value}>
                <tr>
                    <td><input type="checkbox" name="unitId[]" data-name="unitId" value="<{$value.unitId}>" ></td>
                    <td><{$value.unitNo}></td>
                    <td><{$value.unitName}></td>
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