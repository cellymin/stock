<{include file ="header.tpl"}>

<div class="form_div">
    <form class="form_search" action="" id="search" method="GET" style="margin-bottom:0px;">
        <div style="float:left;margin-right:5px">
            <{html_options name=supplierId id="supplierId" required="true" options=$suppliers_options selected=$supplierId}>
        </div>
        <div class="btn-toolbar" style="padding-bottom:0px;margin-bottom:0px">
            <button type="submit" class="btn btn-primary">检索</button>
        </div>
        <input type="hidden" name="goodsId" value="<{$goodsId}>">
        <input type="hidden" name="sortType" value="<{$sortType}>">
        <div style="clear:both;"></div>
    </form>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>供应商</th>
            <th>联系方式</th>
            <th>采购时间</th>
            <th>数量</th>
            <th>价格 <i class="<{if $sortType=='desc'}>icon-arrow-down<{else}>icon-arrow-up<{/if}> sortType"></i></th>
        </tr>
        </thead>
        <tbody>
        <{foreach from=$list item=v}>
            <tr>
                <td><{$v.supplierName}></td>
                <td><{$v.supplierTel}></td>
                <td><{$v.createTime}></td>
                <td><{$v.goodsCnt}></td>
                <td><{$v.goodsPrice}></td>
            </tr>
        <{/foreach}>
        </tbody>
    </table>
    <{$page_html}>
</div>
<script>
    $('.sortType').click( function () {
        var type = 'asc';
        if($(this).hasClass('icon-arrow-up')){
            type = 'desc';
        }
        $("input[name=sortType]").val(type);
        $("#search").submit();
    })
</script>