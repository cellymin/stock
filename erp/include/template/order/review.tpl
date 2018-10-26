<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<form action="<{$url}>" method="post" style="margin-top: 15px;">
    <input type="hidden" name="orderId" value="<{$orderId}>">
    <input type="hidden" name="type" value="<{$type}>">
    <input type="hidden" name="nonceStr" value="<{$nonceStr}>">
    <table>
        <tr>
            <td width="180px">审核</td>
            <td>
                <select name="result" id="">
                    <option value="pass">通过</option>
                    <option value="nopass">不通过</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>备注：</td>
            <td>
                <textarea name="memo" id="" cols="20" rows="5" style="resize: none"></textarea>
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
