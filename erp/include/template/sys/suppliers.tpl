<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="1" title="新增供应商" layerUrl="suppliers_add" layerW="780px" layerH="650px" layerT="2"><i class="icon-plus"></i> 新增</a>
        <a class="btn btn-primary layerModel" action="2" title="编辑供应商" layerUrl="suppliers_modify" layerW="780px" layerH="650px" layerT="2"><i class="icon-pencil"></i> 编辑</a>
        <a class="btn btn-primary layerModel" action="2" title="审核供应商" layerUrl="suppliers_review" layerW="780px" layerH="650px" layerT="2"><i class="icon-pencil"></i> 审核</a>
        <a class="btn btn-primary layerModel" action="3" title="删除供应商"><i class="icon-trash"></i> 删除</a>
    </div>

    <div style="float:left;margin-right:5px">
        <label>选择状态</label>
        <select name="status">
	  		<option value ="0" <{if $_GET.status eq 0}>selected<{/if}>>全部</option>
	  		<option value ="1" <{if $_GET.status eq 1}>selected<{/if}>>未审核</option>
	  		<option value ="2" <{if $_GET.status eq 2}>selected<{/if}>>已审核</option>
		</select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入名称" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">供应商列表</a>
    <div id="page-stats" class="block-body collapse in">
    	<form method="post" action="suppliers_del.php">
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>名称</th>
                <th>地址</th>
                <th>电话</th>
                <th>负责人</th>
                <th>负责人电话</th>
                <th>负责人邮箱</th>
                <th>负责人QQ</th>
                <th>银行名称</th>
                <th>账户</th>
                <th>开户银行</th>
                <th>开卡人姓名</th>
                <th>开卡人电话</th>
                <th>金额</th>
                <th>备注</th>
            </tr>
            </thead>
            <tbody>
            <{foreach name=module from=$list key=index item=value}>
                <tr>

                    <td><input type="checkbox" name="supplierId[]" data-name="supplierId" value="<{$value.supplierId}>"></td>
                    <td><{$value.supplierName}></td>
                    <td><{$value.supplierAddress}></td>
                    <td><{$value.supplierTel}></td>
                    <td><{$value.supplierUserName}></td>
                    <td><{$value.supplierUserPhone}></td>
                    <td><{$value.supplierUserEmail}></td>
                    <td><{$value.supplierUserQQ}></td>
                    <td><{$value.bankName}></td>
                    <td><{$value.bankAccount}></td>
                    <td><{$value.bankOpenName}></td>
                    <td><{$value.cardUserName}></td>
                    <td><{$value.cardUserPhone}></td>
                    <td><{$value.cardMoney}></td>
                    <td><{$value.remark}></td>
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