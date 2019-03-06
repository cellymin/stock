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

                          .ui-datepicker-calendar {
                              display: none;// 不显示日期面板
                          }

</style>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">

    <div style="float:left;margin-right:5px">
        <label>选择公司</label>
        <{html_options name=companyId id="companyId" class="input-xlarge" options=$company_options selected=$_GET.companyId}>
    </div>
    <div style="float:left;margin-right:5px">
        <label>仓库</label>
        <{html_options name=depotId id="depotId" class="input-xlarge" options=$depots_options selected=$_GET.depotId}>
    </div>

    <div style="float:left;margin-right:5px">
        <label>选择分类 </label>
        <select name="cateId" id="" class="input-xlarge">
            <option value="0">= 请选择 =</option>

            <{foreach from=$cates item=c}>
            <option value="<{$c.cateId}>" <{if $_GET.cateId==$c.cateId}>selected<{/if}>><{$c.cateName}></option>
            <{/foreach}>
        </select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>关键词</label>
        <input type="text" name="keyword" id="keyword" placeholder="产品条码/关键词"  value="<{$_GET.keyword}>">
    </div>
    <div style="float:left;margin-right:5px">
        <label>选择年</label>
        <select name="year" id="" class="input-xlarge" style="width: 90px;">
            <option value="0">= 请选择 =</option>
            <{foreach from=$yarr item=yy}>
            <option value="<{$yy}>" <{if $_GET.year==$yy}>selected<{else}><{if !$_GET.year && $y==$yy}>selected<{/if}><{/if}> ><{$yy}></option>
            <{/foreach}>
        </select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>选择月</label>
        <select name="month" id="" class="input-xlarge" style="width: 85px;">
            <option value="0">请选择</option>
            <option value="01" <{if $_GET.month=='01'}>selected<{else}><{if !$_GET.month && $m=='01'}>selected<{/if}><{/if}> >01</option>
            <option value="02" <{if $_GET.month=='02'}>selected<{else}><{if !$_GET.month && $m=='02'}>selected<{/if}><{/if}> >02</option>
            <option value="03" <{if $_GET.month=='03'}>selected<{else}><{if !$_GET.month && $m=='03'}>selected<{/if}><{/if}> >03</option>
            <option value="04" <{if $_GET.month=='04'}>selected<{else}><{if !$_GET.month && $m=='04'}>selected<{/if}><{/if}> >04</option>
            <option value="05" <{if $_GET.month=='05'}>selected<{else}><{if !$_GET.month && $m=='05'}>selected<{/if}><{/if}> >05</option>
            <option value="06" <{if $_GET.month=='06'}>selected<{else}><{if !$_GET.month && $m=='06'}>selected<{/if}><{/if}> >06</option>
            <option value="07" <{if $_GET.month=='07'}>selected<{else}><{if !$_GET.month && $m=='07'}>selected<{/if}><{/if}>>07</option>
            <option value="08" <{if $_GET.month=='08'}>selected<{else}><{if !$_GET.month && $m=='08'}>selected<{/if}><{/if}> >08</option>
            <option value="09" <{if $_GET.month=='09'}>selected<{else}><{if !$_GET.month && $m=='09'}>selected<{/if}><{/if}> >09</option>
            <option value="10" <{if $_GET.month=='10'}>selected<{else}><{if !$_GET.month && $m=='10'}>selected<{/if}><{/if}> >10</option>
            <option value="11" <{if $_GET.month=='11'}>selected<{else}><{if !$_GET.month && $m=='11'}>selected<{/if}><{/if}> >11</option>
            <option value="12" <{if $_GET.month=='12'}>selected<{else}><{if !$_GET.month && $m=='12'}>selected<{/if}><{/if}> >12</option>
        </select>
    </div>

    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="beforedao()">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">材料购入、领用、盘存明细表列表</a>
    <div id="page-stats" class="block-body collapse in">
        <table class="table table-striped" id="data_list">
            <thead>
            <tr border="0" style="display: none">
                <td colspan="16">库存结转库存表</td>
            </tr>
            <tr border="0" style="display: none">
                <td colspan="3"><{$companyName}></td>
                <td colspan="6"><{$nowdate}></td>
                <td colspan="7"> 导出人 ：<{$userName}></td>
            </tr>
            <tr>
                <td rowspan="2">产品编码</td>
                <td rowspan="2" >产品名称</td>
                <td rowspan="2">计量单位</td>
                <td colspan="3">上月结存</td>
                <td colspan="3">本月入库</td>
                <td colspan="3">本月出库</td>
                <{if $_GET.depotId>0}>
                <td colspan="3">本月调拨入库</td>
                <td colspan="3">本月调拨出库</td>
                <{/if}>
                <td colspan="3">本月结存</td>
                <td rowspan="2">本月调整金额</td>
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
                <{if $_GET.depotId>0}>
                <td>数量</td>
                <td>单价</td>
                <td>金额</td>
                <td>数量</td>
                <td>单价</td>
                <td>金额</td>
                <{/if}>
                <td>数量</td>
                <td>单价</td>
                <td>金额</td>
            </tr>
            </thead>
            <tbody>
            <{foreach from=$list.list item=v}>
            <tr>
                <td><{$v.goodsSn}></td>
                <td><{$v.goodsName}></td>
                <td><{$v.unitName}></td>
                <td><{$v.last.count}></td>
                <td></td>
                <td> <{if $v.last.count>0}><{number_format($v.last.money,2)}> <{else}> 0 <{/if}> </td>
                <td><{$v.buy.count}></td>
                <td></td>
                <td><{number_format($v.buy.money,2)}></td>
                <td><{$v.using.count}></td>
                <td></td>
                <td><{number_format($v.using.money,2)}></td>
                <{if $_GET.depotId>0}>
                <td><{$v.transin.count}></td>
                <td></td>
                <td><{number_format($v.transin.money,2)}></td>
                <td><{$v.transout.count}></td>
                <td></td>
                <td><{number_format($v.transout.money,2)}></td>
                <{/if}>
                <td><{$v.depot.count}></td>
                <td></td>
                <td><{number_format($v.depot.money,2)}></td>
                <td></td>
            </tr>
            <{/foreach}>
            <tr>
                <td>合计</td>
                <td></td>
                <td></td>
                <td><{$list.total.last.count}></td>
                <td></td>
                <td><{number_format($list.total.last.money,2)}></td>
                <td><{$list.total.buy.count}></td>
                <td></td>
                <td><{number_format($list.total.buy.money,2)}></td>
                <td><{$list.total.using.count}></td>
                <td></td>
                <td><{number_format($list.total.using.money,2)}></td>
                <{if $_GET.depotId>0}>
                <td><{$list.total.transin.count}></td>
                <td></td>
                <td><{number_format($list.total.transin.money,2)}></td>
                <td><{$list.total.transout.count}></td>
                <td></td>
                <td><{number_format($list.total.transout.money,2)}></td>
                <{/if}>
                <td><{$list.total.depot.count}></td>
                <td></td>
                <td><{number_format($list.total.depot.money,2)}></td>
                <td><{$list.adjpri}></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>
<script>
    function beforedao(){
        $('#data_list').children().children().eq(0).css('display','');
        $('#data_list').children().children().eq(1).css('display','');
        method5('data_list')
        $('#data_list').children().children().eq(0).css('display','none');
        $('#data_list').children().children().eq(1).css('display','none');
    }

</script>
<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>