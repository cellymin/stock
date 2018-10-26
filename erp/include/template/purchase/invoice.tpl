<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<form class="form_search" action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="2" title="发票详情" layerUrl="invoice_details" layerW="1000px"
           layerH="650px" layerT="2"><i class="icon-pencil"></i> 详情</a>

    </div>

    <div style="float:left;margin-right:5px">
        <label>选择供应商</label>
        <{html_options name=supplierId id="supplierId" class="input-large" options=$suppliers_options selected=$supplierId}>
    </div>
    <div style="float:left;margin-right:5px">
        <label>选择付款状态</label>
        <select name="payStatus" id="">
            <option value="0" <{if $_GET.payStatus eq 0}>selected<{/if}>>全部</option>
            <option value="1" <{if $_GET.payStatus eq 1}>selected<{/if}>>未付款</option>
            <option value="2" <{if $_GET.payStatus eq 2}>selected<{/if}>>已付款</option>
        </select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>选择收票状态</label>
        <select name="invoiceStatus" id="">
            <option value="0" <{if $_GET.invoiceStatus eq 0}>selected<{/if}>>全部</option>
            <option value="1" <{if $_GET.invoiceStatus eq 1}>selected<{/if}>>未收票</option>
            <option value="2" <{if $_GET.invoiceStatus eq 2}>selected<{/if}>>已收票</option>
        </select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入发票单号,采购入库单号">
        <input type="hidden" name="search" value="1">
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">采购发票列表</a>
    <div id="page-stats" class="block-body collapse in">
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>发票号</th>
                <th>供应商</th>
                <th>公司</th>
                <th>采购入库单号</th>
                <th>金额</th>
                <th>付款状态</th>
                <th>收票状态</th>
                <th>创建时间</th>
                <th>预计收票时间</th>
            </tr>
            </thead>
            <tbody>
            <{foreach name=invoices from=$list key=index item=value}>
                <tr>
                    <td><input type="checkbox" data-name="invoiceId" value="<{$value.invoiceId}>"></td>
                    <td><{$value.invoiceNo}></td>
                    <td><{$value.supplierName}></td>
                    <td><{$value.companyName}></td>
                    <td><{$value.orderNo}></td>
                    <td><{$value.totalMoney}></td>
                    <td><{$value.payFlag}></td>
                    <td><{$value.invoiceFlag}></td>
                    <td><{$value.createTime}></td>
                    <td><{$value.endTime}></td>
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