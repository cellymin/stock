<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form id="" method="post" action="">
        <table width="100%" class="table">
            <{if $finance.cate==8 || $finance.cate==9}>
            <tr>
                <td width="150" colspan="1">发票对象</td>
                <td colspan="3">
                    <{if $finance.cate==8}>
                    <{$finance.supplierName}>
                    <{else}>
                    <{$finance.customerName}>
                    <{/if}>
                </td>
            </tr>
            <tr>
                <td colspan="1"><{if $finance.cate==8}>采购发票<{else}>销售发票<{/if}></td>
                <td colspan="3">
                    <{foreach from=$finance.invoices item=i}>
                    <{$i.invoiceNo}> <a>#</a>
                    <{/foreach}>
                </td>
            </tr>
            <{/if}>
            <tr>
                <td colspan="1">合计金额</td>
                <td colspan="3"><a style="color: red;font-size: 14px;">&yen; <b><{sprintf('%.2f',$finance.invoicesTotalMoney)}></b></a></td>
            </tr>
            <tr>
                <td>发票类型</td>
                <td>
                    <{$finance.cateDesc}>
                </td>
            </tr>
            <tr>
                <td>类型</td>
                <td>收入</td>
            </tr>
            <tr>
                <td colspan="1">备注</td>
                <td colspan="3">
                    <{$finance.remark}>
                </td>
            </tr>
        </table>
    </form>
</div>
<script>

</script>

