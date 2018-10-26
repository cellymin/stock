<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form action="<{$url}>" method="post">
        <input type="hidden" name="orderId" value="<{$orderId}>">
        <input type="hidden" name="type" value="<{$type}>">
        <input type="hidden" name="nonceStr" value="<{$nonceStr}>">
        <table>
            <tr>
                <td>审核人</td>
                <td>
                    <{html_options name=reviewer id="DropDownTimezone"  options=$reviewer_options selected=0}>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: right;padding-top: 20px;">
                    <button class="btn btn-primary">提交</button>
                </td>
            </tr>
        </table>
    </form>
</div>

