<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->


<div class="form_div">
    <form id="" method="post" action="">
        <table width="100%">
            <tr>
                <td><b>供应商名称</b></td>
                <td>
                    <input type="text" name="supplierName" value="<{$_POST.supplierName}>"  required="true"  autofocus="true">
                </td>
                <td><b>供应商地址</b></td>
                <td>
                    <input type="text" name="supplierAddress" value="<{$_POST.supplierAddress}>"  required="true"  autofocus="true">
                </td>
            </tr>
             <tr>
                <td><b>供应商电话</b></td>
                <td>
                    <input type="text" name="supplierTel" value="<{$_POST.supplierTel}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
                <td><b>负责人</b></td>
                <td>
                    <input type="text" name="supplierUserName" value="<{$_POST.supplierUserName}>"  required="true"  autofocus="true">
                </td>
                <td><b>负责人电话</b></td>
                <td>
                    <input type="text" name="supplierUserPhone" value="<{$_POST.supplierUserPhone}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>负责人邮箱</b></td>
                <td>
                    <input type="text" name="supplierUserEmail" value="<{$_POST.supplierUserEmail}>"  required="true"  autofocus="true">
                </td>
                <td><b>负责人QQ</b></td>
                <td>
                    <input type="text" name="supplierUserQQ" value="<{$_POST.supplierUserQQ}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
                <td><b>银行名称</b></td>
                <td>
                    <input type="text" name="bankName" value="<{$_POST.bankName}>"  required="true"  autofocus="true">
                </td>
                <td><b>开户银行</b></td>
                <td>
                    <input type="text" name="bankOpenName" value="<{$_POST.bankOpenName}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>开卡人姓名</b></td>
                <td>
                    <input type="text" name="cardUserName" value="<{$_POST.cardUserName}>"  required="true"  autofocus="true">
                </td>
                <td><b>开卡人电话</b></td>
                <td>
                    <input type="text" name="cardUserPhone" value="<{$_POST.cardUserPhone}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>账户</b></td>
                <td>
                    <input type="text" name="bankAccount" value="<{$_POST.bankAccount}>"  required="true"  autofocus="true">
                </td>
                <td><b>金额</b></td>
                <td>
                    <input type="text" name="cardMoney" value="<{$_POST.cardMoney}>"  required="true"  autofocus="true">
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
                <td><b>选择审核人</b></td>
                <td><{html_options name=reviewer id="DropDownTimezone"  options=$reviewer_options selected=0}></td>
            </tr>
            <tr>
                <td><b>备注</b></td>
                <td colspan="3"><textarea style="width:80%;resize: none" name="remark"  value="<{$_POST.remark}>" rows="3" ></textarea></td>
            </tr>
            <tr>
                <td><b></b></td>
                <td>
                    <div class="btn-toolbar">
                        <input type="hidden" name="nonceStr" value="<{$nonceStr}>">
                        <button type="submit" class="btn btn-primary"><strong>保存</strong></button>
                    </div>
                </td>
            </tr>

        </table>
    </form>
</div>
