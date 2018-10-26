<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form action="<{$form_url}>" method="post">
        <table>
            <tr>
                <{if $type==1}>
                <td width="40%" >供应商</td>
                <td><{html_options name=supplierId id="DropDownTimezone" options=$suppliers_options selected=0}></td>
                <{elseif $type==2}>
                <td width="40%" >仓库</td>
                <td><{html_options name=depotId id="DropDownTimezone" options=$depots_options selected=0}></td>
                <{else}>
                <td width="40%" >客户</td>
                <td><{html_options name=customerId id="DropDownTimezone" options=$customer_options selected=0}></td>
                <{/if}>
            </tr>
            <{if $type==3}>
            <tr>
                <td>预计发货时间</td>
                <td><input type="text" name="deliverTime" class="time_input" readonly></td>
            </tr>
            <{/if}>
            <tr>
                <td>备注</td>
                <td>
                    <textarea name="remark" id="" cols="30" rows="5"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="nonceStr" value="<{$nonceStr}>">
                </td>
                <td>
                    <button type="submit" class="btn btn-primary" style="margin-top: 30px;float: right">创建</button>
                </td>
            </tr>
        </table>
    </form>
</div>

