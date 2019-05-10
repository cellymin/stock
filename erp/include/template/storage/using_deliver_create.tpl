<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<style>
    span {
        /*width: 100%;*/
        display: block;
    }
    .search{
        height: 30px;
        line-height: 30px;
        position: relative;
    }
    .search_text{
        display: inline-block;
        line-height: 30px;
    }
    .saveSubmit{
        position: absolute;
        bottom: 80px;
        right: 100px;
        width: 80px;
        height: 40px;
        background-color: #4d5b76;
        color: #fff;
    }
    #selectDivG{
        width: 220px;
        height: 200px;
        overflow-y:auto;
        white-space:nowrap;
    }
    #selectDiv{
        position: absolute;
        top: 30px;
        width: 280px;
        height: 500px;
        overflow-y:auto;
        white-space:nowrap;
        background-color: #BEBEBE;
    }
    .imgDel{
        width: 30px;
        height: 30px;
    }
    .imgDel1{
        width: 28px;
        height: 28px;
    }
</style>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<table class="table" border="1" id="tb_1">
    <input type="hidden" class="goodsName" value="11" name="ss"/>
    <tr style="display:none;">
        <td><select name="depart" onchange="changedepart(this);" id="departlist">
                <{foreach from=$department_options item=v key=k}>
                <option value="<{$k}>"><{$v}></option>
                <{/foreach}>
            </select>
        </td>
        <td class="employee"><select name="employeeId">

            </select>
        </td>
    </tr>
    <tr>
        <th>名称_批次号</th>
        <th>仓库</th>
        <th>库位
        <th>数量</th>
        <th>入库时间</th>
        <th>部门</th>
        <th>负责人</th>
        <th>操作</th>
    </tr>
    <{foreach name=module from=$order.goods.list key=index item=value}>
    <tr>
        <td attid="<{$order.depotGoodsId}>"><i style="font-style: normal;" class="gname"><{$value.goodsName}>_<{$value.orderSubNo}></i><i
                    attid="<{$value.goodsId}>" title="修改商品名称"></i></td>
        <td><{$order.depotName}></td>
        <td><{$value.depotSubName}></td>
        <td><input type="text" value="<{$value.goodsCnt|string_format:"%.2f"}>" style="width:45px;"
                   onkeyup="changenum(this)"></td>
        <td><{$value.createTime}></td>
        <td class="depart"><select name="bumen" onchange="changedepart(this)" style="width:100px;">
                <{foreach from=$department_options item=v key=k}>
            <option value="<{$k}>" <{if $k == $value.departmentId }> selected <{/if}> ><{$v}></option>
                <{/foreach}>
            </select></td>
        <td class="employee"><select name="employeeId" style="width:100px;">
                <{if $order.goods.list }>
                <option value="<{$value.employeeId}>" selected><{$value.employeeName}></option>
                <{/if}>
            </select></td>
        <td onclick="delgoods(this)"><img class="imgDel" src="../assets/images/trash.png"></td>
        <td class="depotid" style="display:none ;"><{$order.depotId}></td>
        <td class="depotsubid" style="display:none ;"><{$value.depotSubId}></td>
        <td class="supplierid" style="display:none ;"><{$value.supplierId}></td>
        <td class="goodsPrice" style="display:none ;"><{$value.goodsPrice}></td>
    </tr>
        <{/foreach}>
    <tr>
        <td>
            <select id="selectInputG" name="goodsId">
                <{foreach from=$goods_options item=v key=k}>
                <option depotgoodsId=<{$k}> value="<{$v.goodsName}>" dd="<{$v.pinyin}>" es="<{$v.jianxie}>" ss="<{$v.goodsId}>"
                        depotId="<{$v.depotId}>" depotSubId="<{$v.depotSubId}>" supplierId="<{$v.supplierId}>"
                        depotName="<{$v.depotName}>" depotSubName="<{$v.depotSubName}>" goodsPrice="<{$v.goodsPrice}>" createTime="<{$v.createTime}>" ><{$v.goodsName}>
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
    </tr>
