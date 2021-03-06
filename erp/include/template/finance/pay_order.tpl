<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<form class="form_search" action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="4" title="新增财务" layerUrl="pay_add" layerW="850px"
           layerH="665px" layerT="2"><i class="icon-plus"></i> 财务</a>
    </div>
    <div class="btn-toolbar" style="float:right;padding-top:15px;margin-right: 10px;">
        <a class="btn btn-primary collect" action="4" title="收票" layerUrl="pay_collect" layerW="850px"
           layerH="665px" layerT="2" onclick="collectclick(this)" ><i class="icon-plus"></i> 收票</a>
    </div>
    <div style="float:left;margin-right:5px">
        <label>选择付款状态</label>
        <select name="payStatus" id="">
            <option value="0" <{if $_GET.payStatus eq 0}>selected<{/if}>>全部</option>
            <option value="1" <{if $_GET.payStatus eq 1}>selected<{/if}>>未付款</option>
            <option value="2" <{if $_GET.payStatus eq 2}>selected<{/if}>>已付款</option>
        </select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>选择供应商</label>
        <{html_options name=supplierId id="supplierId" class="input-large" options=$suppliers_options selected=$supplierId}>
    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入,单号,发票号,采购入库单号">
        <input type="hidden" name="search" value="1">
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">采购发票列表</a>
    <div id="page-stats" class="block-body collapse in">
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>单号</th>
                <th>发票号</th>
                <th>供应商</th>
                <th>公司</th>
                <th>采购入库单号</th>
                <th>金额</th>
                <th>付款状态</th>
                <th>付款状态</th>
                <th>对账状态</th>
                <th>调整金额</th>
                <th>创建时间</th>
                <th>预计收票时间</th>
            </tr>
            </thead>
            <tbody>
            <{foreach name=invoices from=$list key=index item=value}>
                <tr>
                    <td><input type="checkbox" data-name="invoiceId" value="<{$value.invoiceId}>"></td>
                    <td><{$value.invoiceNo}></td>
                    <td class="trueinvoiceno"><{$value.trueInvoiceNo}></td>
                    <td><{$value.supplierName}></td>
                    <td><{$value.companyName}></td>
                    <td><{$value.orderNo}></td>
                    <td><{$value.totalMoney}></td>
                    <td><{$value.payFlag}></td>
                    <td><{$value.invoiceFlag}></td>
                    <td><{$value.verifyFlag}></td>
                    <td><{$value.adjustamount}></td>
                    <td><{$value.createTime}></td>
                    <td><{$value.endTime}></td>
                </tr>
                <{/foreach}>
            <tr><td>
                    <!-- <a class="btn btn-primary layerModel invoicebysup" action="2" title="发票对账单" layerUrl="invoice_details" layerW="1000px"
                        layerH="650px" layerT="2">发票对账单</a>-->
                    <a class="btn btn-primary invoicebysup" action="2" title="发票对账单" layerUrl="pay_invoice" layerW="1000px"
                       layerH="650px" layerT="2">发票对账单</a>

                </td></tr>
            </tbody>
        </table>
        <{$page_html}>
    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>

<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
<script>
    function collectclick(e) {
        var _id_arr = [],invoiceno = [],inno = '';
        $.each($('input:checkbox:checked'), function () {
            _id_arr.push($(this).val());
            if($(this).parent().parent().find('.trueinvoiceno').text()!=''){
                invoiceno.push($(this).parent().parent().find('.trueinvoiceno').text());
            }
        });
        $.unique(invoiceno);
        if(invoiceno.length>1){
            alert("不能操作发票号不同的发票！")
            return false;
        }
        //多个选项
        if (_id_arr.length > 1) {
            var supplierId = getUrlParam('supplierId');//供应商id
            if (supplierId == 0 || supplierId == '' || supplierId == null) {
                $(e).removeClass("layerModel");
                alert('请选择供应商');
                $(e).removeAttr("disabled");//解禁按钮
                return false;
            }else{
                var classN = $(e).addClass("layerModel");
                $(e).click();
            }
        } else {
            var classN = $(e).addClass("layerModel");
            $(e).click();
        }
    }

    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return unescape(r[2]); return null; //返回参数值
    }
    // $('input[date-name='invoiceId'] :checkbox').each(function(){
    //         alert($(this).val());
    // });
    $(document).on('click', '.invoicebysup', function () {

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
        $(this).attr('disabled',"true");//禁用点击
        var supplierId= getUrlParam('supplierId');//供应商id
        var payStatus= getUrlParam('payStatus');//付款状态
        var _id_arr=[];
        var invoiceStatus= getUrlParam('invoiceStatus');//收票状态
        if(supplierId==0 || supplierId=='' || supplierId==null){
            alert('请选择供应商');
            $(this).removeAttr("disabled");//解禁按钮
            return false;
        }
        //if(payStatus!=2){ //不是付款状态
        //   alert('请选择已付款的');
        // $(this).removeAttr("disabled");//解禁按钮
        //  return false;
        // }

        $(this).removeAttr("disabled");//解禁按钮
        $.each($('input:checkbox:checked'),function(){
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
            scrollbar:false,
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

</script>