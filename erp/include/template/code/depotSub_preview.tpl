<{include file ="header.tpl"}>

<div class="form_div">
    <table id="barcode_preview" border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td style="text-align: center" id="print_area">
                <span style="font-size: 12px;display: block;margin: 0;">{$depotSub.depotSubName}</span>
                <img src="depotSub_preview.php?code=1&depotSubId=<{$depotSub.depotSubId}>" alt="" >
            </td>
        </tr>
    </table>
    <button id="code_print" class="btn btn-primary" onclick="toPrint()">打印</button>
</div>
<script>

    function toPrint() {
        $("#print_area").print({
            //是否包含父文档的样式，默认为true
            globalStyles : true,
            //是否包含media='print'的链接标签。会被globalStyles选项覆盖，默认为false
            mediaPrint : false,
            //外部样式
            stylesheet : '<{$smarty.const.ADMIN_URL}>/assets/css/print.css',
            //Print in a hidden iframe
            iframe : true,
            //不想打印的元素的jQuery选择器
            noPrintSelector : ".avoid-this",
            //Add this at top
            prepend : '',
            //将内容添加到打印内容的后面
            append : '',
            //回调方法
            deferred: $.Deferred().done(function() {
                console.log('Printing done', arguments);
                $('.pageHead').hide();
            })
        });
    }
</script>
