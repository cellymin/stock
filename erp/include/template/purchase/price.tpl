<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="2" title="价格趋势" layerUrl="price_view" layerW="900px" layerH="700px" layerT="2"><i class="icon-signal"></i> 价格趋势</a>
        <a class="btn btn-primary layerModel" action="2" title="详情" layerUrl="price_list" layerW="900px" layerH="700px" layerT="2"><i class="icon-search"></i> 详情</a>
    </div>

    <div style="float:left;margin-right:5px">
        <label>选择分类</label>
        <select name="goodsCateId" id="goodsCateId">
            <option value="0">=请选择=</option>
            <{foreach name=module from=$cateList key=index item=value}>
            <option value="<{$value.cateId}>" <{if $value.cateId==$_GET.goodsCateId}>selected<{/if}> data-num="<{$value.level}>"><{$value.cateName}></option>
            <{/foreach}>
        </select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入货号,助记词,产品名称" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">产品列表</a>
    <div id="page-stats" class="block-body collapse in">
        <form method="post" action="goods_del.php">
            <table class="table table-striped" id="data_list">
                <thead>
                <tr>
                    <th>#</th>
                    <th>货号</th>
                    <th>条形码</th>
                    <th>名称</th>
                    <th>规格</th>
                    <th>分类</th>
                    <th>单位</th>
                    <th>上次进价</th>
                    <th>历史最低价</th>
                    <th>历史最高价</th>
                    <th>平均采购价</th>
                </tr>
                </thead>
                <tbody>
                <{foreach name=module from=$list key=index item=value}>
                    <tr>

                        <td><input type="checkbox" name="goodsId[]" data-name="goodsId" value="<{$value.goodsId}>"></td>
                        <td><{$value.goodsSn}></td>
                        <td><{$value.goodsBarCode}></td>
                        <td><{$value.goodsName}></td>
                        <td><{$value.goodsSpec}></td>
                        <td><{$value.cateName}></td>
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


<script type="text/javascript">
    $(function(){
        $('#goodsCateId option').each(function(){
            var count = Number($(this).attr('data-num'));
            var cateName = $(this).text();
            var str = '|'
            if(count>1){
                for(var i=1; i<count; i++){
                    str += '--';
                }
                $(this).html(str + " " + cateName);
            }
        });
    });
</script>
<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>

<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>