<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form class="form_search" action="" method="GET" style="margin-bottom:0px;float: left;">

        <div style="float:left;margin-right:5px">
            <select name="depotId" id="" style="width: 130px">
                <{foreach from=$depots_options item=v  key=k}>
            <option value="<{$k}>" <{if $_GET.depotId==$k}> selected <{/if}> ><{$v}>
                </option>
                <{/foreach}>
            </select>
        </div>
        <div style="float:left;margin-right:5px">
            <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入货号,助记词,产品名称"
                   style="width: 160px;">
        </div>
        <div class="btn-toolbar" style="padding-bottom:0px;margin-top:0px;margin-bottom:0px;float: left">
            <button type="submit" class="btn btn-primary"><i class="icon-search"></i></button>
        </div>
        <div style="clear:both;"></div>
    </form>
    <div class="btn-toolbar" style="padding-bottom:0px;margin-top:0px;margin-bottom:0px;float: right">
        <button class="btn btn-primary" onclick="choosesupplier()">选择</button>
    </div>
    <div>

        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>名称_批次号</th>
                <th>仓库</th>
                <th>库位</th>
                <th>数量</th>
                <th>入库时间</th>
            </tr>
            </thead>
            <tbody>
            <{foreach name=module from=$list key=index item=value}>
                <tr>
                    <td><input data-name="goodsId" type="checkbox" value="<{$value.goodsId}>" onclick="ifexist(this)">
                    </td>
                    <td class="goodsName"><{$value.goodsName}>_<{$value.batchNo}></td>
                    <td class="depotId" depotId="<{$value.depotId}>"><{$value.depotName}></td>
                    <td class="depotSubId" depotSubId="<{$value.depotSubId}>"><{$value.depotSubName}></td>
                    <td class="goodsCnt"><{$value.goodsCnt}></td>
                    <td class="createTime"><{$value.createTime}></td>
                    <td class="supplierId" style="display: none;"><{$value.supplierId}></td>
                    <td class="goodsPrice" style="display: none;"><{$value.goodsPrice}></td>
                    <td class="depotgoodsId" style="display: none;"><{$value.id}></td>
                </tr>
                <{/foreach}>
            </tbody>
        </table>
        <{$page_html}>
    </div>
</div>
<script>
    var goodsname = new Array();

    function ifexist(e) {
        var clickname = $(e).parent().next().text();
        if (goodsname.length == 0) {
            parent.$('#tb_1 tr').each(function (i) {

                if (i > 0) {
                    var idname = $(this).children().eq(0).children().eq(0).attr('id');
                    if(idname=='selectInputGClone'){
                        return true;
                    }else{
                        var gname = $(this).children().eq(0).text().trim().replace(/\s/g, "");
                        if (gname != '' && gname != '选择') {
                            goodsname.push(gname)
                        }
                    }
                }
            })
        }
        var k = goodsname.indexOf(clickname);
        if (k >= 0 && $(e).attr('checked') == 'checked') {
            $(e).attr('checked', false);
            Alert('商品重复');
            return false;
        } else {
            if ($(e).attr('checked') == 'checked') {
                goodsname.push(clickname);
            }
            else {
                var index = goodsname.indexOf(clickname);
                if (index > -1) {
                    goodsname.splice(index, 1);
                }
            }
        }
    }

    function choosesupplier() {
        var index = parent.layer.getFrameIndex(window.name);
        trs = '';
        var taxrate = parseFloat(parent.$('.selectssss').attr('taxrate'));

        if (1 < taxrate || taxrate <= 0) {
            Alert('税率不合法')
            return false;
        }
        $('input:checkbox:checked').each(function (i) {

            var goodsId = $(this).val();
            var goodsName = $(this).parent().parent().find('.goodsName').text();
            var goodsPrice = $(this).parent().parent().find('.goodsPrice').text();
            var depotname = $(this).parent().parent().find('.depotId').text();
            var depotsubname = $(this).parent().parent().find('.depotSubId').text();
            var createtime = $(this).parent().parent().find('.createTime').text().substring(0,10);
            var depotid = parseInt($(this).parent().parent().find('.depotid').attr('depotid'));
            var depotSubId = parseInt($(this).parent().parent().find('.depotSubId').attr('depotSubId'));
            var supplierId = parseInt($(this).parent().parent().find('.supplierId').text());
            var depotgoodsId = parseInt($(this).parent().parent().find('.depotgoodsId').text());
            var departeslect = parent.$('#departlist').html();

            $(this).attr('checked', false);
            trs += '<tr><td attid="'+ depotgoodsId +'"><i style="font-style: normal;" class="gname">' + goodsName + '</i><i  attid="'+goodsId+ '" title="修改商品名称"></i></td><td>' + depotname + '</td><td>' + depotsubname + '</td><td><input type="text" value="" style="width:45px;" onkeyup="changenum()"></td><td>'+createtime+'</td><td class="depart"><select name="bumen" onchange="changedepart(this)" style="width:100px;">'+departeslect+' </select></td><td class="employee"><select name="employeeId" style="width:100px;"> </select></td><td onclick="delgoods(this)"><img class="imgDel" src="../assets/images/trash.png"></td><td class="depotid" style="display:none ;">'+ depotid +'</td><td class="depotsubid" style="display:none ;">'+ depotSubId +'</td><td class="supplierid" style="display:none ;">'+ supplierId +'</td><td class="goodsPrice" style="display:none ;">'+ goodsPrice +'</td></tr>'
        });
        parent.$('#tb_1').children().children().eq(-2).after(trs);
        parent.$('.goodsName').val(goodsname);

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
        window.setTimeout("closewin()",500);
    }
    function closewin() {
        document.body.removeChild(document.getElementById("alertbgDiv"));
        document.getElementById("alertmsgDiv").removeChild(document.getElementById("alertmsgTitle"));
        document.body.removeChild(document.getElementById("alertmsgDiv"));
    }

</script>
