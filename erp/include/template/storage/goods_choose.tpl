<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form class="form_search" action="" method="GET" style="margin-bottom:0px;float: left;">
        <div style="float:left;margin-right:5px">
            <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入货号,助记词,产品名称"
                   style="width: 160px;">
        </div>
        <div style="float:left;margin-right:5px">
            <select name="goodsCateId" id="" style="width: 130px">
                <{foreach from=$goodsCate item=v}>
            <option value="<{$v.cateId}>" <{if $_GET.goodsCateId==$v.cateId}>selected<{/if}>>
                <{if $v.level>1}>
                |<{str_repeat('-',$v.level)}>&nbsp;<{$v.cateName}>
                <{else}>
                <{$v.cateName}>
                <{/if}>
                </option>
                <{/foreach}>
            </select>
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
                <th>商品名称</th>
                <th>规格</th>
                <th>单位</th>
                <th>上次进价</th>
                <th>最低进价</th>
                <th>最高进价</th>
                <th>平均进价</th>
            </tr>
            </thead>
            <tbody>
            <{foreach name=module from=$list key=index item=value}>
                <tr>
                    <td><input data-name="goodsId" type="checkbox" value="<{$value.goodsId}>" onclick="ifexist(this)">
                    </td>
                    <td class="goodsName"><{$value.goodsName}></td>
                    <td class="goodsSpec"><{$value.goodsSpec}></td>
                    <td class="unitName"><{$value.unitName}></td>
                    <td class="lastPrice"><{$value.lastPrice}></td>
                    <td class="minPrice"><{$value.minPrice}></td>
                    <td class="maxPrice"><{$value.maxPrice}></td>
                    <td class="avgPrice"><{$value.avgPrice}></td>
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
                    console.log(idname);
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
            var goodsSpec = $(this).parent().parent().find('.goodsSpec').text();
            var unitName = $(this).parent().parent().find('.unitName').text();
            var lastPrice = $(this).parent().parent().find('.lastPrice').text();
            var hanpri = parseFloat(lastPrice) * (1 + taxrate);
            $(this).attr('checked', false);
            trs += '<tr><td><i class="gname">' + goodsName + '</i><i class="icon-pencil" attid="'+goodsId+ '" onclick="changename(this)" title="修改商品名称"></i></td><td>' + goodsSpec + '</td><td>' + unitName + '</td><td><input type="text" value="" style="width:45px;" onkeyup="changenum()"></td><td><input type="text" style="width:45px;" class="hanpri" value=" ' + hanpri.toFixed(2) + '" onkeyup="ratejisuan(this)" /></td><td class="buhanpri">' + parseFloat(lastPrice).toFixed(6) + '</td><td  class="pritype"><select name="costprice"><option value="1" selected="selected">不含税价</option><option value="2">含税价</option> </select></td><td onclick="delgoods(this)"><img class="imgDel" src="../assets/images/trash.png"></td></tr>'
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
