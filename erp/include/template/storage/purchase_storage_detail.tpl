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
<div class="search" style="display: flex">
    <{if !empty($order)}>
<input type="hidden" class="haveorder" haveTax="<{$order.taxrate}>" haveSuppId="<{$order.supplierId}>" haveSuppName="<{$order.supplierName}>" />
    <{/if}>
    <span class="search_text">供应商</span>
    <select class="search_select" id="selectInput" name="supplierId" disabled>

        <option  ss="<{$order.supplierId}>" <{if $order.supplierId==$k}> selected <{/if}> >
            <{$order.supplierName}>
        </option>
    </select>
    <a class="layerModel choosesupps" action="1" title="选择供应商" layerUrl="<{$suppliers_url}>" layerW="600px"
       layerH="500px" layerT="2" style="display: none;"><i class="icon-plus"></i> 选择</a>
    <span class="search_text" style="margin-left: 20px;">仓库</span>
    <select class="search_select" name="depotId" onchange="liand(this)" id="depotlist" disabled>
        <{foreach from=$depots_options item=v key=k}>
    <option value="<{$k}>"   <{if $order.goods.list[0].depotId == $k }>selected <{/if}> ><{$v}></option>
        <{/foreach}>
    </select>
    <div class="depotsub">
        <span class="search_text" style="margin-left: 20px;">库位</span>
        <select class="search_select" name="depotSubId" id="depotSubId" disabled>
            <{if $order.goods.list }>
            <option value="<{$order.goods.list[0].depotSubId}>" selected><{$order.goods.list[0].depotSubName}></option>
            <{/if}>
        </select>
    </div>
</div>
<hr/>
<table class="table" border="1" id="tb_1">
    <input type="hidden" class="status" value="<{$order.flag}>"/>
    <input type="hidden" class="goodsName" value="11" name="ss"/>
    <tr>
        <th>材料名称</th>
        <th>规格</th>
        <th>单位</th>
        <th>入库数量
        <th>含税价</th>
        <th>不含税价</th>
        <th>成本价</th>
        <th>可低税率</th>
        <th>可否抵扣</th>
    </tr>
    <{foreach name=module from=$order.goods.list key=index item=value}>
    <tr>
        <td><i class="gname" style="font-style: normal"><{$value.goodsName}></i></td>
        <td><{$value.goodsSpec}></td>
        <td><{$value.unitName}></td>
        <td><{$value.goodsCnt|string_format:"%.2f"}></td>
        <td><{$value.ratepri|string_format:"%.2f"}></td>
        <td><{if $value.usecostpri >0 }><{$value.usecostpri}><{else}><{$value.goodsPrice}><{/if}></td>
        <td><{if $value.usecostpri == $value.goodsPrice || !$value.usecostpri>0}> 不含税价 <{/if}><{if $value.usecostpri != $value.goodsPrice && $value.usecostpri>0}> 含税价<{/if}></td>
        <td><input type="text" style="width:45px;" class="dikourate" value="<{if $value.taxrateself  }><{$value.taxrateself}><{else}><{$order.taxrate}><{/if}>"  onkeyup="chgbuhanpri(this)" disabled /></td>
        <td><select name="ifdikou" class="ifdikou" style="width:100px;" disabled><option value="1" <{if $value.usecostpri == $value.goodsPrice || !$value.usecostpri>0 || $value.tikmark==1}> selected="selected"<{/if}> >可抵扣</option><option value="2"<{if ($value.usecostpri != $value.goodsPrice && $value.usecostpri>0) ||  $value.tikmark==2}> selected="selected"<{/if}>>不可抵扣</option> </select></td>
        <td class="ttrate" style="display:none ;"><{$value.taxrate}></td></tr>
    </tr>
    <{/foreach}>
</table>
<div class="other">
    <div>
        <span style="font-weight: bold;border-bottom:1px solid #e2e2e2; ">其他信息</span>
        <span style="margin: 30px;">备注：<textarea style="width: 50%;height: 100px;" disabled><{$order.remark}></textarea></span>
    </div>
    <div>
        <span style="font-weight: bold;border-bottom:1px solid #e2e2e2; ">入库金额</span>
        <div style="display: flex"><span style="margin: 30px;">入库总金额：￥<em style="font-style:normal" class="totalmoney"><{$order.totalMoney|string_format:"%.2f"}></em></span> <span style="margin: 30px;">入库总数：<em
                        style="font-style:normal" class="totalnum"> <{$order.totalCnt|string_format:"%.2f"}></em></span></div>
    </div>
    <button onclick="editlist(this);" class="saveSubmit">修改</button>
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
    function editlist(e) {
        var domain = self.location.href+'&tab=1';
        $(e).attr('disabled', "true");
        var status = $('.status').val();
        if(parseInt(status)==3){
            Alert('不能修改已审核的单子');
            $(e).removeAttr('disabled');
            return false;
        }else{
            window.location.href = domain;
        }
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
</script>

