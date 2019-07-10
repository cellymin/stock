<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<style>
    table tbody tr:last-child{ font-weight: 700;font-size: 14px;color: #000}
    .export{display:none;}
</style>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">


    <div style="float:left;margin-right:5px">
        <label>选择公司</label>
        <{html_options name=companyId id="companyId" class="input-xlarge" options=$company_options selected=$_GET.companyId}>
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
        <a type="button" class="btn btn-primary" onclick="beforeExport(this)">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">领用汇总表</a>
    <div id="page-stats" class="block-body collapse in">
        <table class="table table-striped" border="1" id="data_list">
            <thead>
            <tr class="export">
                <th style="border-top:0 none;border-left:0 none;border-right: 0 none;border-bottom:0 none">
                    <{$content_header.menu_name}>
                </th>
                <th colspan="<{$list.list|@end|@count+1}>" style="text-align: right;border-top:0 none;border-left:0 none;border-right: 0 none;border-bottom:0 none">
                    日期段：<{$_GET.startTime}>至<{$_GET.endTime}>
                </th>
            </tr>
            <tr>
                <td>部门\项目</td>
                <{foreach from=$list.total item=t}>
                <td><{$t.cateName}></td>
                <{/foreach}>
                <td>小计</td>
            </tr>
            </thead>
            <tbody>
            <{foreach from=$list.list item=li}>
            <tr class="avghang">
                <td><{$li.departmentName}></td>
                <{foreach from=$li.goods item=g name=kg}>
                <td class="heng"><{number_format($g.money,2)}></td>
                <{if $smarty.foreach.kg.iteration==$g|@count}>
                <td class="hengtotal">0</td>
                <{/if}>
                <{/foreach}>

            </tr>
            <{/foreach}>
            <tr class="avghang">
                <td>合计</td>
                <{foreach from=$list.total item=t}>
                <td class="heng"><{number_format($t.money,2)}></td>
                <{/foreach}>
                <td class="hengtotal">0</td>
            </tr>
            </tbody>

        </table>
    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>
<script>
    $(function () {
        var kk=0;

        // $('.avghang').find('.heng').each(function (i,e) {
        //     kk = kk + parseFloat($(this).text().replace(/,/g,''));
        //     console.log(parseFloat($(this).text().replace(/,/g,'')));
        // })
        $('#data_list').find('.avghang').each(function (j,k) {
            var ll = 0
            $(this).find('.heng').each(function (i,e) {
                ll = ll + parseFloat($(this).text().replace(/,/g,''));
                kk = kk + parseFloat($(this).text().replace(/,/g,''));
                })
            $(this).find('.hengtotal').text(ll.toFixed(2));
        })
    })
    function beforeExport(e) {

        $('.export').css('display','')
        var table = $('#data_list').html();
        method5('data_list')
        $('#data_list').html(table);
        $('.export').css('display','none');
    }
</script>
<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>