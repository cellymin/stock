<{include file='header.tpl'}>
<style>
    span, img {
        cursor: pointer;
    }
    *{ margin: 0;padding: 0}
</style>
<div class="form_div">
    <div style="float: left;text-align: left">
        <label style="text-align: center">打印属性</label>
        <table cellpadding="5">
            <tr>
                <td><span id="goodsSn" class="draggable">商品货号</span><br></td>
            </tr>
            <tr>
                <td><span id="goodsName" class="draggable">商品名称</span><br></td>
            </tr>
            <tr>
                <td><span id="cateName" class="draggable">分类名称</span><br></td>
            </tr>
            <tr>
                <td><img src="design.php?code=2&goodsId=0" alt="" id="goodsQRCode" class="draggable"></td>
            </tr>
            <tr>
                <td><img src="design.php?code=1&goodsId=0" alt="" id="goodsBarCode" class="draggable"></td>
            </tr>
        </table>

        <div style="margin-top: 20px;">
            <label>打印区域宽度：</label>
            <input type="number" id="printAreaWidth" class="input-large">
            <label>
                <button class="btn btn-primary" onclick="printArea.resize()">调整</button>
            </label>
        </div>
    </div>
    <div style="float: right;text-align: center">
        <label style="text-align: center">打印区域 宽度: <font class="width">300</font>px</label>
        <div style="width: 300px;height: 400px;border: 1px solid #ccc" id="printArea">

        </div>
    </div>
    <button id="code_print" class="btn btn-primary" onclick="designSave()">保存</button>
</div>
<script>

    var printArea = {
        top: $('#printArea').offset().top,
        left: $('#printArea').offset().left,

        resize: function () {
            var printAreaWidth = $("#printAreaWidth").val();
            if (/^[0-9]+/.test(printAreaWidth)) {
                if (printAreaWidth > 450) {
                    layer.msg('不能超出最大打印范围!');
                    return false;
                }
                if (printAreaWidth < 240) {
                    layer.msg('不能小于最小打印范围!');
                    return false;
                }
                $('#printArea').css({width:printAreaWidth});
                $('.width').text(printAreaWidth);

                printArea.top = $('#printArea').position().top;
                printArea.left = $('#printArea').position().left;
            }
        }
    };

    var goodsSn = {
        top: 0, left: 0, offsetTop: 0, offsetLeft: 0, initTop: 0, initLeft: 0, height: 0, width: 0
    };
    var goodsName = {
        top: 0, left: 0, offsetTop: 0, offsetLeft: 0, initTop: 0, initLeft: 0, height: 0, width: 0
    };
    var cateName = {
        top: 0, left: 0, offsetTop: 0, offsetLeft: 0, initTop: 0, initLeft: 0, height: 0, width: 0
    };
    var goodsQRCode = {
        top: 0, left: 0, offsetTop: 0, offsetLeft: 0, initTop: 0, initLeft: 0, height: 0, width: 0
    };
    var goodsBarCode = {
        top: 0, left: 0, offsetTop: 0, offsetLeft: 0, initTop: 0, initLeft: 0, height: 0, width: 0
    };

    $(function () {
        $(".draggable").draggable({
            start: function (event, ui) {
                var id = this.id;
                if (eval(id).initTop == 0) {
                    eval(id).initTop = $(this).position().top;
                }
                if (eval(id).initLeft == 0) {
                    eval(id).initLeft = $(this).position().left;
                }
                eval(id).height = $(this).height();
                eval(id).width = $(this).width();
            },
            stop: function (event, ui) {
                var id = this.id;
                var offsetTop = ui.offset.top - printArea.top;
                var offsetLeft = ui.offset.left - printArea.left;
                var minOffsetTop = 0;
                var minOffsetLeft = 0;
                var maxOffsetTop = parseInt(400 - eval(id).height);
                var maxOffsetLeft = parseInt($('#printArea').width() - eval(id).width);

                if (offsetTop < minOffsetTop || offsetTop > maxOffsetTop || offsetLeft < minOffsetLeft || offsetLeft > maxOffsetLeft) {
                    $(this).offset({top: eval(id).initTop,left:eval(id).initLeft});
                    eval(id).top = 0;
                    eval(id).left = 0;
                    eval(id).offsetTop = 0;
                    eval(id).offsetLeft = 0;
                } else {
                    eval(id).top = ui.offset.top;
                    eval(id).left = ui.offset.left;
                    eval(id).offsetTop = ui.offset.top - printArea.top;
                    eval(id).offsetLeft = ui.offset.left - printArea.left;
                }
            }
        });
    });

    window.onload = function() {
        var config = <{$set}>;
        $.each(config, function (i, v) {
            if ((v.top != 0 && v.left != 0) && i != 'printArea') {
                $('#' + i).offset({top:v.top,left:v.left});
                eval(i).top = v.top;
                eval(i).left = v.left;
                eval(i).offsetTop = v.offsetTop;
                eval(i).offsetLeft = v.offsetLeft;
                eval(i).initTop = v.initTop;
                eval(i).initLeft = v.initLeft;
                eval(i).height = v.height;
                eval(i).width = v.width;
            }
            if (i == 'printArea') {
                $("#printArea").css({width:v});
                $('.width').text(v);
            }
        });
    };

    function designSave() {
        var data = new Object();

        data.goodsSn = goodsSn;
        data.goodsName = goodsName;
        data.cateName = cateName;
        data.goodsQRCode = goodsQRCode;
        data.goodsBarCode = goodsBarCode;
        data.printArea = $("#printArea").width();

        //提交数据
        $.post('design.php',{data:data}, function (e) {
            if(e.code==1){
                layer.msg('设置成功');
                setTimeout(function () {
                    parent.layer.closeAll();
                },1000);
                return false;
            }
            layer.msg('设置失败');
        }, 'json');
    }
</script>