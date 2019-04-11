<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<style>
    .export {display:none;}
</style>
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
        <a type="button" class="btn btn-primary" onclick="beforeExport(this)">导出</a>
        <button id="orderPrint" class="btn btn-primary" style="" onclick="beforeprint(this)" > 打印</button>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">产品列表</a>
    <div id="page-stats" class="block-body collapse in">
        <form method="post" action="goods_del.php">
            <table class="table table-striped" id="data_list">
                <thead>
                <tr  class="export" >
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>价格管理</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr  class="export" >
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th style="float: right">申请日期：<{$nowdate}></th>
                    <th></th>
                </tr>
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
    function beforeExport(e) {
        var table = $('#data_list').html();
        $('input:checkbox:not(:checked)').each(function(i){
            $(this).parent().parent().remove();
        });
        $('.printnone').remove();
        $('#data_list').css('border',1);
        method5('data_list')
        $('#data_list').html(table);


    }
    function beforeprint() {
        $('input:checkbox:not(:checked)').each(function(i){
            $(this).parent().parent().css('display','none');
        });
        printorder();
        $('input:checkbox:not(:checked)').each(function(i){
            $(this).parent().parent().css('display','');
        });
        $('.export').css('display','none')
    }
    function printorder() {
        'use strict';
        $('.header').hide();
        $('.navbar').hide();
        $('.form_search').hide();
        $('.block-heading').hide();
        $('.breadcrumb').hide();
        $('.pagination').hide();
        $('.printnone').hide();
        $('.pageHead').show();
        $('.export').show();
        $(".form_div").print({

            //是否包含父文档的样式，默认为true
            globalStyles: true,
            //是否包含media='print'的链接标签。会被globalStyles选项覆盖，默认为false
            mediaPrint: false,
            //外部样式
            stylesheet: '<{$smarty.const.ADMIN_URL}>/assets/css/print.css',
            //Print in a hidden iframe
            iframe: false,
            //不想打印的元素的jQuery选择器
            noPrintSelector: ".avoid-this",

            //Add this at top
            prepend: 'Hello World',
            //将内容添加到打印内容的后面
            append: '11111',
            //回调方法
            deferred: $.Deferred().done(function () {
                console.log('Printing done', arguments);
                $('.pageHead').hide();
            })
        });

        $('.header').show();
        $('.form_search').show();
        $('.block-heading').show();
        $('.breadcrumb').show();
        $('.pagination').show();
        $('.navbar').show();
        $('.printnone').show();
    }

</script>
<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>

<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>