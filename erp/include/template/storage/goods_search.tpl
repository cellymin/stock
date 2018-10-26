<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form class="form_search" action="" method="GET" style="margin-bottom:0px;float: left;">
        <input type="hidden" name="type" value="<{$_GET.type}>">
        <input type="hidden" name="orderId" value="<{$_GET.orderId}>">
        <{if !in_array($_GET.type,array('ALLOT_OUT','USE_OUT','INVENTORY'))}>
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
        <{else}>
        <div style="float:left;margin-right:5px">
            <{html_options name=depotSubId id="DropDownTimezone" required="true" options=$depotSubs selected=$depotSubId}>
        </div>

        <{/if}>

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
                layerW="450px" layerH="550px" layerT="2" layerD="orderId=<{$_GET.orderId}>"><i class="icon-plus"></i> 登记
        </button>
   <{*     <{if !in_array($_GET.type,array('ALLOT_OUT','USE_OUT','INVENTORY'))}>
        <button type="submit" class="btn btn-primary layerModel" action="2" title="价格趋势" layerUrl="price_view"
                layerW="900px" layerH="700px" layerT="2"><i class="icon-search"></i> 价格
        </button>
        <{/if}> *}>
    </div>
    <div>
        <{if !in_array($_GET.type,array('ALLOT_OUT','USE_OUT','INVENTORY'))}>
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
        <{else}>
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
        <{/if}>
        <{$page_html}>
    </div>
</div>
