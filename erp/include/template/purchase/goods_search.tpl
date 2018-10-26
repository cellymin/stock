<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form class="form_search" action="" method="GET" style="margin-bottom:0px;float: left;">
        <input type="hidden" name="type" value="<{$_GET.type}>">
        <input type="hidden" name="orderId" value="<{$_GET.orderId}>">
        <div style="float:left;margin-right:5px">
            <select name="goodsCateId" id="" style="width: 130px">
                <{foreach from=$goodsCate item=v}>
            <option value="<{$v.cateId}>" <{if $_GET.goodsCateId==$v.cateId}>selected<{/if}>>
                <{if $v.level>1}>
                |<{str_repeat('-',$v.level)}>&nbsp;<{$v.cateName}>
                <{else}>
                <{$v.cateName}>
                <{/if}>
                </option>
                <{/foreach}>
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
        <button type="submit" class="btn btn-primary layerModel" action="2" title="登记商品" layerUrl="<{$orderAddUrl}>" layerW="500px" layerH="500px" layerT="2" layerD="orderId=<{$_GET.orderId}>"><i class="icon-plus"></i>登记</button>
        <button type="submit" class="btn btn-primary layerModel" action="2" title="价格趋势" layerUrl="price_view" layerW="900px" layerH="700px" layerT="2"><i class="icon-plus"></i>价格</button>
    </div>
    <div>
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>名称</th>
                <th>规格</th>
                <th>单位</th>
                <th>上次进价</th>
                <th>最低进价</th>
                <th>最高进价</th>
                <th>平均进价</th>
            </tr>
            </thead>
            <tbody>
            <{foreach name=module from=$list key=index item=value}>
                <tr>
                    <td><input data-name="goodsId" value="<{$value.goodsId}>" type="checkbox"></td>
                    <td><{$value.goodsName}></td>
                    <td><{$value.goodsSpec}></td>
                    <td><{$value.unitName}></td>
                    <td><{$value.lastPrice}></td>
                    <td><{$value.minPrice}></td>
                    <td><{$value.maxPrice}></td>
                    <td><{$value.avgPrice}></td>
                </tr>
                <{/foreach}>
            </tbody>
        </table>
        <{$page_html}>
    </div>
</div>
