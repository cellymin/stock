<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<style>
    table thead tr td{ text-align: center!important;vertical-align: middle!important;border-right: 1px solid #fff}
    table tbody tr td{ text-align: center!important;vertical-align: middle!important;border-right: 1px solid #eee}
    table tbody tr:last-child{ font-weight: 700;font-size: 14px;color: #000}
</style>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">

    <div style="float:left;margin-right:5px">
        <label>选择公司</label>
        <{html_options name=companyId id="companyId" class="input-xlarge" options=$company_options selected=$_GET.companyId}>
    </div>
    
    <div style="float:left;margin-right:5px">
        <label>选择分类</label>
        <select name="cateId" id="" class="input-xlarge">
            <option value="0">= 请选择 =</option>
            <{foreach from=$cates item=c}>
            <option value="<{$c.cateId}>" <{if $_GET.cateId==$c.cateId}>selected<{/if}>><{$c.cateName}></option>
            <{/foreach}>
        </select>
    </div>

    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">材料购入、领用、盘存汇总表</a>
    <div id="page-stats" class="block-body collapse in">
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <td rowspan="2" >产品名称</td>
                <td rowspan="2">计量单位</td>
                <td colspan="3">上月结存量</td>
                <td colspan="3">本月入库量</td>
                <td colspan="3">本月出库量</td>
                <td colspan="3">本月结存量</td>
            </tr>
            <tr>
                <td>数量</td>
                <td>单价</td>
                <td>金额</td>
                <td>数量</td>
                <td>单价</td>
                <td>金额</td>
                <td>数量</td>
                <td>单价</td>
                <td>金额</td>
                <td>数量</td>
                <td>单价</td>
                <td>金额</td>
            </tr>
            </thead>
            <tbody>
            <!--<{foreach from=$list.list item=v}>
                <tr>
                    <td><{$v.cateName}></td>
                    <td><{$v.unitName}></td>
                    <td><{$v.last.count}></td>
                    <td></td>
                    <td><{number_format($v.last.money,2)}></td>
                    <td><{$v.buy.count}></td>
                    <td></td>
                    <td><{number_format($v.buy.money,2)}></td>
                    <td><{$v.using.count}></td>
                    <td></td>
                    <td><{number_format($v.using.money,2)}></td>
                    <td><{$v.depot.count}></td>
                    <td></td>
                    <td><{number_format($v.depot.money,2)}></td>
                </tr>
                <{/foreach}>-->
            <{foreach name=d from=$list item=d}>
                <tr>
                    <td><{$d.goodsName}></td>
                    <td><{$d.unitName}></td>
                    <td class="num1"><{$d.pdCount.count}></td>
                    <td><{$d.pdCount.avg}></td>
                    <td class="money1"><{number_format($d.pdCount.count*$d.pdCount.avg, 2)}></td>
                    <td class="num2"><{$d.ipCount.count}></td>
                    <td><{$d.ipCount.avg}></td>
                    <td class="money2"><{number_format($d.ipCount.count*$d.ipCount.avg, 2)}></td>
                    <td class="num3"><{$d.oyCount.count}></td>
                    <td><{$d.oyCount.avg}></td>
                    <td class="money3"><{number_format($d.oyCount.count*$d.oyCount.avg, 2)}></td>
                    <td class="num4"><{$d.pdCount1.count}></td>
                    <td><{$d.pdCount1.avg}></td>
                    <td class="money4"><{number_format($d.pdCount1.count*$d.pdCount1.avg, 2)}></td>
                </tr>
            <{/foreach}>
            <tr>
                <td colspan="2">合计</td>
                <td id="num1"></td>
                <td></td>
                <td id="money1"></td>
                <td id="num2"></td>
                <td></td>
                <td id="money2"></td>
                <td id="num3"></td>
                <td></td>
                <td id="money3"></td>
                <td id="num4"></td>
                <td></td>
                <td id="money4"></td>
            </tr>
            </tbody>

        </table>
    </div>
</div>

<script type="text/javascript">
$(function(){
num(1);num(2);num(3);num(4);
money(1);money(2);money(3);money(4);
	
})

function num(i){
	var num=0;
	$('body .num'+i).each(function(){
		num += parseFloat($(this).text());		
	})
	$('#num'+i).append(num);
}
function money(i){
	var num=0;
	$('body .money'+i).each(function(){
		num += parseFloat($(this).text());		
	})
	$('#money'+i).append(num.toFixed(2));
}

</script>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>
<script>

</script>
<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>