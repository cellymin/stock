<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<style>
.export {display:none;}
 table tr td{
    border: 1px solid #e2e2e2;
}
.jiaxian th{
    border: 1px solid #e2e2e2;
}
</style>
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
        <a type="button" class="btn btn-primary" onclick="beforeExport(this)">导出</a>
        <button id="orderPrint" class="btn btn-primary" style="" onclick="beforeprint(this)" > 打印</button>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse"><{$content_header.menu_name}>列表</a>
    <div id="page-stats" class="block-body collapse in">
        <form action="<{$delete_url}>.php" method="post">
            <input id="type" type="hidden" name="type" value="<{$type}>">
            <table class="table table-striped" id="data_list" >
                <thead>
                <tr  class="export" >
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>采购申请单</th>
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
                    <th style="float: right">申请日期：<{$nowdate}></th>
                    <th></th>
                </tr>
                <tr class="jiaxian">
                    <th class="printnone">#</th>
                    <th>商品编码</th>
                    <th>商品名称</th>
                    <!--th>仓库</th-->
                    <th class="export" >数量</th>
                    <th>含税单价</th>
                    <th class="export">金额</th>
                    <th>供应商</th>
                    <th class="export">调整供应商</th>
                    <th class="printnone">库存数量</th>
                    <th class="printnone">状态</th>
                    <th class="printnone">创建时间</th>
                    <th class="export">申请部门</th>
                    <th class="export">备注</th>
                </tr>
                </thead>
                <tbody>
                <{foreach from=$list key=index item=value}>
                    <tr>
                        <td class="printnone"><label><input type="checkbox" name="checkbox" value="<{$value.goodsSn}>"></label></td>
                        <td><{$value.goodsSn}></td>
                        <td><{$value.goodsName}></td>
                        <td class="export"></td>
                        <td>
                            <{if $value.lastratepri >0 }>
                            <{$value.lastratepri|string_format:"%0.2f"}>
                            <{else}>
                            <{$value.lastPrice|string_format:"%0.2f"}> <{/if}>
                        </td>
                        <td class="export"></td>
                        <td><{$value.suppliername}></td>
                        <td class="export"></td>
                        <!--td><{$value.depotName}></td-->
                        <td class="printnone"><{$value.goodsCnt}></td>
                        <td class="printnone"><{$value.status}></td>
                        <td class="printnone"><{$value.createTime}></td>
                        <td class="export"></td>
                        <td class="export"></td>

                    </tr>
                    <{/foreach}>
                <tr class="export">
                    <td>申请人：</td>  <td></td>
                    <td>审核人：</td> <td  colspan="2"></td>
                    <td>审批人：</td> <td></td>
                    <td>审批日期：</td> <td></td>
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
function beforeExport(e) {
    var k = 0;
    $('input:checkbox:checked').each(function(i){
        k = i+1;
    });
    if(k==0){
        method5('data_list')
    }else{
        var table = $('#data_list').html();
        $('input:checkbox:not(:checked)').each(function(i){
            $(this).parent().parent().parent().remove();
        });
        $('.printnone').remove();
        method5('data_list')
        $('#data_list').html(table);
    }

}
function beforeprint() {
    var k = 0;
    $('input:checkbox:checked').each(function(i){
        k = i+1;
    });
    if(k==0){
        method5('data_list')
    }else{
        $('input:checkbox:not(:checked)').each(function(i){
            $(this).parent().parent().parent().css('display','none');
        });
        printorder();
        $('input:checkbox:not(:checked)').each(function(i){
            $(this).parent().parent().parent().css('display','');
        });
    }
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