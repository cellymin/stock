<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form class="form_search" action="" method="GET" style="margin-bottom:0px;float: left;">
        <input type="hidden" name="type" value="<{$_GET.type}>">
        <input type="hidden" name="orderId" value="<{$_GET.orderId}>">
        <div style="float:left;margin-right:5px">
            <select name="depotId" id="depotId" style="width: 130px">
                <{foreach from=$depots key=index item=d}>
                <option value="<{$index}>" <{if $_GET.depotId==$index}>selected<{/if}>><{$d}></option>
                <{/foreach}>
            </select>
            <select name="depotSubId" id="depotSubId" style="width: 130px">
            </select>
        </div>

        <div style="float:left;margin-right:5px">
            <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入货号,助记词,产品名称"
                   style="width: 160px;">
        </div>
        <div class="btn-toolbar" style="padding-bottom:0px;margin-top:0px;margin-bottom:0px;float: left">
            <button type="submit" class="btn btn-primary"><i class="icon-search"></i></button>
        </div>
        <div style="clear:both;"></div>
    </form>
    <div class="btn-toolbar" style="padding-bottom:0px;margin-top:0px;margin-bottom:0px;float: right">
        <button type="submit" class="btn btn-primary layerModel" action="2" title="登记商品" layerUrl="<{$orderAddUrl}>"
                layerW="450px" layerH="400px" layerT="2" layerD="orderId=<{$_GET.orderId}>"><i class="icon-plus"></i> 登记
        </button>
   <{*     <{if !in_array($_GET.type,array('ALLOT_OUT','USE_OUT','INVENTORY'))}>
        <button type="submit" class="btn btn-primary layerModel" action="2" title="价格趋势" layerUrl="price_view"
                layerW="900px" layerH="700px" layerT="2"><i class="icon-search"></i> 价格
        </button>
        <{/if}> *}>
    </div>
    <div>
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>名称</th>
                <th>批次号</th>
                <th>仓库</th>
                <th>库位</th>
                <th>数量</th>
                <th>入库时间</th>
            </tr>
            </thead>
            <tbody>
            <{foreach name=module from=$list key=index item=value}>
                <tr>
                    <td><input data-name="id" value="<{$value.id}>" type="checkbox"></td>
                    <td><{$value.goodsName}></td>
                    <td><{$value.batchNo}></td>
                    <td><{$value.depotName}></td>
                    <td><{$value.depotSubName}></td>
                    <td><{$value.goodsCnt}></td>
                    <td><{$value.createTime}></td>
                </tr>
                <{/foreach}>
            </tbody>
        </table>
        <{$page_html}>
    </div>
</div>
<script>
    var depotId = '<{$_GET.depotId}>';
    var depotSubId = '<{$_GET.depotSubId}>';
    var isCheck = '';
    $(function () {
        if(depotId!=0)
            getGoods('<{$_GET.depotId}>');
    });
    $('#depotId').on('change',function () {
        $("#depotSubId").html('');
        var id  = $(this).val();
        if(id!=0){
            getGoods(id);
        }
    });
    function getGoods(id) {
        $.post('goods_search.php',{depotId:id},function (e) {
            if(e){
                $.each(e,function (i,v) {
                    isCheck = '';
                    if(i==depotSubId)
                        isCheck = 'selected';
                    $("#depotSubId").append('<option value="'+i+'" '+isCheck+'>'+v+'</option>');
                })
            }
        },'json');
    }
</script>
