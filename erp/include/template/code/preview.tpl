<{include file ="header.tpl"}>
<style>
    *{ margin: 0;padding: 0}
</style>
<div class="form_div">
    <div style="float: left;text-align: left">
        <img src="preview.php?code=1&goodsId=<{$goods.goodsId}>" alt="">
        <label style="text-align: center">打印属性</label>
        <table cellpadding="5">
            <tr>
                <td></td>
            </tr>
            <tr>
                <td><span id="goodsSn" class="draggable"><{$goods.goodsSn}></span><br></td>
            </tr>
            <tr>
                <td><span id="goodsName" class="draggable"><{$goods.goodsName}></span><br></td>
            </tr>
            <tr>
                <td><span id="cateName" class="draggable"><{$goods.cateName}></span><br></td>
            </tr>
            <tr>
                <td><img src="preview.php?code=2&goodsId=<{$goods.goodsId}>" alt="" id="goodsQRCode" class="draggable"></td>
            </tr>
            <tr>
                <td><img src="preview.php?code=1&goodsId=<{$goods.goodsId}>" alt="" id="goodsBarCode" class="draggable"></td>
            </tr>
        </table>
    </div>
    <div style="float: right;text-align: center">
        <label style="text-align: center">打印区域 宽度: <font class="width">300</font>px</label>
        <div style="width: 300px;height: 400px;border: 1px solid #ccc;" id="printArea" >

        </div>
    </div>
    <button id="code_print" class="btn btn-primary" onclick="toPrint()">打印</button>
</div>
<script>

    window.onload = function() {
        var config = <{$set}>;
        $.each(config, function (i, v) {
            var ptop = $("#printArea").offset().top;
            var pleft = $("#printArea").offset().left;

            if(v.top!=0 && v.left!=0 && i!='printArea'){
                $("#printArea").append($('#'+i));
                var top = parseInt(ptop)+parseInt(v.offsetTop);
                var left = parseInt(pleft)+parseInt(v.offsetLeft);

                console.log(top);
                console.log(left);

                $('#'+i).offset({top:top,left:left})
            }
        });
    };

    $("#printArea").css({width:config.printArea});
    $('.width').text(config.printArea);

    function toPrint() {
        $("#printArea").print({
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
