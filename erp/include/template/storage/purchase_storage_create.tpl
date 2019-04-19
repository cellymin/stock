<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<style>
    span {
        width: 100%;
        display: block;
    }
</style>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

供应商 <select id="selectInput" name="supplierId">
    <{foreach from=$suppliers_options item=v key=k}>
    <option value="<{$v.name}>" dd="<{$v.pinyin}>" es="<{$v.jianxie}>" ss="<{$k}>" taxrate="<{$v.taxrate}>"><{$v.name}>
    </option>
    <{/foreach}>
</select>
<a class="layerModel" action="1" title="选择供应商" layerUrl="<{$suppliers_url}>" layerW="600px"
   layerH="500px" layerT="2"><i class="icon-plus"></i> 选择</a>

<hr/>
<table border="1" id="tb_1">
    <tr style="display:none;">
        <td><select name="depotId" onchange="liand(this)" id="depotlist">
                <{foreach from=$depots_options item=v key=k}>
                <option value="<{$k}>"><{$v}></option>
                <{/foreach}>
            </select>
        </td>
        <td class="depotsub"><select name="depotSubId">

            </select>
        </td>
    </tr>
    <tr>
        <th>材料名称</th>
        <th>规格</th>
        <th>单位</th>
        <th>入库数量
        <th>含税价</th>
        <th>不含税价</th>
        <th>成本价</th>
        <th>仓库</th>
        <th>库位</th>
        <th>操作</th>
    </tr>
    <tr>
        <td>
            <select id="selectInputG" name="goodsId">
                <{foreach from=$goods_options item=v key=k}>
                <option value="<{$v.goodsName}>" dd="<{$v.pinyin}>" es="<{$v.jianxie}>" ss="<{$k}>"
                        unitName="<{$v.unitName}>" goodsSpec="<{$v.goodsSpec}>" lastPrice="<{$v.lastPrice}>"
                        depotId="<{$v.depotId}>" depotSubId="<{$v.depotSubId}>"><{$v.goodsName}>
                </option>
                <{/foreach}>
            </select>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

