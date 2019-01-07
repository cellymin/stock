<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<{$js_confirm}>
<div class="form_div">
    <div style="overflow: hidden" class="avoid-this">
        <button id="orderPrint" class="btn btn-primary" style="float: left;margin-bottom: 20px;"> 打印</button>
        <a type="button" class="btn btn-primary" onclick="method5('oorder')" style="margin-left: 10px;">导出</a>
    </div>
    <div style="clear:both;"></div>
    <div style="margin: 0 auto;">
        <table id="oorder" border="1" cellpadding="0" cellspacing="0"
               style="text-align: center; margin: 0 auto;width: 970px">
            <tr>
                <th style="border: none; text-align: right;">供应商ID:</th>
                <td style="border: none; text-align: left"><{$invoiceInfo.supplierId}></td>
                <th style="border: none; text-align: right" colspan="2">供应商名称:</th>
                <td style="border: none; text-align: left" colspan="3"><{$invoiceInfo.supplierName}></td>
                <th style="border: none; text-align: right">日期:</th>
                <td style="border: none; text-align: left"  colspan="2"><{$date}></td>
            </tr>
            <tr>
                <td width="180px">入库单号</td>
                <td width="80px">入库时间</td>
                <td width="40px">已合并</td>
                <td width="50px">行号</td>
                <td width="80px">商品条码</td>
                <td width="200px">商品名称</td>
                <td width="50px">单位</td>
                <td width="100px">单价(不含税)</td>
                <td width="50px">数量</td>
                <td width="50px">金额</td>
            </tr>
            <{foreach from=$invoiceInfo.invoices key=index item=v}>
            <tr>
            <td rowspan="<{$spanno[$v.invoiceId]}>"><{$orderNo[$v.invoiceId].orderNo}></td>
            <td rowspan="<{$spanno[$v.invoiceId]}>"><{$v.createTime|date_format:"%Y/%m/%d"}></td>
            <td rowspan="<{$spanno[$v.invoiceId]}>"><{if $orderNo[$v.invoiceId].ifhe==0}>否<{else}>是<{/if}></td>
            <{foreach from=$goodsList[$v.invoiceId] key=iindex item=vv}>
            <{if $iindex!=0}>
            <tr>
            <{/if}>
            <td class="hanghao">1</td>
            <td><{$vv.goodsSn}></td>
            <td><{$vv.goodsName}></td>
            <td><{$vv.unitName}></td>
            <td> <{if $vv.usecostpri >0 }><{$vv.usecostpri}> <{else}> <{$vv.goodsPrice}> <{/if}></td>
            <td class="goodscount"><{$vv.goodsCnt|string_format:"%.2f"}></td>
            <td class="goodsmon"
                attrid=" <{if $vv.usecostpri >0 }><{$vv.usecostpri*$vv.goodsCnt}> <{else}>  <{$vv.goodsPrice*$vv.goodsCnt}> <{/if}>">
                <{if $vv.usecostpri >0 }>
                <{($vv.usecostpri*$vv.goodsCnt)|string_format:"%0.2f"}>
                <{else}>
                <{($vv.goodsPrice*$vv.goodsCnt)|string_format:"%0.2f"}> <{/if}>
            </td>
            </tr>
            <{/foreach}>
            <{/foreach}>
            <tr>
                <td>小计</td>
                <td colspan="7"></td>
                <td class="totalcount">0</td>
                <td class="totalmon">0</td>
            </tr>

            <tr>
                <td>合计（不含税）</td>
                <td colspan="8"></td>
                <td class="noratetotal">0</td>
            </tr>
            <tr>
                <td>开票调整</td>
                <td colspan="9"></td>
            </tr>
            <tr>
                <td>税金（税率)<span class="rate"><{$invoiceInfo.taxrate}></span>)</td>
                <td colspan="8"></td>
                <td class="ratemon">0</td>
            </tr>
            <tr>
                <td>合计（含税）</td>
                <td colspan="8"></td>
                <td class="ratetotal">0</td>
            </tr>
            <tr class="kong">
                <td colspan="10" height="20px"></td>
            </tr>
            <tr class="kong">
                <td>审核人：</td>
                <td colspan="2"></td>
                <td colspan="2">采购员：</td>
                <td colspan="1"></td>
                <td colspan="2">仓管员：</td>
                <td colspan="2"></td>
            </tr>
        </table>
    </div>

</div>
<script>
    jQuery(function ($) {
        'use strict';
        $("#orderPrint").on('click', function () {
            $('.pageHead').show();
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
        });
        // Fork https://github.com/sathvikp/jQuery.print for the full list of options
        var goodscnt = 0,
            goodspri = 0.00,
            tt = 0.00,
            rate = parseFloat($('.rate').text()),
            ratemon = 0,
            hanghao = 0,
            ratepri = 0;
        $('.goodscount').each(function () {
            goodscnt = goodscnt + parseInt($(this).text());
        });
        $('.goodsmon').each(function () {
            tt = parseFloat($(this).attr('attrid'));
            goodspri = goodspri + tt;
        });

        ratepri = goodspri * (1 + rate);//含税价
        ratemon = goodspri * rate;//税金
        $('.totalcount').text(goodscnt);//总数量
        $('.totalmon').text(goodspri.toFixed(2));//不含税价

        $('.noratetotal').text(goodspri.toFixed(2));//不含税价
        $('.ratetotal').text(ratepri.toFixed(2));//含税价
        $('.ratemon').text(ratemon.toFixed(2));//税金

        $('.hanghao').each(function () {
            $(this).text(hanghao + 1);
            hanghao = hanghao + 1
        });
        var dh = $('tr td:first-child');
        var arr = [];
        for (var i = 0; i < dh.length; i++) {
            arr.push(dh[i].innerText);
        }
    });

</script>

