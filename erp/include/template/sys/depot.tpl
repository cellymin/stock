<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a  class="btn btn-primary layerModel" action="1" title="新增仓库" layerUrl="depot_add" layerW="400px" layerH="420px" layerT="2"><i class="icon-plus"></i> 新增</a>
        <a  class="btn btn-primary layerModel" action="2" title="修改仓库" layerUrl="depot_modify" layerW="400px" layerH="420px" layerT="2"><i class="icon-pencil"></i> 编辑</a>
        <a class="btn btn-primary layerModel" action="3" title="删除仓库" ><i class="icon-trash"></i> 删除</a>
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


<div class="well" >
    <form action="depot_del.php" method="post">
        <ul class="nav nav-tabs" id="data_list">
            <{foreach from=$list key=index item=depot}>
                <li class="<{if ($_GET.depotId eq $depot.depotId || ($_GET.depotId==0 && $index==0))}>active<{/if}>">
                    <a href="depot.php?depotId=<{$depot.depotId}>"><{$depot.depotName}></a>
                    <{if ($_GET.depotId eq $depot.depotId || ($_GET.depotId==0 && $index==0))}>
                    <input type="checkbox" name="depotId" checked style="display: none" data-name="depotId" value="<{$depot.depotId}>">
                    <{/if}>
                </li>
            <{/foreach}>
            <a style="float: right"  class="btn btn-primary layerModel" action="2" title="新增库位" layerUrl="depotSub_add" layerW="400px" layerH="300px" layerT="2"><i class="icon-plus"></i> 新增库位</a>
        </ul>
    </form>

    <div class="tab-content" id="depot_list">
        <ul>
            <{foreach from=$depotSubs key=index item=v}>
            <li class="layerModel" action="2" title="库位详情" layerUrl="depotSub_goods" layerD="depotSubId=<{$v.depotSubId}>" layerW="60%" layerH="70%" layerT="2">
                <span><{$v.depotSubName}></span>
                <div class="btn" >
                    <table width="100%">
                        <{foreach from=$v.goods item=g}>
                        <tr>
                            <td><{$g.goodsName}></td>
                            <td width="40%" align="right"><{$g.goodsCnt}></td>
                        </tr>
                        <{/foreach}>
                    </table>
                </div>
            </li>
            <{/foreach}>
        </ul>
    </div>
</div>
<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>

<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>