</table>
<script src="<{$smarty.const.ADMIN_URL}>/assets/js/searchSelectNew.js"></script>
<script type="text/javascript">

    var goosNames = new Array();
    selecthtml = '<select id="selectInputG" name="supplierId">' + $('#selectInputG').html() + '</select>';
    sousuo();

    function selecttext() {
        var selecthtml = '<select id="selectInputG" name="supplierId">' + $('#selectInputG').html() + '</select>';
        return selecthtml;
    }

    function sousuo() {
        //填入选择之后整行填入数据
        var flagG = false;//标记点击也面时输入框下方的div是否消失
        var selectOptionsG = null;//输入框提示的option数组
        inputSelectG("#selectInputG");
    }

    function inputSelectG() {

        if (arguments.length == 0) {
            alert("未传入参数");
            return;
        }
        if (typeof arguments[0] != "string") {
            alert("第一个参数请传入字符串");
        }
        var reg = /[#\.]?./;
        if (!reg.test(arguments[0])) {
            alert("输入参数表达式不正确");
            return;
        }
        var select = $(arguments[0]);
        //给selectInputG添加输入框内文本改变事件在IE下为oninput在其他浏览器下为onpropertychange

        var selectInputG = "<input id='" + "selectInputGClone" + "'  oninput='onInputG(this);' onpropertychange='onPropertyChangeG(this);'  type='text' name='" + select.attr("name") + "'></input><a class='layerModel' action='1' title='选择商品' layerUrl='goods_choose' layerW='800px' layerH='700px' layerT='2'><i class='icon-plus'></i> 选择</a>";
        var selectDivG = "<div id='" + "selectDivG" + "'></div>";
        var selectOption_ = select.find("option");
        selectOptionsG = new Array(selectOption_.length);
        var childrenOption = null;
        for (var i = 0; i < selectOption_.length; i++) {
            childrenOption = selectOption_.get(i);
            //alert(childrenOption);操蛋jquery的查找语句找出来的是DOM对象而不是jquery对象
            selectOptionsG[i] = $(childrenOption);
        }
        //移除原生的select,添加新的input
        select.before(selectInputG);
        select.after(selectDivG);
        select.remove();
        var selectInputGClone = $("#selectInputGClone");
        var left = selectInputGClone.offset().left;
        var top = selectInputGClone.offset().top + selectInputGClone.height() + 5;
        var width = selectInputGClone.width();
        $("#selectDivG").css({
            "position": "absolute",
            "top": top,
            "left": left,
            "width": width,
            "border": "1px solid #aaaaaa",
            "display": "none"
        })

        //文本框单击事件
        selectInputGClone.click(function () {
            var selectDivG = $("#selectDivG");
            selectDivG.empty();
            var selectInputGVal = selectInputGClone.val();
            //输入框内未填入信息是下方提示
            if (selectInputGVal == "undefined" || selectInputGVal == "null" || selectInputGVal == "") {
                for (var i = 0; i < selectOptionsG.length; i++) {
                    selectDivG.append("<span class='selectSpanG' onclick='chooseOptionG(this);' onmouseover='miG();' onmouseout='moG();' goodsSpec='" + selectOptionsG[i].attr('goodsSpec') + "' unitName='" + selectOptionsG[i].attr('unitName') + "' lastPrice='" + selectOptionsG[i].attr('lastPrice') + "' depotId='" + selectOptionsG[i].attr('depotId') + "' depotSubId='" + selectOptionsG[i].attr('depotSubId') + "' ssd='" + selectOptionsG[i].attr('ss') + "' value='" + selectOptionsG[i].val() + "'>" + selectOptionsG[i].text() + "</span><br>");
                }
                selectDivG.show();
                return;
            }
            //输入框内有数据时下方提示
            var matchOption = selectOptionsG.filter(function (item, index, array) {
                var regExpStr = "";
                for (var i = 0; i < selectInputGVal.length; i++) {
                    if (selectInputGVal.charAt(i) != ' ') {
                        regExpStr += "[" + selectInputGVal.charAt(i).toLowerCase() + "]+";
                    }
                }
                var reg = new RegExp(regExpStr);
                var tt = (item.val() + '' + item.attr('dd') + '' + item.attr('es')).replace(/\s/g, "");
                if (reg.test(tt)) {
                    return true;
                } else {
                    return false;
                }
            });
            for (var i = 0; i < matchOption.length; i++) {
                selectDivG.append("<span class='selectSpanG' onclick='chooseOptionG(this);' onmouseover='miG();' onmouseout='moG();' goodsSpec='" + selectOptionsG[i].attr('goodsSpec') + "' unitName='" + selectOptionsG[i].attr('unitName') + "' lastPrice='" + selectOptionsG[i].attr('lastPrice') + "' depotId='" + selectOptionsG[i].attr('depotId') + "' depotSubId='" + selectOptionsG[i].attr('depotSubId') + "' ssd='" + matchOption[i].attr('ss') + "' value='" + matchOption[i].val() + "'><b>" + matchOption[i].text() + "</b></span><br>");
            }
            selectDivG.show();
            return;
        })

        //文本框失去焦点事件
        selectInputGClone.focusout(function () {
            if (!flagG)
                $("#selectDivG").hide();
        })


    }

    //下方span单击事件
    function chooseOptionG(obj) {
        var supp = $('#selectInputClone').val();
        if (supp == '') {
            alert('供应商不能为空');
            $("#selectDivG").hide();
            return false;
        }
        var taxrate = parseFloat($('.selectssss').attr('taxrate'));
        if (1 > taxrate > 0) {
            var hanpri = parseFloat($(obj).attr("lastPrice")) * (1 + taxrate);
        } else {
            alert('税率不合法')
            $("#selectDivG").hide();
            return false;
        }
        var i = goosNames.indexOf($(obj).text());
        if (i >= 0) {
            alert('商品重复');
            $("#selectDivG").hide();
            return false;
        }
        $("#selectInputGClone").val($(obj).attr("value"));
        $('.selectssssG').remove();
        var depotId1 = $(obj).attr("depotId");
        $("#depotlist").find("option[value='" + depotId1 + "']").attr("selected", true);
        var depotll = $('#depotlist').html();
        $('#selectInputGClone').after('<input class="selectssssG" name="' + $('#selectInputGClone').attr("name") + '" type="hidden" value="' + $(obj).attr("ssd") + '" />');
        $("#selectDivG").hide();
        $.ajax({
            type: "post",
            url: "purchase_storage_createnew.php",
            data:{depotId:depotId1},
            async: false,
            dataType: "json",
            success: function (data) {
                var arr = Object.keys(data);
                var trs = "";
                $.each(data, function (n, value) {
                    if (n == $(obj).attr("depotSubId")) {
                        trs += '<option value="' + n + '"  selected>' + value + '</option>';
                    } else {
                        trs += '<option value="' + n + '" >' + value + '</option>';
                    }
                });
                $('#selectInputGClone').parent().parent().after('<tr><td>' + $(obj).text() + '</td><td>' + $(obj).attr("goodsSpec") + '</td><td>' + $(obj).attr("unitName") + '</td><td><input type="text"  style="width:45px;"></td><td><input type="text" style="width:45px;" class="hanpri" value=" ' + hanpri.toFixed(2) + '" onkeyup="ratejisuan(this)" /></td><td class="buhanpri">' + parseFloat($(obj).attr("lastPrice")).toFixed(6) + '</td><td>' + $(obj).attr("lastPrice") + '</td><td><select name="depotId" onchange="liand(this)">' + depotll + '</select></td><td class="depotsub"><select name="depotSubId"  >' + trs + '</select></td><td onclick="delgoods(this)">删除</td><tr><td>' + selecthtml + '</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>');
            }
        });
        $("#selectInputGClone").parent().parent().remove();
        $("#depotlist").find("option[value='" + depotId1 + "']").attr("selected", false);
        goosNames.push($(obj).text());
        sousuo();
        if (goosNames.length > 0) {
            $('#selectInputClone').attr('disabled', true);
        } else {
            $('#selectInputClone').removeAttr('disabled');
        }
        $(function () {
            $('.selectSpanG').each(function(e){
                console.log($(this).attr('ssd'));
                if($(this).attr('ssd')=='16'){
                    console.log($(e).val()+'11');
                }
            });
        })
    }

    //span鼠标进入事件
    function miG() {
        flagG = true;
    }

    //鼠标移除事件
    function moG() {
        flagG = false;

    }

    //IE下的文本框改变事件
    function onInputG(obj) {
        changeSelectDivOptionG(obj);
        $('.selectssssG').remove();
    }

    //其他文本框内容改变事件
    function onPropertyChangeG(obj) {
        changeSelectDivOptionG(obj);
        $('.selectssssG').remove();
    }

    function changeSelectDivOptionG(obj) {
        $("#selectDivG").empty();
        var va = $(obj).val();
        if (va == "") {
            selectOptionsG.forEach(function (item, index, array) {
                $("#selectDivG").append("<span class='selectSpanG' onclick='chooseOptionG(this);' onmouseover='miG();' onmouseout='moG();'  goodsSpec='" + item.attr('goodsSpec') + "' unitName='" + item.attr('unitName') + "' lastPrice='" + item.attr('lastPrice') + "' depotId='" + item.attr('depotId') + "' depotSubId='" + item.attr('depotSubId') + "' ssd='" + item.attr('ss') + "' value='" + item.val() + "'><b>" + item.text() + "</b></span><br>");
            });
        } else {
            var regStr = "";
            for (var i = 0; i < va.length; i++) {
                if (va.charAt(i) != ' ') {
                    regStr += "[" + va.charAt(i).toLowerCase() + "]+";
                }
            }
            //这里写$.ajax()异步请求扩充selectOptionsG数组，selectOptionsG内未option对象，也就是说，如果是json的话要将json转为option的jqery对象数组

            var reg = new RegExp(regStr);
            selectOptionsG.forEach(function (item, index, array) {
                var tt = (item.val() + '  ' + item.attr('dd') + '' + item.attr('es')).replace(/\s/g, "");
                if (reg.test(tt)) {
                    $("#selectDivG").append("<span class='selectSpanG' onclick='chooseOptionG(this);' onmouseover='miG();' onmouseout='moG();' goodsSpec='" + item.attr('goodsSpec') + "' unitName='" + item.attr('unitName') + "' lastPrice='" + item.attr('lastPrice') + "' depotId='" + item.attr('depotId') + "' depotSubId='" + item.attr('depotSubId') + "' ssd='" + item.attr('ss') + "' value='" + item.val() + "'><b>" + item.text() + "</b></span><br>");
                }
            });

            //这里可以遍历新的异步请求数组照上面写
        }

    }

    2
    //1.初始化


    var tTD; //用来存储当前更改宽度的Table Cell,避免快速移动鼠标的问题
    var table = document.getElementById("tb_1");
    for (j = 0; j < table.rows[0].cells.length; j++) {
        table.rows[0].cells[j].onmousedown = function () {
//记录单元格
            tTD = this;
            if (event.offsetX > tTD.offsetWidth - 10) {
                tTD.mouseDown = true;
                tTD.oldX = event.x;
                tTD.oldWidth = tTD.offsetWidth;
            }
//记录Table宽度
//table = tTD; while (table.tagName != ‘TABLE') table = table.parentElement;
//tTD.tableWidth = table.offsetWidth;
        };
        table.rows[0].cells[j].onmouseup = function () {
//结束宽度调整
            if (tTD == undefined) tTD = this;
            tTD.mouseDown = false;
            tTD.style.cursor = 'default';
        };
        table.rows[0].cells[j].onmousemove = function () {
//更改鼠标样式
            if (event.offsetX > this.offsetWidth - 10)
                this.style.cursor = 'col-resize';
            else
                this.style.cursor = 'default';
//取出暂存的Table Cell
            if (tTD == undefined) tTD = this;
//调整宽度
            if (tTD.mouseDown != null && tTD.mouseDown == true) {
                tTD.style.cursor = 'default';
                if (tTD.oldWidth + (event.x - tTD.oldX) > 0)
                    tTD.width = tTD.oldWidth + (event.x - tTD.oldX);
//调整列宽
                tTD.style.width = tTD.width;
                tTD.style.cursor = 'col-resize';
//调整该列中的每个Cell
                table = tTD;
                while (table.tagName != 'TABLE') table = table.parentElement;
                for (j = 0; j < table.rows.length; j++) {
                    table.rows[j].cells[tTD.cellIndex].width = tTD.width;
                }
//调整整个表
//table.width = tTD.tableWidth + (tTD.offsetWidth – tTD.oldWidth);
//table.style.width = table.width;
            }
        };
    }

    function delgoods(e) {
        var tt = $(e).parent().children().eq(0).text();
        var index = goosNames.indexOf(tt);
        if (index > -1) {
            goosNames.splice(index, 1);
        }
        $(e).parent().remove();

        if (goosNames.length > 0) {
            $('#selectInputClone').attr('disabled', true);
        } else {
            $('#selectInputClone').removeAttr('disabled');
        }
    }

    function liand(e) {
        var depotId = parseInt($(e).find("option:selected").val());
        if (depotId > 1) {
            $.ajax({
                type: "post",
                url: "purchase_storage_createnew.php",
                data:{depotId:depotId},
                async: false,
                dataType: "json",
                success: function (data) {
                    var arr = Object.keys(data);
                    var trs = "";
                    $.each(data, function (n, value) {
                        trs += '<option value="' + n + '" >' + value + '</option>';
                    });
                    $(e).parent().parent().find('.depotsub select').html(trs);
                }

            })
        } else {
            return false;
        }
    }

    function ratejisuan(e) {
        var hanlen = $(e).val().split('.')[1];
        var hanpri = parseFloat($(e).val());//含税价
        if (hanlen != '' && hanlen != undefined) {
            var hanslen = hanlen.length;
            if (hanslen >= 2) {
                $(e).val(hanpri.toFixed(2));
                hanpri = hanpri.toFixed(2);
            }
        }
        if (hanpri != 'NaN') {
            var rate = parseFloat($('.selectssss').attr('taxrate'));
            ;//税率
            var lastpri = hanpri / (1 + rate); //不含税价格=含税价/(1+税率)
            if (isNaN(lastpri)) {
                $(e).parent().parent().find('.buhanpri').text(0);
            } else {
                $(e).parent().parent().find('.buhanpri').text(decimal(lastpri, 6));
            }
        }
    }

    function decimal(num, v) {
        var vv = Math.pow(10, v);
        return Math.round(num * vv) / vv;
    }
</script>

