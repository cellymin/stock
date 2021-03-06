<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<form class="form_search" action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <{if ($type=='SALE_OUT' ||$type=='ARRIVAL' || $type=='PURCHASE_IN' || $type=='USE_OUT')}>
        <a class="btn btn-primary layerModel" action="5" title="生成退货单"></i> 生成退货单</a>
        <{/if}>
        <{if ($type!='OTHER_IN' && $type!='OTHER_OUT' && $type!='PURCHASE_RETURN' && $type!='USE_RETURN')}>
        <a class="btn btn-primary layerModel" action="1" title="新增订单" layerUrl="<{$create_url}>" layerW="500px"
           layerH="400px" layerT="2"><i class="icon-plus"></i> 新增</a>
        <{/if}>
        <a class="btn btn-primary layerModel" action="2" title="订单详情" layerUrl="<{$details_url}>" layerW="1100px"
           layerH="660px" layerT="2"><i class="icon-pencil"></i> 修改</a>
        <{if ($type!='OTHER_IN' && $type!='OTHER_OUT')}>
        <a class="btn btn-primary layerModel" action="3" title="订单删除"><i class="icon-trash"></i> 删除</a>
        <{/if}>
    </div>

    <div style="float:left;margin-right:5px">
        <label>选择状态</label>
        <select name="status" id="">
            <option value="0"<{if $_GET.status eq 0}>selected<{/if}>>全部</option>
            <{if ($type!='OTHER_IN' && $type!='OTHER_OUT')}>
            <option value="1"<{if $_GET.status eq 1}>selected<{/if}>>未提交</option>
            <{/if}>
            <option value="2"<{if $_GET.status eq 2}>selected<{/if}>>待审核</option>
            <option value="3"<{if $_GET.status eq 3}>selected<{/if}>>审核未通过</option>
            <option value="4"<{if $_GET.status eq 4}>selected<{/if}>>审核通过</option>
        </select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入单号">
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse"><{$content_header.menu_name}>列表</a>
    <div id="page-stats" class="block-body collapse in">
        <form action="<{$delete_url}>.php" method="post">
            <input id="type" type="hidden" name="type" value="<{$type}>">
            <table class="table table-striped" id="data_list">
                <thead>
                <tr>
                    <th><input type="checkbox" id="chkAll"></th>
                    <th>单号</th>
                    <{if in_array($type,array('PLAN','ARRIVAL','RETURN','PURCHASE_IN'))}>
                    <th>供应商</th>
                    <{elseif in_array($type,array('ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY','OTHER_IN','OTHER_OUT','USE_RETURN'))}>
                    <th>仓库</th>
                    <{else}>
                    <th>客户</th>
                    <{/if}>
                    <th>操作人员</th>
                    <th>创建时间</th>
                    <th>备注</th>
                    <th>总额</th>
                    <th>产品总数</th>
                    <{if in_array($type,array('RETURN','SALE_RETURN','USE_RETURN','PURCHASE_RETURN'))}>
                    <th>原始订单</th>
                    <{/if}>
                    <th>状态</th>
                    <th>审核备注</th>
                </tr>
                </thead>
                <tbody>
                <{foreach name=module from=$list key=index item=value}>
                    <tr>
                        <td><input data-name="orderId" name="orderId[]" value="<{$value.orderId}>" type="checkbox"></td>
                        <td><{$value.orderNo}></td>
                        <{if in_array($type,array('PLAN','ARRIVAL','RETURN','PURCHASE_IN'))}>
                        <td><{$value.supplierName}></td>
                        <{elseif in_array($type,array('ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY','OTHER_IN','OTHER_OUT','USE_RETURN'))}>
                        <td><{$value.depotName}></td>
                        <{else}>
                        <td><{$value.customerName}></td>
                        <{/if}>
                        <td><{$value.user_name}></td>
                        <td><{$value.createTime}></td>
                        <td><{$value.remark}></td>
                        <td><{$value.totalMoney}></td>
                        <td><{$value.totalCnt}></td>
                        <{if in_array($type,array('RETURN','SALE_RETURN','USE_RETURN','PURCHASE_RETURN'))}>
                        <td><{$value.contactNo}></td>
                        <{/if}>
                        <td><{$value.status}></td>
                        <td><{$value.reviewerMemo}></td>
                    </tr>
                    <{/foreach}>
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
    $(document).on('click', '.layerModel', function () {
        var type= $("input[name='type']").val();
        var action = parseInt($(this).attr('action'));
        var checkboxs = $('#data_list input[type=checkbox]:checked');
        var value = '';
        var name = "";
        if (action == 2) {
            if (checkboxs.length == 0) {
                layer.msg('请选择操作项', {time: 1200, icon: 5});
                return false;
            }
            if (checkboxs.length > 1) {
                layer.msg('禁止多选', {time: 1500, icon: 2});
                return false;
            }
            value = checkboxs.val();
            name = checkboxs.attr('data-name');
        }
        if (action == 3) {
            if (checkboxs.length == 0) {
                layer.msg('请选择操作项', {time: 1500, icon: 5});
                return false;
            }
        }
        if(action==4){
            $.each(checkboxs,function (i,v) {
                name = $(v).attr('data-name');
                value = value+','+$(v).val();
            });
        }
        if (action == 5) {
            if (checkboxs.length == 0) {
                layer.msg('请选择操作项', {time: 1500, icon: 5});
                return false;
            }
            if (checkboxs.length > 1) {
                layer.msg('禁止多选', {time: 1500, icon: 2});
                return false;
            }
            if(type=='ARRIVAL'){
                $("#data_list").parent().attr('action','arrival_order_change.php');
            }else if(type=='SALE_OUT'){
                $("#data_list").parent().attr('action','change.php');

            }else if(type == 'USE_OUT'){
                $("#data_list").parent().attr('action','using_return.php');
            }

            $("#data_list").parent().submit();
            return true;
        }
        if (action != 3) {
            var url = $(this).attr('layerUrl');
            var title = $(this).attr('title');
            var width = $(this).attr('layerW');
            var height = $(this).attr('layerH');
            var type = parseInt($(this).attr('layerT'));
            var param = $(this).attr('layerD');

            if (param == undefined)
                param = '';

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
        } else {
            /* 询问框*/
            layer.confirm('确认此操作？', {
                btn: ['是', '否'] //按钮
            }, function () {
                $("#data_list").parent().submit();
            });

        }

    });

</script>