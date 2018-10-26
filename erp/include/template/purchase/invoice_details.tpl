<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<{$js_confirm}>
<div class="form_div">
    <div id="order_head">
        <input type="hidden" name="orderId" value="<{$order.orderId}>">
        <input type="hidden" name="url" value="plan_order_add">
        <table class="table">
            <tr>
                <td>发票号</td>
                <td><{$invoice.invoiceNo}></td>
                <td>创建时间</td>
                <td><{$order.createTime}></td>
            </tr>
            <tr>
                <td>供应商</td>
                <td><{$order.supplierName}></td>
                <td>采购入库单号</td>
                <td><{$order.orderNo}></td>
            </tr>
            <tr>
                <td>总金额</td>
                <td><{$order.totalMoney}></td>
                <td>预计收票时间</td>
                <td><{$invoice.endTime}></td>
            </tr>
        </table>
    </div>
    <h6>入库单商品列表</h6>
    <table class="table table-striped" id="data_list">
        <thead>
        <tr>
            <th>#</th>
            <th>名称</th>
            <th>规格</th>
            <th>单位</th>
            <th>批次号</th>
            <th>供应商</th>
            <th>仓库</th>
            <th>库位</th>
            <th>数量</th>
            <th>价格</th>
            <th>部门</th>
            <th>备注</th>
        </tr>
        </thead>
        <tbody>
        <{foreach from=$order.goods.list item=v}>
            <tr data-id="<{$v.id}>" datatype="1">
                <td><input type="checkbox" name="id[]" data-name="id" value="<{$v.id}>"></td>
                <td><{$v.goodsName}></td>
                <td><{$v.goodsSpec}></td>
                <td><{$v.unitName}></td>
                <td><{$v.orderSubNo}></td>
                <td><{$v.supplierName}></td>
                <td><{$v.depotName}></td>
                <td><{$v.depotSubName}></td>
                <td><{$v.goodsCnt}></td>
                <td><{$v.goodsPrice}></td>
                <td>
                    <{if $v.remark}>
                    <a><i title="<{$v.remark}>" class="icon-comment"></i></a>
                    <{else}>
                    <a style="color: #888"><i title="<{$v.remark}>" class="icon-comment"></i></a>
                    <{/if}>
                    <input type="hidden" value="<{$v.remark}>" name="remark">
                </td>
            </tr>
            <{/foreach}>
        </tbody>
    </table>
    <{$page_html}>
</div>

