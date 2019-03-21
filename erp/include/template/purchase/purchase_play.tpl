<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<form class="form_search" action="" method="GET" style="margin-bottom:0px">
    <div style="float:left;margin-right:5px">
        <label>选择状态</label>
        <select name="status" id="">
            <option value="0"<{if $_GET.status eq 0}>selected<{/if}>>未处理</option>
            <option value="1"<{if $_GET.status eq 1}>selected<{/if}>>已处理</option>
        </select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入货号,助记词,产品名称">
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse"><{$content_header.menu_name}>列表</a>
    <div id="page-stats" class="block-body collapse in">
        <form action="<{$delete_url}>.php" method="post">
            <input id="type" type="hidden" name="type" value="<{$type}>">
            <table class="table table-striped" id="data_list">
                <thead>
                <tr>
                    <th>商品编码</th>
                    <th>商品名称</th>
                    <!--th>仓库</th-->
                    <th>供应商</th>
                    <th>价格</th>
                    <th>库存数量</th>
                    <th>状态</th>
                    <th>创建时间</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <{foreach name=invoices from=$list key=index item=value}>
                        <td><{$value.goodsSn}></td>
                        <td><{$value.goodsName}></td>
                        <td><{$value.suppliername}></td>
                        <td><{$value.lastPrice}></td>
                        <!--td><{$value.depotName}></td-->
                        <td><{$value.goodsCnt}></td>
                        <td><{$value.status}></td>
                        <td><{$value.createTime}></td>
                        <{/foreach}>
                    </tr>

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


<script>


</script>