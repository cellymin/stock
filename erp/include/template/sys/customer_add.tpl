<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form id="form_data" method="post" action="">
        <table>
            <tr>
                <td><b>公司名称</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="customerName" value="<{$_POST.customerName}>"  required="true" autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>公司地址</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="customerAddress" value="<{$_POST.customerAddress}>"  placeholder=""  required="true" >
                </td>
            </tr>
            <tr>
                <td><b>联系人</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="customerUserName" value="<{$_POST.customerUserName}>"  placeholder=""  required="true" >
                </td>
            </tr>
            <tr>
                <td><b>联系电话</b></td>
                <td><input class="input-xlarge" type="text" name="customerUserPhone" value="<{$_POST.customerUserPhone}>"  required="true"></td>
            </tr>
            <tr>
                <td><b>联系邮箱</b></td>
                <td><input class="input-xlarge" type="text" name="customerUserEmail" value="<{$_POST.customerUserEmail}>"  required="true"></td>
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
