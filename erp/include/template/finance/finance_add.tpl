<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form id="" method="post" action="" enctype="multipart/form-data">
        <table width="100%" class="table">
            <tr>
                <td width="150" colspan="1">类型</td>
                <td colspan="3">
                    <select name="type" id="">
                        <option value="1">收入</option>
                        <option value="2">支出</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="150" colspan="1">发票类型</td>
                <td colspan="3">
                    <select name="cate" id="" >
                        <option value="">请选择</option>
                        <option value="1">水费</option>
                        <option value="2">电费</option>
                        <option value="3">物流</option>
                        <option value="4">工资</option>
                        <option value="5">餐饮</option>
                        <option value="6">配送</option>
                        <option value="7">社保</option>
                        <option value="10">固定资产</option>
                        <option value="0">其他</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="1">合计金额</td>
                <td colspan="3">
                    <input type="text" name="money">
                </td>
            </tr>
            <tr>
                <td colspan="1">备注</td>
                <td colspan="3">
                    <textarea name="remark" id="" cols="50" style="width: 400px;resize: none" rows="5"></textarea>
                </td>
            </tr>
            <tr>
                <td><input type="hidden" value="<{$invoiceId}>" name="invoiceId">
                </td>
                <td>
                    <input type="hidden" name="nonceStr" value="<{$nonceStr}>">
                    <button class="btn btn-primary" type="submit">提交</button>
                </td>
            </tr>
        </table>
    </form>
</div>
<script>


</script>

