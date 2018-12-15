<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<{* <form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
    </div>
    <div style="clear:both;"></div>
</form> *}>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">列表</a>
    <div id="page-stats" class="block-body collapse in">
        <form method="post" action="">
            <table class="table table-striped" id="data_list">
                <thead>
                <tr>
                    <th>#</th>
                    <th>发送方</th>
                    <th>消息内容</th>
                    <th>所属公司</th>
                    <th>消息时间</th>
                    <th>状态</th>
                </tr>
                </thead>
                <tbody>
                <{foreach from=$list item=v}>
                    <tr>
                        <td><input type="checkbox" data-name="messageId" value="<{$v.messageId}>"></td>
                        <td><{if $v.fromUser==0}>系统<{else}><{$v.realName}><{/if}></td>
                        <td><{$v.content}></td>
                        <td><{$v.companyName}></td>
                        <td><{$v.createTime}></td>
                        <td><{if $v.flag==0}>未处理<{elseif $v.flag==1}>已处理<{/if}></td>
                    </tr>
                    <{/foreach}>
                <tr>
                    <td>
                        <a class="btn btn-primary layerModel1 invoicebysup" action="2" title="采购清单"
                           layerUrl="purchase_list" layerW="1000px"
                           layerH="650px" layerT="2">采购清单</a>
                        <a class="btn btn-primary purchaseDone" title="处理" layerUrl="purchase_done" layerW="1000px"
                           layerH="650px" layerT="2">处理</a>
                        <a class="btn btn-primary purchaseRefuse" title="驳回" layerUrl="purcharse_refuse" layerW="1000px"
                           layerH="650px" layerT="2">驳回</a>

                    </td>
                </tr>
                </tbody>
            </table>
        </form>
        <{$page_html}>
    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>

<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>

<script>
    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return unescape(r[2]);
        return null; //返回参数值
    }

    $('.invoicebysup').click(function () {

    });

    // $('input[date-name='invoiceId'] :checkbox').each(function(){
    //         alert($(this).val());
    // });
    $(document).on('click', '.layerModel1', function () {

        var action = parseInt($(this).attr('action'));
        var checkboxs = $('#data_list input[type=checkbox]:checked');
        var value = '';
        var name = "";
        if (action == 2) {
            if (checkboxs.length == 0) {
                layer.msg('请选择操作项', {time: 1200, icon: 5});
                return false;
            }
            value = checkboxs.val();
            name = checkboxs.attr('data-name');
        }

        var url = $(this).attr('layerUrl');
        var title = $(this).attr('title');
        var width = $(this).attr('layerW');
        var height = $(this).attr('layerH');
        var type = parseInt($(this).attr('layerT'));
        var param = $(this).attr('layerD');
        if (param == undefined)
            param = '';
        $(this).attr('disabled', "true");//禁用点击
        var supplierId = getUrlParam('supplierId');//供应商id
        var payStatus = getUrlParam('payStatus');//付款状态
        var _id_arr = [];
        var invoiceStatus = getUrlParam('invoiceStatus');//收票状态

        $(this).removeAttr("disabled");//解禁按钮
        $.each($('input:checkbox:checked'), function () {
            _id_arr.push($(this).val());
        });

        value = _id_arr;
        top.layer.open({
            type: type,
            title: title,
            maxmin: false,
            shadeClose: false, //点击遮罩关闭层
            area: [width, height],
            resize: false,
            scrollbar: false,
            id: url,
            content: url + '.php?' + name + '=' + value + '&' + param,
            success: function (layero, index) {
                if ($.inArray(index, parent.myFrame) == -1) {
                    window.parent.myFrame.push(index);
                }
            },
            end: function () {
                var index = window.parent.myFrame[window.parent.myFrame.length - 1];
                window.parent.myFrame.splice($.inArray(index, window.parent.myFrame), 1);
            }
        });


    });

    $(document).on('click', '#data_list #chkAll', function () {

        var f = $(this).prop('checked');
        $(this).parents('#data_list').find('input[type=checkbox]').not('#chkAll').prop('checked', f);
    });
    var myFrame = [];
    $('.purchaseDone').click(function () {
        $(this).attr('disabled', "true");//禁用点击
        var _id_arr = [];
        $.each($('input:checkbox:checked'), function () {
            _id_arr.push($(this).val());
        });
        var value = _id_arr;
        $.ajax({
            type: "post",
            url: "purchase_list.php",
            data:{messageId:value,action:'done'},
            async: false,
            dataType: "json",
            success: function (data) {
                console.log(data);
                $(this).removeAttr("disabled");//解禁按钮
            },
            error: function (e) {
                alert("错误！！");
                $(this).removeAttr("disabled");//解禁按钮
            }
        });
    });

</script>



