<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->


<div class="form_div">
    <form id="" method="post" action="">
        <input type="hidden" name="supplierId" value="<{$supplier.supplierId}>">
        <table width="100%">
            <tr>
                <td><b>供应商名称</b></td>
                <td>
                    <input type="text" name="supplierName" value="<{$supplier.supplierName}>"  required="true"  autofocus="true">
                </td>
                <td><b>供应商地址</b></td>
                <td>
                    <input type="text" name="supplierAddress" value="<{$supplier.supplierAddress}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>供应商电话</b></td>
                <td>
                    <input type="text" name="supplierTel" value="<{$supplier.supplierTel}>"  required="true"  autofocus="true">
                </td>
                <td><b>供应商税率</b></td>
                <td>
                    <input type="text" name="taxrate" value="<{$supplier.taxrate}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
                <td><b>负责人</b></td>
                <td>
                    <input type="text" name="supplierUserName" value="<{$supplier.supplierUserName}>"  >
                </td>
                <td><b>负责人电话</b></td>
                <td>
                    <input type="text" name="supplierUserPhone" value="<{$supplier.supplierUserPhone}>" >
                </td>
            </tr>
            <tr>
                <td><b>负责人邮箱</b></td>
                <td>
                    <input type="text" name="supplierUserEmail" value="<{$supplier.supplierUserEmail}>" >
                </td>
                <td><b>负责人QQ</b></td>
                <td>
                    <input type="text" name="supplierUserQQ" value="<{$supplier.supplierUserQQ}>"  >
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
                <td><b>银行名称</b></td>
                <td>
                    <input type="text" name="bankName" value="<{$supplier.bankName}>"  >
                </td>
                <td><b>开户银行</b></td>
                <td>
                    <input type="text" name="bankOpenName" value="<{$supplier.bankOpenName}>" autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>开卡人姓名</b></td>
                <td>
                    <input type="text" name="cardUserName" value="<{$supplier.cardUserName}>"   autofocus="true">
                </td>
                <td><b>开卡人电话</b></td>
                <td>
                    <input type="text" name="cardUserPhone" value="<{$supplier.cardUserPhone}>"   autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>账户</b></td>
                <td>
                    <input type="text" name="bankAccount" value="<{$supplier.bankAccount}>"   autofocus="true">
                </td>
                <td><b>金额</b></td>
                <td>
                    <input type="text" name="cardMoney" value="<{$supplier.cardMoney}>"   autofocus="true">
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
                <td><b>选择审核人</b></td>
                <td><{html_options name=reviewer id="DropDownTimezone"  options=$reviewer_options selected=$supplier.reviewer}></td>
            </tr>
            <tr>
                <td><b>备注</b></td>
                <td colspan="3"><textarea style="width:80%;resize: none" name="remark" rows="3" ><{$supplier.remark}></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div class="btn-toolbar">
                        <input type="hidden" name="nonceStr" value="<{$nonceStr}>">
                        <button type="submit" class="btn btn-primary"><strong>保存</strong></button>
                    </div>
                </td>
                <td colspan="2"> <span class="label label-important">注意:</span>&nbsp;修改后将重新提交审核</td>
            </tr>

        </table>
    </form>
</div>