</table>
<div class="other">
    <div>
        <span style="font-weight: bold;border-bottom:1px solid #e2e2e2; ">其他信息</span>
        <span style="margin: 30px;">备注：<textarea class="beizhu" style="width: 50%;height: 100px;"><{$order.remark}></textarea></span>
    </div>
    <div>
        <span style="font-weight: bold;border-bottom:1px solid #e2e2e2; ">入库金额</span>
        <div style="display: flex"><span style="margin: 30px;">入库总金额：￥<em style="font-style:normal" class="totalmoney"><{$order.totalMoney|string_format:"%.2f"}></em></span> <span style="margin: 30px;">入库总数：<em
                        style="font-style:normal" class="totalnum"> <{$order.totalCnt|string_format:"%.2f"}></em></span></div>
    </div>
    <button onclick="savelist();" class="saveSubmit">保存</button>
</div>
<{include file="footer.tpl" }>
<script type="text/javascript">
    var goosNames = new Array();
    var oldGoosNames = new Array();
    var totalnum = 0;
    var totalpri = 0;
    var beforgn = '';
    var selectOption_ = null;
    var flagG = false;//标记点击也面时输入框下方的div是否消失
    var selectOptionsG = null;//输入框提示的option数组
    selecthtml = '<select id="selectInputG" name="supplierId">' + $('#selectInputG').html() + '</select>';
    sousuo();
    $(function () {
        var trlen =  $('#tb_1 tr').length;
        $('#tb_1 tr').each(function (i) {
            if(i>1 && i<trlen-1) {
                // goodslist[i]['goodsName'] = $(this).children().eq(0).text();
                gname = $(this).children().eq(0).text().trim().replace(/\s/g, "");
                ggid = $(this).children().eq(0).children().eq(1).attr('attid').trim().replace(/\s/g, "");
                goosNames.push(gname);
                oldGoosNames.push(ggid);
            }
        })
    });

    function sousuo() {
        //填入选择之后整行填入数据
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

        var selectInputG = "<input id='" + "selectInputGClone" + "'  oninput='onInputG(this);' onpropertychange='onPropertyChangeG(this);'  type='text' name='" + select.attr("name") + "'  placeholder='请输入商品或选择商品' /></input><a class='layerModel' action='1' title='选择商品' layerUrl='depot_goods_choose' layerW='800px' layerH='700px' layerT='2'><i class='icon-plus'></i> 选择</a>";
        var selectDivG = "<div id='" + "selectDivG" + "'></div>";
        if (selectOption_ == null) {
            selectOption_ = select.find("option");
        }
        // console.log(selectOption_);
        // console.log($(arguments[0]).find("option")[0].firstChild.textContent);
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
            // "position": "absolute",
            // "top": top,
            // "left": left,
            // "width": width,
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
                    selectDivG.append("<span class='selectSpanG' onclick='chooseOptionG(this);' onmouseover='miG();' onmouseout='moG();' depotgoodsId='"+ selectOptionsG[i].attr('depotgoodsId') +"' depotId='"+selectOptionsG[i].attr('depotId')+"' depotSubId='"+selectOptionsG[i].attr('depotSubId')+"'  depotName= '"+selectOptionsG[i].attr('depotName')+"'supplierId='" + selectOptionsG[i].attr('supplierId') + "' depotSubName='" + selectOptionsG[i].attr('depotSubName') + "' goodsPrice='" + selectOptionsG[i].attr('goodsPrice') + "' depotId='" + selectOptionsG[i].attr('depotId') + "' depotSubId='" + selectOptionsG[i].attr('depotSubId') + "' ssd='" + selectOptionsG[i].attr('ss') + "' createTime='" + selectOptionsG[i].attr('createTime') + "' value='" + selectOptionsG[i].val() + "'>" + selectOptionsG[i].text() + "</span><br>");
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
                selectDivG.append("<span class='selectSpanG' onclick='chooseOptionG(this);' onmouseover='miG();' onmouseout='moG();' depotgoodsId='"+ selectOptionsG[i].attr('depotgoodsId') +"' depotId='"+selectOptionsG[i].attr('depotId')+"' depotSubId='"+selectOptionsG[i].attr('depotSubId')+"' depotName ='"+selectOptionsG[i].attr('depotName')+"'supplierId='" + selectOptionsG[i].attr('supplierId') + "' depotSubName='" + selectOptionsG[i].attr('depotSubName') + "' goodsPrice='" + selectOptionsG[i].attr('goodsPrice') + "' depotId='" + selectOptionsG[i].attr('depotId') + "' depotSubId='" + selectOptionsG[i].attr('depotSubId') + "' ssd='" + matchOption[i].attr('ss') + "'  createTime='" + selectOptionsG[i].attr('createTime') + "' value='" + matchOption[i].val() + "'><b>" + matchOption[i].text() + "</b></span><br>");
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
        var departeslect = $('#departlist').html();
        if ($('.goodsName').val() != '11') {
            var gdn = $('.goodsName').val();
            goosNames1 = gdn.split(",")
            $.each(goosNames1, function (index, value) {
                if ($.inArray(value, goosNames) < 0) {
                    goosNames.push(value);
                }
            });
            $('.goodsName').val(11)
        }
        var i = goosNames.indexOf($(obj).text().trim().replace(/\s/g, ""));
        if (i >= 0) {
            $("#selectDivG").hide();
            Alert('商品重复');
            return false;
        }
        $("#selectInputGClone").val($(obj).attr("value"));
        $('.selectssssG').remove();
        $('#selectInputGClone').after('<input class="selectssssG" name="' + $('#selectInputGClone').attr("name") + '" type="hidden" value="' + $(obj).attr("ssd") + '" />');
        $("#selectDivG").hide();
        $('#selectInputGClone').parent().parent().after('<tr><td attid="'+  $(obj).attr("depotgoodsId") +'"><i style="font-style: normal;" class="gname">' + $(obj).text() + '</i><i  attid="' + $(obj).attr("ssd") + '" title="修改商品名称"></i></td><td>' + $(obj).attr("depotname") + '</td><td>' + $(obj).attr("depotsubname") + '</td><td><input type="text" value="" style="width:45px;" onkeyup="changenum(this)"></td><td>' + ($(obj).attr("createtime")).substring(0,10) + '</td><td class="depart"><select name="bumen" onchange="changedepart(this)" style="width:100px;">'+departeslect+' </select></td><td class="employee"><select name="employeeId" style="width:100px;"> </select></td><td onclick="delgoods(this)"><img class="imgDel" src="../assets/images/trash.png"></td><td class="depotid" style="display:none ;">'+$(obj).attr("depotid") +'</td><td class="depotsubid" style="display:none ;">'+$(obj).attr("depotsubid") +'</td><td class="supplierid" style="display:none ;">'+$(obj).attr("supplierid") +'</td><td class="goodsPrice" style="display:none ;">'+$(obj).attr("goodsPrice") +'</td></tr><tr><td>' + selecthtml + '</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>');
        $("#selectInputGClone").parent().parent().remove();
        goosNames.push($(obj).text().trim().replace(/\s/g, ""));
        sousuo();
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
                $("#selectDivG").append("<span class='selectSpanG' onclick='chooseOptionG(this);' onmouseover='miG();' onmouseout='moG();' depotgoodsId='"+ item.attr('depotgoodsId') +"' depotId='"+item.attr('depotId')+"' depotSubId='"+item.attr('depotSubId')+"' depotName='"+item.attr('depotName')+"'supplierId='" + item.attr('supplierId') + "' depotSubName='" + item.attr('depotSubName') + "' goodsPrice='" + item.attr('goodsPrice') + "' depotId='" + item.attr('depotId') + "' depotSubId='" + item.attr('depotSubId') + "' ssd='" + item.attr('ss') + "'  createTime='" + item.attr('createTime') + "' value='" + item.val() + "'><b>" + item.text() + "</b></span><br>");
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
                    $("#selectDivG").append("<span class='selectSpanG' onclick='chooseOptionG(this);' onmouseover='miG();' onmouseout='moG();' depotgoodsId='"+ item.attr('depotgoodsId') +"' depotId='"+item.attr('depotId')+"' depotSubId='"+item.attr('depotSubId')+"' depotName= '"+item.attr('depotName')+"'supplierId='" + item.attr('supplierId') + "' depotSubName='" + item.attr('depotSubName') + "' goodsPrice='" + item.attr('goodsPrice') + "' depotId='" + item.attr('depotId') + "' depotSubId='" + item.attr('depotSubId') + "' ssd='" + item.attr('ss') + "'  createTime='" + item.attr('createTime') + "' value='" + item.val() + "'><b>" + item.text() + "</b></span><br>");
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
        if(confirm("确定删除？"))
        {
            if ($('.goodsName').val() != '11') {
                var gdn = $('.goodsName').val();
                goosNames1 = gdn.split(",")
                $.each(goosNames1, function (index, value) {
                    if ($.inArray(value, goosNames) < 0) {
                        goosNames.push(value);
                    }
                });
                $('.goodsName').val(11)
            }
            var tt = $(e).parent().children().eq(0).text().trim().replace(/\s/g, "");
            var index = goosNames.indexOf(tt);
            if (index > -1) {
                goosNames.splice(index, 1);
            }
            $(e).parent().remove();
            totalcount();
        }else{
            return false;
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
            $(e).parent().parent().find('.depotsub select').html('');
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
        totalcount();
    }

    function decimal(num, v) {
        var vv = Math.pow(10, v);
        return Math.round(num * vv) / vv;
    }

    function changenum(e) {
        // var goodsCnt = parseFloat($(e).val());
        // var goodsId = parseInt($(e).parent().parent().children().eq(0).children().eq(1).attr('attid'));
        // var goodsname = $(e).parent().parent().children().eq(0).text().trim().replace(/\s/g, "");
        // var depotId = parseInt($(e).parent().parent().find('.depotid').text());
        // var depotsubId = parseInt($(e).parent().parent().find('.depotsubid').text());
        // var supplierId = parseInt($(e).parent().parent().find('.supplierid').text());
        // var depotgoodsId = parseInt($(e).parent().parent().children().eq(0).attr('attid'));
        // var index = goodsname .indexOf("_");
        // var pn  = goodsname .substring(index + 1, goodsname .length);
        // if (goodsCnt > 0) {
          //  $.ajax({
          //      type: "post",
         //       url: "using_deliver_createnew.php?tab=1",
          //      data:{goodsId:goodsId,goodsCnt:goodsCnt,depotgoodsId:depotgoodsId,action:'ifnum'},
           //     async: false,
          //      dataType: "json",
          //      success: function (data) {
        //             if(data.code!=1){
        //                 Alert(data.msg);
        //             }
        //         }
        //     })
        // }
        totalcount();
    }

    function totalcount() {
        totalnum = 0;
        totalpri = 0;
        $('#tb_1 tr').each(function (i) {
            if (i > 1) {
                var oldnum = $(this).children().eq(3).children().val();
                var num = parseFloat($(this).children().eq(3).children().val());
                if ((isNaN(num) && oldnum != '') || (isNaN(num) && oldnum != 'undefined')) {
                    $(this).children().eq(3).children().val('');
                    return true;
                } else {
                    var goodsPrice = parseFloat($(this).find('.goodsPrice').text());
                    totalpri = parseFloat((num * goodsPrice)) + parseFloat(totalpri);
                    totalnum = parseFloat(num) + parseFloat(totalnum);
                }
            }
        });
        $('.totalmoney').text(parseFloat(totalpri).toFixed(2));
        $('.totalnum').text(totalnum);

    }

    function changecb(e) {
        var pritype = parseInt($(e).val());
        if(pritype==2){
            $(e).parent().parent().find('.ifdikou').val(2);
            $(e).parent().parent().find('.ifdikou').attr('disabled', "true");
        }else if(pritype==1) {
            $(e).parent().parent().find('.ifdikou').val(1);
            $(e).parent().parent().find('.ifdikou').removeAttr('disabled');
        }
        totalcount();
    }

    function changename(e) {
        var goodsId = parseInt($(e).attr('attid'));
        var oldhtml = '<i class="icon-pencil" attid="' + goodsId + '" onclick="changename(this)" title="修改商品名称"></i>'
        var gname = $(e).parent().find('.gname').text().trim().replace(/\s/g, "");
        beforgn = gname;
        $(e).parent().html('<input type="text" name="goodsId" attid="' + goodsId + '" value="' + gname + '"  class="chgname" /><img onclick="changeN(this)" class="imgDel" src="../assets/images/OK.png"><img onclick="quitchange(this)" class="imgDel" src="../assets/images/exit.png">');

    }

    function quitchangesupp() {
        $('#selectInputClone').val('');
        $('.selectssss').remove();
    }

    function changeN(e) {
        $(e).attr('disabled', "true");
        var gn = $(e).parent().find('.chgname').val().trim().replace(/\s/g, "");
        var gid = $(e).parent().find('.chgname').attr('attid');
        if(gn==beforgn){
            Alert('没有修改')
        }
        if (gid > 0) {
            $.ajax({
                type: "post",
                url: "purchase_storage_createnew.php",
                data:{goodsId:gid,goodsName:gn},
                async: false,
                dataType: "json",
                success: function (data) {
                    if (data.code == 1) {
                        $(e).removeAttr('disabled', "true");
                        $(e).parent().html('<i class="gname">' + gn + '</i><i class="icon-pencil" attid="' + gid + '" onclick="changename(this)" title="修改商品名称"></i>');
                        var index = goosNames.indexOf(beforgn);
                        if (index > -1) {
                            goosNames.splice(index, 1);
                            goosNames.push(gn);
                        }
                        $.each(selectOption_, function (n, value) {
                            if (selectOption_[n].firstChild.textContent.trim().replace(/\s/g, "") == beforgn) {
                                // console.log(selectOption_[n].firstChild.textContent.trim().replace(/\s/g, ""));
                                selectOption_[n].firstChild.textContent = gn;
                                selectOption_[n].firstChild.nodeValue = gn;
                                beforgn = '';
                                return false;
                            }
                        });
                        Alert('修改成功');
                    }
                }
            })
        } else {
            Alert('商品非法');
            return false;
        }
    }
    function quitchange(e) {
        $(e).attr('disabled', "true");
        var gid = $(e).parent().find('.chgname').attr('attid');
        $(e).parent().html('<i class="gname">' + beforgn + '</i><i class="icon-pencil" attid="' + gid + '" onclick="changename(this)" title="修改商品名称"></i>');

    }
    function savelist() {
        var trlen = $('#tb_1 tr').length;
        var posttype = 'add';
        var goodslist = new Array();
        var gpro = '';
        var gproarr = new Array();
        var toalNum =   parseFloat($('.totalnum').text()).toFixed(4);
        var totalPri =  parseFloat($('.totalmoney').text()).toFixed(4);
        var suppId = $('.selectssss').val();
        var depotId = $('#depotlist').val();
        var depotSubId = $('#depotSubId').val();
        var taxrate = parseFloat($('.selectssss').attr('taxrate'));
        var beizhu = $('.beizhu').val().trim().replace(/\s/g, "");
        $('#tb_1 tr').each(function(i) {
            if(i>1 && i<trlen-1){
                // goodslist[i]['goodsName'] = $(this).children().eq(0).text();
                gproarr['goodsName']=$(this).children().eq(0).text().trim().replace(/\s/g, "");
                gproarr['goodsId']=$(this).children().eq(0).children().eq(1).attr('attid').trim().replace(/\s/g, "");
                gproarr['goodsCnt']=$(this).children().eq(3).children().eq(0).val().trim().replace(/\s/g, "");

                gpro = 'goodsName--'+$(this).children().eq(0).text().trim().replace(/\s/g, "")+',';
                gpro += 'goodsId--'+$(this).children().eq(0).children().eq(1).attr('attid').trim().replace(/\s/g, "")+',';
                gpro += 'goodsCnt--'+$(this).children().eq(3).children().eq(0).val().trim().replace(/\s/g, "")+',';
                if(parseFloat(gproarr['goodsCnt'])>0){
                    gpro += 'usecostpri--'+$(this).children().eq(5).text().trim().replace(/\s/g, "")+',';
                    gpro += 'ratepri--'+$(this).children().eq(4).children().eq(0).val().trim().replace(/\s/g, "")+',';
                    var type = parseInt($(this).children().eq(6).children().eq(0).val());

                    if(type==1){
                        //不含税价
                        gpro += 'goodsPrice--'+$(this).children().eq(5).text().trim().replace(/\s/g, "");
                    }else if(type==2){
                        gpro += 'goodsPrice--'+$(this).children().eq(4).children().eq(0).val().trim().replace(/\s/g, "");
                    }

                    goodslist[i-1]=gpro;
                    gpro = '';
                    gproarr = new Array();
                }else{
                    goodslist = new Array();
                    Alert(gproarr['goodsName']+'数量为空,请补全');
                    return false;
                }
            }
        });
        var orderId = getQueryString("orderId");
        if(parseInt(orderId)>0){
            posttype = 'edit';
        }
        var oldGoosNamesstr = oldGoosNames.join(',');
        if(goodslist.length>0){
            $.ajax({
                type: "post",
                url: "purchase_storage_createnew.php",
                data:{action:posttype,goodslist:JSON.stringify(goodslist),suppId:suppId,depotId:depotId,depotSubId:depotSubId,toalNum:toalNum,totalPri:totalPri,taxrate:taxrate,orderId:orderId,oldGoosNamesstr:oldGoosNamesstr,beizhu:beizhu},
                async: false,
                dataType: "json",
                success: function (data) {
                  if(data.code==1){
                      Alert(data.msg);
                      window.location.href = 'purchase_storage_new.php';
                  }else{
                      Alert(data.msg);
                      return false;
                  }
                }
            })
        }
    }
    function getQueryString(name) {
        var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
        var r = window.location.search.substr(1).match(reg);
        if (r != null) {
            return unescape(r[2]);
        }
        return null;
    }
    function Alert(str) {
        var msgw,msgh,bordercolor;
        msgw=350;//提示窗口的宽度
        msgh=80;//提示窗口的高度
        titleheight=25 //提示窗口标题高度
        bordercolor="#336699";//提示窗口的边框颜色
        titlecolor="#99CCFF";//提示窗口的标题颜色
        var sWidth,sHeight;
        //获取当前窗口尺寸
        sWidth = document.body.offsetWidth;
        sHeight = document.body.offsetHeight;
//    //背景div
        var bgObj=document.createElement("div");
        bgObj.setAttribute('id','alertbgDiv');
        bgObj.style.position="absolute";
        bgObj.style.top="0";
        bgObj.style.background="#E8E8E8";
        bgObj.style.filter="progid:DXImageTransform.Microsoft.Alpha(style=3,opacity=25,finishOpacity=75";
        bgObj.style.opacity="0.6";
        bgObj.style.left="0";
        bgObj.style.width = sWidth + "px";
        bgObj.style.height = sHeight + "px";
        bgObj.style.zIndex = "10000";
        document.body.appendChild(bgObj);
        //创建提示窗口的div
        var msgObj = document.createElement("div")
        msgObj.setAttribute("id","alertmsgDiv");
        msgObj.setAttribute("align","center");
        msgObj.style.background="white";
        msgObj.style.border="1px solid " + bordercolor;
        msgObj.style.position = "absolute";
        msgObj.style.left = "50%";
        msgObj.style.font="12px/1.6em Verdana, Geneva, Arial, Helvetica, sans-serif";
        //窗口距离左侧和顶端的距离
        msgObj.style.marginLeft = "-225px";
        //窗口被卷去的高+（屏幕可用工作区高/2）-150
        msgObj.style.top = document.body.scrollTop+(window.screen.availHeight/2)-150 +"px";
        msgObj.style.width = msgw + "px";
        msgObj.style.height = msgh + "px";
        msgObj.style.textAlign = "center";
        msgObj.style.lineHeight ="25px";
        msgObj.style.zIndex = "10001";
        document.body.appendChild(msgObj);
        //提示信息标题
        var title=document.createElement("h4");
        title.setAttribute("id","alertmsgTitle");
        title.setAttribute("align","left");
        title.style.margin="0";
        title.style.padding="3px";
        title.style.background = bordercolor;
        title.style.filter="progid:DXImageTransform.Microsoft.Alpha(startX=20, startY=20, finishX=100, finishY=100,style=1,opacity=75,finishOpacity=100);";
        title.style.opacity="0.75";
        title.style.border="1px solid " + bordercolor;
        title.style.height="18px";
        title.style.font="12px Verdana, Geneva, Arial, Helvetica, sans-serif";
        title.style.color="white";
        title.innerHTML="提示信息";
        document.getElementById("alertmsgDiv").appendChild(title);
        //提示信息
        var txt = document.createElement("p");
        txt.setAttribute("id","msgTxt");
        txt.style.margin="16px 0";
        txt.innerHTML = str;
        document.getElementById("alertmsgDiv").appendChild(txt);
        //设置关闭时间
        window.setTimeout("closewin()",1000);
    }
    function closewin() {
        document.body.removeChild(document.getElementById("alertbgDiv"));
        document.getElementById("alertmsgDiv").removeChild(document.getElementById("alertmsgTitle"));
        document.body.removeChild(document.getElementById("alertmsgDiv"));
    }
    function afterChangeSupp(){
        var trlen = $('#tb_1 tr').length;
        $('#tb_1 tr').each(function(i) {
            var nowrate = parseFloat($('.selectssss').attr('taxrate'));
            if(i>1 && i<trlen-1) {
                if (parseFloat($(this).find('.ttrate').text()) != nowrate) {
                    var buhan = parseFloat($(this).find('.buhanpri').text());
                    $(this).find('.hanpri').val(parseFloat(parseFloat(buhan) * (1 + nowrate)).toFixed(2));
                    $(this).find('.ttrate').text(nowrate)
                }
            }
        });
    }

    function changedepart(e) {
        var departmentId = parseInt($(e).find("option:selected").val());
        if (departmentId > 1) {
            $.ajax({
                type: "post",
                url: "using_deliver_createnew.php?tab=1",
                data:{departmentId:departmentId},
                async: false,
                dataType: "json",
                success: function (data) {
                    var arr = Object.keys(data);
                    var trs = "";
                    $.each(data, function (n, value) {
                        if(n>0){
                            trs += '<option value="' + n + '" >' + value + '</option>';
                        }
                    });
                    $(e).parent().parent().find('.employee select').html(trs);
                }

            })
        } else {
            return false;
        }
    }
</script>

