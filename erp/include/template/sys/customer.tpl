<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="1" title="增加客户" layerUrl="customer_add" layerW="700px" layerH="450px" layerT="2"><i class="icon-plus"></i> 新增</a>
        <a class="btn btn-primary layerModel" action="2" title="编辑客户" layerUrl="customer_modify" layerW="700px" layerH="450px" layerT="2"><i class="icon-pencil"></i> 编辑</a>
        <a class="btn btn-primary layerModel" action="3" title="删除客户" layerUrl="customer_del" layerW="700px" layerH="450px" layerT="2"><i class="icon-trash"></i> 删除</a>
    </div>

    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">列表</a>
    <div id="page-stats" class="block-body collapse in">
        <form method="post" action="customer_del.php">
            <table class="table table-striped" id="data_list">
                <thead>
                <tr>
                    <th>#</th>
                    <th>客户名称</th>
                    <th>地址</th>
                    <th>联系人</th>
                    <th>联系方式</th>
                    <th>联系邮箱</th>
                </tr>
                </thead>
                <tbody>
				<{foreach name=module from=$list key=index item=value}>
	                <tr>
	                    <td><input type="checkbox" name="customerId[]" data-name="customerId" value="<{$value.customerId}>"></td>
	                    <td><{$value.customerName}></td>
	                    <td><{$value.customerAddress}></td>
	                    <td><{$value.customerUserName}></td>
	                    <td><{$value.customerUserPhone}></td>
	                    <td><{$value.customerUserEmail}></td>
	                </tr>
                <{/foreach}>
                </tbody>
            </table>
        </form>
        <{$page_html}>
    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>

<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>