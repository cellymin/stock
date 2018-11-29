<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<style>
    table tbody tr:last-child{ font-weight: 700;font-size: 14px;color: #000}

</style>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">


    <div style="float:left;margin-right:5px">
        <label>选择公司</label>
        <{html_options name=companyId id="companyId" class="input-xlarge" options=$company_options selected=$_GET.companyId}>
    </div>
    <div style="float:left;margin-right:5px">
        <label>选择部门</label>
        <{html_options name=departmentId id="departmentId" class="input-xlarge" options=$subinfo selected=$_GET.departmentId}>
    </div>
    <div style="float:left;margin-right:5px">
        <label>日期段</label>
        <input type="text" name="startTime" class="time_input" readonly value="<{$_GET.startTime}>">
    </div>
    <div style="float:left;margin-right:5px">
        <label>至</label>
        <input type="text" name="endTime" class="time_input" readonly value="<{$_GET.endTime}>">
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">领用明细表</a>
    <div id="page-stats" class="block-body collapse in">
        <table class="table table-striped" border="1" id="data_list">
            <thead>
            <tr>
                <th>公司</th>
                <th>部门</th>
                <th>产品编码</th>
                <th>产品名称</th>
                <th>单价</th>
                <th>数量</th>
                <th>单位</th>
                <th>领用时间</th>
            </tr>
            </thead>
            <tbody>
            <{foreach from=$goods item=ee}>
                <tr>
                    <td><{$ee.companyName}></td>
                    <td><{$ee.departmentName}></td>
                    <td><{$ee.goodsBarCode}></td>
                    <td><{$ee.goodsName}></td>
                    <td class="goodspri"><{$ee.goodsPrice}></td>
                    <td class="goodscnt"><{$ee.goodsCnt}></td>
                    <td><{$ee.unitName}></td>
                    <td><{$ee.createTime}></td>
                </tr>
                <{/foreach}>
            <tr><td>合计</td>
                <td></td>
                <td></td>
                <td></td>
                <td class="totalpri">0</td>
                <td class="totalcnt">0</td>
                <td></td>
            </tr>
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
    jQuery(function($) {
        var goodspri=0,goodscnt=0;
        $('.goodspri').each(function () {
            tt = parseFloat($(this).text());
            goodspri = goodspri + tt;
        });
        $('.totalpri').text(goodspri.toFixed(4));
        $('.goodscnt').each(function () {
            tt = parseFloat($(this).text());
            goodscnt = goodscnt + tt;
        });
        $('.totalcnt').text(goodscnt.toFixed(4));
    });


</script>