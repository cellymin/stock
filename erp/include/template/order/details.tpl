<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<{$js_confirm}>
<div class="form_div">
    <div style="overflow: hidden" class="avoid-this">
        <button id="orderPrint" class="btn btn-primary" style="float: left;margin-bottom: 20px;" > 打印</button>
        <a type="button" class="btn btn-primary" onclick="method5('oorder')" style="margin-left: 10px;">导出</a>
        <{if ($order.flag==0 || $order.flag==-3)}>
            <button type="submit" class="btn btn-primary layerModel" style="float: right;margin-bottom: 20px;" action="1" title="提交审核"
                    layerUrl="<{$toReview}>" layerW="360px" layerH="200px" layerT="2"
                    layerD="type=<{$type}>&orderId=<{$order.orderId}>"> 提交审核
            </button>
        <{/if}>
        <{if ($order.flag==1 && $userId==$order.reviewer)}>
            <button type="submit" class="btn btn-primary layerModel" style="float: right;margin-bottom: 20px;" action="1" title="审核"
                    layerUrl="<{$review}>" <{if $type=='PURCHASE_IN'}>layerW="400px" layerH="460px"<{else}>layerW="350px" layerH="300px"<{/if}> layerT="2"
                    layerD="type=<{$type}>&orderId=<{$order.orderId}>"> 审核
            </button>
        <{/if}>
        <{if in_array($order.flag,array(0,1,-3)) && !in_array($type,array('OTHER_IN','OTHER_OUT'))}>
            <button type="submit" class="btn btn-primary layerModel"
                    style="float: right;margin-bottom: 20px;margin-right: 15px;" action="1" title="商品"
                    layerUrl="goods_search" layerW="850px" layerH="500px" layerT="2"
                    layerD="type=<{$type}>&orderId=<{$order.orderId}><{if ($type=='ALLOT_OUT' || $type=='USE_OUT')}>&depotId=<{$order.depotId}><{/if}>"><i class="icon-search"></i> 产品
            </button>
            <button type="submit" class="btn btn-primary layerModel"
                    style="float: right;margin-bottom: 20px;margin-right: 15px;" action="2" title="订单产品"
                    layerUrl="<{$modify_url}>" layerW="450px" layerH="550px" layerT="2"
                    layerD="type=<{$type}>&orderId=<{$order.orderId}>"><i class="icon-pencil"></i> 修改
            </button>
            <button type="submit" class="btn btn-primary layerModel" action="3" title="删除商品"
                    style="float: right;margin-bottom: 20px;margin-right: 15px;">
                <i class="icon-trash"></i> 删除
            </button>
        <{/if}>
    </div>
    <div id="oorder">
        <div id="order_head">
            <input type="hidden" name="orderId" value="<{$order.orderId}>">
            <input type="hidden" name="url" value="plan_order_add">
            <table class="table">
                <tr>
                    <td>订单编号</td>
                    <td><{$order.orderNo}></td>
                    <td>创建时间</td>
                    <td><{$order.createTime}></td>
                </tr>
                <tr>
                    <td>操作员</td>
                    <td><{$order.user_name}></td>
                    <td>状态</td>
                    <td><{$order.status}></td>
                </tr>
                <tr>
                    <td>总金额</td>
                    <td><{$order.totalMoney}></td>
                    <td>总数量</td>
                    <td><{$order.totalCnt}></td>
                </tr>
                <tr>
                    <{if in_array($type,array('PLAN','ARRIVAL','RETURN','PURCHASE_IN'))}>
                    <td>供应商</td>
                    <td><{$order.supplierName}></td>
                    <{elseif in_array($type,array('ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY','OTHER_IN','OTHER_OUT'))}>
                    <td>仓库</td>
                    <td><{$order.depotName}></td>
                    <{else}>
                    <td>客户</td>
                    <td><{$order.customerName}></td>
                    <{/if}>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>备注</td>
                    <td>
                        <{$order.remark}>
                    </td>
                </tr>
            </table>
        </div>
        <div class="m-demo">
            <table>
                <thead>
                <tr>
                    <th class="td40 avoid-this">#</th>
                    <th class="td120">名称</th>
                    <{if !in_array($type,array('ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT','SALE_OUT'))}>
                    <th class="td80">规格</th>
                    <th class="td80">单位</th>
                    <{else}>
                    <th class="td150">批次号</th>
                    <{/if}>
                    <{if !in_array($type,array('ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT','SALE_OUT'))}>
                    <th class="td120">供应商</th>
                    <{/if}>
                    <{if $type=='PURCHASE_IN' || $type=='SALE_OUT'}>
                    <th class="td100">仓库</th>
                    <{/if}>
                    <{if !in_array($type,array('PLAN','ARRIVAL','RETURN'))}>
                    <th class="td100">库位</th>
                    <{/if}>
                    <{if $type=='INVENTORY'}>
                    <th class="td80">盘点数量</th>
                    <{else}>
                    <th class="td80">数量</th>
                    <{/if}>
                    <{if $type=='INVENTORY'}>
                    <th class="td80">库存数量</th>
                    <{/if}>
                    <th class="td90">价格</th>
                    <{if in_array($type,array('ALLOT_OUT','USE_OUT'))}>
                    <th class="td85">部门</th>
                    <th class="td85">领用人</th>
                    <{/if}>
                    <{if $type=='PLAN'}>
                    <th class="td100">计划到货日期</th>
                    <{/if}>
                    <th class="avoid-this">备注</th>
                </tr>
                </thead>
            </table>
            <div class="scroll">
                <form method="post" action="<{$delete_url}>.php">
                    <input type="hidden" name="orderId" value="<{$order.orderId}>">
                    <input type="hidden" name="type" value="<{$type}>">
                    <table class="" id="data_list">
                        <tbody>
                        <tr>
                            <td style="padding: 0;margin: 0">
                                <{foreach from=$order.goods.list key=index item=v}>
                                <table cellspacing="0" cellpadding="0" class="table" style="margin:0;border-top:none;border-left:none;border-right:none;">
                                    <tbody>
                                    <tr data-id="<{$v.id}>" datatype="1">
                                        <td class="td40 avoid-this"><input type="checkbox" name="id[]" data-name="id" value="<{$v.id}>"></td>
                                        <td class="td120"><{$v.goodsName}></td>
                                        <{if !in_array($type,array('ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT','SALE_OUT'))}>
                                        <td class="td80"><{$v.goodsSpec}></td>
                                        <td class="td80"><{$v.unitName}></td>
                                        <{else}>
                                        <td class="td150"><{$v.orderSubNo}></td>
                                        <{/if}>
                                        <{if !in_array($type,array('ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT','SALE_OUT'))}>
                                        <td class="td120"><{$v.supplierName}></td>
                                        <{/if}>
                                        <{if $type=='PURCHASE_IN' || $type=='SALE_OUT'}>
                                        <td class="td100"><{$v.depotName}></td>
                                        <{/if}>
                                        <{if !in_array($type,array('PLAN','ARRIVAL','RETURN'))}>
                                        <td class="td100"><{$v.depotSubName}></td>
                                        <{/if}>
                                        <td class="td80"><{$v.goodsCnt}></td>
                                        <{if $type=='INVENTORY'}>
                                        <td class="td80"><{$v.depotGoodsCnt}></td>
                                        <{/if}>
                                        <td class="td90"><{$v.goodsPrice}></td>
                                        <{if in_array($type,array('ALLOT_OUT','USE_OUT'))}>
                                        <td class="td85"><{$v.departmentName}></td>
                                        <td class="td85"><{$v.employeeName}></td>
                                        <{/if}>
                                        <{if $type=='PLAN'}>
                                        <td class="td100"><{date('Y-m-d',strtotime($v.arrivalTime))}></td>
                                        <{/if}>
                                        <td class="avoid-this">
                                            <{if $v.remark}>
                                            <a><i title="<{$v.remark}>" class="icon-comment"></i></a>
                                            <{else}>
                                            <a style="color: #888"><i title="<{$v.remark}>" class="icon-comment"></i></a>
                                            <{/if}>
                                            <input type="hidden" value="<{$v.remark}>" name="remark">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <{if (($index+1)%23)==0}>
                                <div style="page-break-after:always;"></div>
                                <table class="pageHead" style="display: none;border: none">
                                    <thead>
                                    <tr>
                                        <th class="td40 avoid-this">#</th>
                                        <th class="td120">名称</th>
                                        <{if !in_array($type,array('ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT'))}>
                                        <th class="td80">规格</th>
                                        <th class="td80">单位</th>
                                        <{else}>
                                        <th class="td150">批次号</th>
                                        <{/if}>
                                        <{if !in_array($type,array('ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT'))}>
                                        <th class="td120">供应商</th>
                                        <{/if}>
                                        <{if $type=='PURCHASE_IN'}>
                                        <th class="td100">仓库</th>
                                        <{/if}>
                                        <{if !in_array($type,array('PLAN','ARRIVAL','RETURN'))}>
                                        <th class="td100">库位</th>
                                        <{/if}>
                                        <{if $type=='INVENTORY'}>
                                        <th class="td80">盘点数量</th>
                                        <{else}>
                                        <th class="td80">数量</th>
                                        <{/if}>
                                        <{if $type=='INVENTORY'}>
                                        <th class="td80">库存数量</th>
                                        <{/if}>
                                        <th class="td90">价格</th>
                                        <{if in_array($type,array('ALLOT_OUT','USE_OUT'))}>
                                        <th class="td85">部门</th>
                                        <th class="td85">领用人</th>
                                        <{/if}>
                                        <{if $type=='PLAN'}>
                                        <th class="td100">计划到货日期</th>
                                        <{/if}>
                                        <th class="avoid-this">备注</th>
                                    </tr>
                                    </thead>
                                </table>
                                <{/if}>
                                <{/foreach}>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <{$page_html}>
        </div>
    </div>


</div>
<script>
    jQuery(function($) { 'use strict';
        $("#orderPrint").on('click', function() {
            $('.pageHead').show();
            $(".form_div").print({
                //是否包含父文档的样式，默认为true
                globalStyles : true,
                //是否包含media='print'的链接标签。会被globalStyles选项覆盖，默认为false
                mediaPrint : false,
                //外部样式
                stylesheet : '<{$smarty.const.ADMIN_URL}>/assets/css/print.css',
                //Print in a hidden iframe
                iframe : false,
                //不想打印的元素的jQuery选择器
                noPrintSelector : ".avoid-this",
                //Add this at top
                prepend : 'Hello World',
                //将内容添加到打印内容的后面
                append : '11111',
                //回调方法
                deferred: $.Deferred().done(function() {
                    console.log('Printing done', arguments);
                    $('.pageHead').hide();
                })
            });
        });
        // Fork https://github.com/sathvikp/jQuery.print for the full list of options
    });
</script>

