<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<{$js_confirm}>
<style>
    /*td

    {*/
                    /*padding: 2px 3px;*/
                /*}  */
    .table2 {
        width: 950px;
    }

    .table1 th {
        padding-left: 50px;
    }

    table {
        text-align: center;
    }

    .table3 {
        border: 0;
    }

    .table3 td {
        border-top: 1px solid black;
        border-left: 1px solid black;
    }

    .table3 tr:first-child td {
        border-top: 0;
    }

    .table3 td:first-child {
        border-left: 0;
    }
</style>
<div class="form_div">
    <div style="overflow: hidden" class="avoid-this">
        <button id="orderPrint" class="btn btn-primary" style="float: left;margin-bottom: 20px;"> 打印</button>
        <a type="button" class="btn btn-primary" onclick="method5('oorder')" style="margin-left: 10px;">导出</a>
    </div>
    <div style="clear:both;"></div>
    <div id="oorder" style="margin: 0 auto;">

        <table class="table1" style="margin: 0 auto;">
            <tr>
                <th>供应商ID:</th>
                <td><{$invoiceInfo.supplierId}></td>
                <th>供应商名称:</th>
                <td><{$invoiceInfo.supplierName}></td>
                <th>日期:</th>
                <td><{$date}></td>
            </tr>
        </table>
        <table class="table2" border="1" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
            <tr>
                <td>入库单号</td>
                <td>入库时间</td>
                <td style=" width: 50px;">行号</td>
                <td style=" width: 80px;">商品条码</td>
                <td style=" width: 220px;">商品名称</td>
                <td style=" width: 50px;">单位</td>
                <td style=" width: 100px;">单价(不含税)</td>
                <td style=" width: 80px;">数量</td>
                <td style=" width: 80px;">金额</td>
            </tr>
            <{foreach from=$invoiceInfo.invoices key=index item=v}>
            <tr>
                <td><{$orderNo[$v.invoiceId]}></td>
                <td><{$v.createTime|date_format:"%Y/%m/%d"}></td>
                <td colspan="7">
                    <table class="table3" border="1" cellspacing="0" cellpadding="0">
                        <{foreach from=$goodsList[$v.invoiceId] key=iindex item=vv}>
                        <tr class="invoice_<{$v.invoiceId}>">
                            <td style=" width: 50px;" class="hanghao">1</td>
                            <td style=" width: 80px;"><{$vv.goodsSn}></td>
                            <td style=" width: 220px;"><{$vv.goodsName}></td>
                            <td style=" width: 50px;"><{$vv.unitName}></td>
                            <td style=" width: 100px;"><{$vv.goodsPrice}></td>
                            <td style=" width: 80px;" class="goodscount"><{$vv.goodsCnt|string_format:"%.2f"}></td>
                            <td style=" width: 80px;" class="goodsmon" attrid="<{$vv.goodsPrice*$vv.goodsCnt}>">
                                <{($vv.goodsPrice*$vv.goodsCnt)|string_format:"%0.2f"}>
                            </td>
                        </tr>
                        <{/foreach}>
                    </table>
                </td>
            </tr>
            <{/foreach}>
            <tr>
                <td>小计</td>
                <td colspan="6"></td>
                <td class="totalcount">0</td>
                <td class="totalmon">0</td>
            </tr>
            <tr>
                <td>合计（不含税）</td>
                <td colspan="7"></td>
                <td class="noratetotal">0</td>
            </tr>
            <tr>
                <td>开票调整</td>
                <td colspan="8"></td>
            </tr>
            <tr>
                <td>税金（税率<span class="rate"><{$invoiceInfo.taxrate}></span>)</td>
                <td colspan="7"></td>
                <td class="ratemon">0</td>
            </tr>
            <tr>
                <td>合计（含税）</td>
                <td colspan="7"></td>
                <td class="ratetotal">0</td>
            </tr>
            <tr>
                <td height="20px" colspan="9"></td>
            </tr>
            <tr>
                <td>审核人：</td>
                <td colspan="2"></td>
                <td>采购员：</td>
                <td colspan="2"></td>
                <td>仓管员：</td>
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

