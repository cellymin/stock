<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<style>
    .export {display:none;}
    .export_head {display:none;}
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
    <div id="page-stats" class="block-body collapse in"  >
        <div id="data_list">
        <form action="<{$delete_url}>.php" method="post">
            <input id="type" type="hidden" name="type" value="<{$type}>">
            <table style="border-top:0 none;border-left:0 none;border-right: 0 none;border-bottom:0 none;frame:above">
                <tr  class="export_head" style="border-top:0 none;border-left:0 none;border-right: 0 none;border-bottom:0 none;frame:above">
                    <td colspan="10" style="text-align: center;height: 25px;">采购申请单</td>
                </tr>
                <tr  class="export" style="border-top:0 none;border-left:0 none;border-right: 0 none;border-bottom:0 none" >
                    <td colspan="10" style="text-align: left;height: 25px;">申请部门：</td>
                </tr>
            </table>
            <table class="table table-striped" style="border-collapse:collapse;" border="1px">
                <thead>

                <tr>
                    <th class="printnone" style="height: 25px;">#</th>
                    <th style="height: 25px;">商品编码</th>
                    <th style="height: 25px;">商品名称</th>
                    <!--th>仓库</th-->
                    <th class="export" style="height: 25px;">数量</th>
                    <th style="height: 25px;">含税单价</th>
                    <th class="export" style="height: 25px;">金额</th>
                    <th style="height: 25px;">供应商</th>
                    <th class="export" style="height: 25px;">调整供应商</th>
                    <th style="height: 25px;width: 100px;">库存数量</th>
                    <th class="printnone" style="height: 25px;">状态</th>
                    <th class="printnone" style="height: 25px;">创建时间</th>
                    <th class="export" style="height: 25px;">申请部门</th>
                    <th class="export" style="height: 25px;width: 100px;">备注</th>
                </tr>
                </thead>
                <tbody>
                <{foreach from=$list key=index item=value}>
                    <tr>
                        <td class="printnone" style="height: 25px;"><label><input type="checkbox" name="checkbox" value="<{$value.goodsSn}>"></label></td>
                        <td style="height: 25px;"><{$value.goodsSn}></td>
                        <td style="height: 25px;"><{$value.goodsName}></td>
                        <td class="export" style="height: 25px;"></td>
                        <td style="height: 25px;">
                            <{if $value.lastratepri >0 }>
                            <{$value.lastratepri|string_format:"%0.2f"}>
                            <{else}>
                            <{$value.lastPrice|string_format:"%0.2f"}> <{/if}>
                        </td>
                        <td class="export" style="height: 25px;"></td>
                        <td style="height: 25px;"><{$value.suppliername}></td>
                        <td class="export" style="height: 25px;"></td>
                        <!--td><{$value.depotName}></td-->
                        <td style="height: 25px;width: 100px;"><{$value.goodsCnt}></td>
                        <td class="printnone" style="height: 25px;"><{$value.status}></td>
                        <td class="printnone" style="height: 25px;"><{$value.createTime}></td>
                        <td class="export" style="height: 25px;"></td>
                        <td class="export" style="height: 25px;width: 100px;">税率<{$value.taxrate}></td>

                    </tr>
                    <{/foreach}>

                </tbody>
            </table>
            <table style="border-top:0 none;border-left:0 none;border-right: 0 none;border-bottom:0 none;">
                <tr class="export" >
                    <td style="height: 25px;">申请人：</td>  <td class="line_pri">__________ </td>
                    <td style="height: 25px;">审核人：</td>  <td  class="line_pri">__________  </td>
                    <td style="height: 25px;">审批人：</td> <td  class="line_pri">__________  </td>
                    <td style="height: 25px;">审批日期：</td> <td  class="line_pri"> ________________</td>
                    <td style="height: 25px;">打印日期：</td> <td><{$nowdate}></td>
                </tr>
                <tr class="export"  style="border-top:0 none;border-left:0 none;border-right: 0 none;border-bottom:0 none">
                    <td colspan="10" style="text-align: left;height: 25px;">系统单价导出的是含税价</td>
                </tr>
            </table>
        </form>
        </div>
        <{$page_html}>
    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>

<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
<script>

        // function beforeExport() {
        //     var table = $('#data_list').html();
        //     $('.export').show();
        //     $('.printnone').remove();
        //     $("#data_list").table2excel({
        //         filename : "采购申请单-" + new Date().getTime() + ".xls" ,//文件名称
        //         exclude_img: true,
        //         exclude_links: true,
        //         exclude_inputs: true
        //     });
        //     $('#data_list').html(table);
        // }

    function beforeExport(e) {
        $('.export_head').css('display','')
        $('.export').css('display','')
        $('.line_pri').html('');
        var table = $('#data_list').html();
        $('input:checkbox:not(:checked)').each(function(i){
            $(this).parent().parent().parent().remove();
        });
        $('.printnone').remove();
        method5('data_list')
        $('#data_list').html(table);
        $('.export').css('display','none')
        $('.export_head').css('display','none')


    }
    function beforeprint() {
        $('input:checkbox:not(:checked)').each(function(i){
            $(this).parent().parent().parent().css('display','none');
        });
        printorder();
        $('input:checkbox:not(:checked)').each(function(i){
            $(this).parent().parent().parent().css('display','');
        });
        $('.export').css('display','none')
    }
    function printorder() {
        'use strict';
        $('.export_head').hide();
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