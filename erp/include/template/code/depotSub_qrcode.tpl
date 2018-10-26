<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="2" title="预览" layerUrl="depotSub_preview" layerW="400px" layerH="400px" layerT="2"><i class="icon-plus"></i> 预览</a>
        <!--<a id="goods_qrcode_print" class="btn btn-primary"><i class="icon-plus"></i> 打印</a>-->
    </div>

    <div style="float:left;margin-right:5px">
        <label>选择仓库</label>
        <{html_options name=depotId id="depotId" options=$depot_options selected=$depotId}>
    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入货号,助记词,产品名称" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">库位列表</a>
    <div id="page-stats" class="block-body collapse in">
          <form method="post" action="">
             <table class="table table-striped" id="data_list">
                <thead>
                <tr>
                    <th width="40"><input type="checkbox" id="chkAll"></th>
                    <th width="150">库位</th>
                    <th width="150">所属仓库</th>
                    <th width="150">所属公司</th>
                </tr>
                </thead>
                <tbody>
                <{foreach name=module from=$list key=index item=value}>
                   <tr>
                        <td><input type="checkbox" name="depotSubId[]" data-name="depotSubId" value="<{$value.depotSubId}>"></td>
                        <td><{$value.depotSubName}></td>
                        <td><{$value.depotName}></td>
                        <td><{$value.companyName}></td>
                    </tr>
                    <{/foreach}>
                </tbody>
            </table>
            <{$page_html}>
        </form>
    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>

<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>