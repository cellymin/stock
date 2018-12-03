<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<{$js_confirm}>
<style>
    table{
        width: 900px;
    }
    table tr td{
        padding: 3px;
    }
    .gys2,.gys4{
        text-align: left;
    }
    .gys1,.gys3{
        text-align: right;
    }
</style>
<div class="form_div">
    <div style="overflow: hidden" class="avoid-this">
        <button id="orderPrint" class="btn btn-primary" style="float: left;margin-bottom: 20px;" > 打印</button>
       <!-- <a type="button" class="btn btn-primary" onclick="method5('oorder')" style="margin-left: 10px;">导出</a>-->
    </div>
    <div id="oorder" style="margin: 0 auto;">
        <table style="text-align: center; margin: 0 auto;">
            <tr>
                <th class="gys1">供应商ID:</th>
                <td class="gys2" colspan="2" ><{$invoiceInfo.supplierId}></td>
                <th class="gys3" colspan="2">供应商名称:</th>
                <td class="gys4" colspan="3"><{$invoiceInfo.supplierName}></td>
            </tr>
        </table>
        <table border="1" cellpadding="0" cellspacing="0" style="text-align: center; margin: 0 auto">
            <tr>
                <td colspan="6">发票对账单</td>
                <td>日期</td>
                <td><{$date}></td>
                <td>行号</td>
            </tr>
            <tr>
                <td>入库单号</td>
                <td colspan="2">入库时间</td>
                <td colspan="5">商品明细</td>
                <td class="hanghao">0</td>
            </tr>
            <{foreach from=$invoiceInfo.invoices key=index item=v}>
            <tr>

                <td rowspan="<{$spanno[$v.invoiceId]+1}>"><{$orderNo[$v.invoiceId]}></td>
                <td rowspan="<{$spanno[$v.invoiceId]+1}>" colspan="2"><{$v.createTime|date_format:"%Y/%m/%d"}></td>

                <{if $index==0}>

                <td>商品条码</td>
                <td>商品名称</td>
                <td>单价(不含税)</td>
                <td>数量</td>
                <td>余额</td>
                <td class="hanghao">0</td>
                <{/if}>
            </tr>
            <{foreach from=$goodsList[$v.invoiceId] key=iindex item=vv}>
            <tr class="invoice_<{$v.invoiceId}>">

                <td><{$vv.goodsSn}></td>
                <td width="220px"><{$vv.goodsName}></td>
                <td><{$vv.goodsPrice}></td>
                <td class="goodscount"><{$vv.goodsCnt|string_format:"%.2f"}></td>
                <td class="goodsmon" attrid="<{$vv.goodsPrice*$vv.goodsCnt}>"><{($vv.goodsPrice*$vv.goodsCnt)|string_format:"%0.2f"}></td>
                <td class="hanghao">0</td>
            </tr>
            <{/foreach}>
            <{/foreach}>

            <tr>
                <td>小计</td>
                <td colspan="5"></td>
                <td class="totalcount">0</td>
                <td class="totalmon">0</td>
                <td class="hanghao">0</td>
            </tr>
            <tr>
                <td colspan="9" style="text-align: left;margin-left: 5px;">开票调整</td>
            </tr>
            <tr>
                <td>合计（不含税）</td>
                <td colspan="6"></td>
                <td class="noratetotal">0</td>
                <td class="hanghao">0</td>
            </tr>
            <tr>
                <td>税金（税率<span class="rate"><{$invoiceInfo.taxrate}></span>)</td>
                <td colspan="6"></td>
                <td class="ratemon">0</td>
                <td class="hanghao">0</td>
            </tr>
            <tr>
                <td>合计（含税）</td>
                <td colspan="6"></td>
                <td class="ratetotal">0</td>
                <td class="hanghao">0</td>
            </tr>
            <tr class="kong">
                <td colspan="9" height="20px"></td>
            </tr>
            <tr class="kong">
                <td>审核人：</td>
                <td colspan="2"></td>
                <td>采购员：</td>
                <td  colspan="2"></td>
                <td>仓管员：</td>
                <td  colspan="2"></td>
            </tr>
        </table>
    </div>

</div>
<script>
    jQuery(function($) {
        'use strict';
        $("#orderPrint").on('click', function() {
            $('.pageHead').show();
            $(".form_div").print({
                //是否包含父文档的样式，默认为true
                globalStyles : true,
                //是否包含media='print'的链接标签。会被globalStyles选项覆盖，默认为false
                mediaPrint : false,
                //外部样式
                stylesheet : '<{$smarty.const.ADMIN_URL}>/assets/css/print.css',
                //Print in a hidden iframe
                iframe : false,
                //不想打印的元素的jQuery选择器
                noPrintSelector : ".avoid-this",
                //Add this at top
                prepend : 'Hello World',
                //将内容添加到打印内容的后面
                append : '11111',
                //回调方法
                deferred: $.Deferred().done(function() {
                    console.log('Printing done', arguments);
                    $('.pageHead').hide();
                })
            });
        });
        // Fork https://github.com/sathvikp/jQuery.print for the full list of options
         var goodscnt = 0,
             goodspri = 0.00,
             tt =0.00,
             rate = parseFloat($('.rate').text()),
             ratemon = 0,
             hanghao = 0,
             ratepri = 0;
        $('.goodscount').each(function(){
            goodscnt=goodscnt+parseInt($(this).text());
        });
        $('.goodsmon').each(function(){
            tt = parseFloat($(this).attr('attrid'));
            goodspri= goodspri + tt;
        });
        console.log(rate);
        ratepri = goodspri * (1+rate);
        ratemon = goodspri * rate;

        $('.totalcount').text(goodscnt);
        $('.totalmon').text(goodspri.toFixed(2));
        $('.noratetotal').text(goodspri.toFixed(2));
        $('.ratetotal').text(ratepri.toFixed(2));
        $('.ratemon').text(ratemon.toFixed(2));

        $('.hanghao').each(function(){
             $(this).text(hanghao+1);
            hanghao=hanghao+1
        });

    });

</script>

