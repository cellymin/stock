<{include file ="header.tpl"}>

<div class="form_div">
    <form class="form_search" action="" method="GET" style="margin-bottom:0px;">
        <div style="padding-top:0px;padding-bottom:0px;margin-bottom:0px;float: right">
            <a class="btn btn-primary layerModel" action="2" title="修改库位" layerUrl="depotSub_modify"
               layerD="depotId=<{$depotSub.depotId}>" layerW="400px" layerH="300px" layerT="2"><i
                        class="icon-pencil"></i> 编辑</a>
            <a class="btn btn-primary layerModel" action="3"><i class="icon-trash"></i> 删除库位</a>
        </div>
        <div style="float:left;margin-right:5px">
            <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入批次号,产品名称">
            <input type="hidden" name="depotId" value="<{$_GET.depotId}>">
            <input type="hidden" name="depotSubId" value="<{$_GET.depotSubId}>">
        </div>
        <div class="btn-toolbar" style="padding-top:0px;padding-bottom:0px;margin-bottom:0px">
            <button type="submit" class="btn btn-primary"> 检索</button>
        </div>
        <div style="clear:both;"></div>
    </form>


    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">库位产品</a>
        <div id="page-stats" class="block-body collapse in">
            <form action="depotSub_del.php" method="post">
                <table class="table table-striped" id="data_list">
                    <thead>
                    <tr>
                        <th>#
                            <input type="checkbox" style="display: none;" name="depotSubId" data-name="depotSubId" checked value="<{$depotSub.depotSubId}>">
                            <input type="hidden" name="depotId" value="<{$depotSub.depotId}>">
                        </th>
                        <th>批次号</th>
                        <th>商品名称</th>
                        <th>商品数量</th>
                        <th>仓库</th>
                        <th>库位</th>
                        <th>入库时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    <{foreach name=module from=$list key=index item=value}>
                        <tr>
                            <td></td>
                            <td><{$value.batchNo}></td>
                            <td><{$value.goodsName}></td>
                            <td><{$value.goodsCnt}></td>
                            <td><{$value.depotName}></td>
                            <td><{$value.depotSubName}></td>
                            <td><{$value.createTime}></td>
                        </tr>
                        <{/foreach}>
                    </tbody>
                </table>
            </form>
            <{$page_html}>
        </div>
    </div>
</div>



