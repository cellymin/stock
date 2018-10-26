<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->


<div class="form_div">
    <form id="" method="post" action="">
        <table width="100%">
            <tr>
                <td><b>供应商名称</b></td>
                <td>
                    <input type="text" disabled name="supplierName" value="<{$supplier.supplierName}>"  required="true"  autofocus="true">
                </td>
                <td><b>供应商地址</b></td>
                <td>
                    <input type="text" disabled name="supplierAddress" value="<{$supplier.supplierAddress}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>供应商电话</b></td>
                <td>
                    <input type="text" disabled name="supplierTel" value="<{$supplier.supplierTel}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
                <td><b>负责人</b></td>
                <td>
                    <input type="text" disabled name="supplierUserName" value="<{$supplier.supplierUserName}>"  required="true"  autofocus="true">
                </td>
                <td><b>负责人电话</b></td>
                <td>
                    <input type="text" disabled name="supplierUserPhone" value="<{$supplier.supplierUserPhone}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>负责人邮箱</b></td>
                <td>
                    <input type="text" disabled name="supplierUserEmail" value="<{$supplier.supplierUserEmail}>"  required="true"  autofocus="true">
                </td>
                <td><b>负责人QQ</b></td>
                <td>
                    <input type="text" disabled name="supplierUserQQ" value="<{$supplier.supplierUserQQ}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
                <td><b>银行名称</b></td>
                <td>
                    <input type="text" disabled name="bankName" value="<{$supplier.bankName}>"  required="true"  autofocus="true">
                </td>
                <td><b>开户银行</b></td>
                <td>
                    <input type="text" disabled name="bankOpenName" value="<{$supplier.bankOpenName}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>开卡人姓名</b></td>
                <td>
                    <input type="text" disabled name="cardUserName" value="<{$supplier.cardUserName}>"  required="true"  autofocus="true">
                </td>
                <td><b>开卡人电话</b></td>
                <td>
                    <input type="text" disabled name="cardUserPhone" value="<{$supplier.cardUserPhone}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>账户</b></td>
                <td>
                    <input type="text" disabled name="bankAccount" value="<{$supplier.bankAccount}>"  required="true"  autofocus="true">
                </td>
                <td><b>金额</b></td>
                <td>
                    <input type="text" disabled name="cardMoney" value="<{$supplier.cardMoney}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
                <td><b>审核人</b></td>
                <td><{html_options name=reviewer id="DropDownTimezone" disabled="disabled" options=$reviewer_options selected=$supplier.reviewer}></td>
            </tr>
            <tr>
                <td><b>备注</b></td>
                <td colspan="3"><textarea style="width:80%;resize: none" disabled name="remark" rows="3" ><{$supplier.remark}></textarea></td>
            </tr>
            <tr>
                <td><b></b></td>
                <td>
                    <div class="btn-toolbar">
                        <input type="hidden" name="nonceStr" value="<{$nonceStr}>">
                        <{if $supplier.flag!=1 }>
                        <button type="submit" class="btn btn-primary"><strong>审核</strong></button>
                        <{/if}>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
