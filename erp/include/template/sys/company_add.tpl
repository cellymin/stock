<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form id="form_data" method="post" action="">
        <table>
            <tr>
                <td><b>公司名称</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="companyName" value="<{$_POST.companyName}>"  required="true" autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>公司地址</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="companyAddress" value="<{$_POST.companyAddress}>"  placeholder=""  required="true" >
                </td>
            </tr>
            <tr>
                <td><b>公司电话</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="companyTel" value="<{$_POST.companyTel}>"  placeholder=""  required="true" >
                </td>
            </tr>
            <tr>
                <td><b>联系人</b></td>
                <td><input class="input-xlarge" type="text" name="companyUserName" value="<{$_POST.companyUserName}>"  required="true" autofocus="true"></td>
            </tr>
            <tr>
                <td><b>联系电话</b></td>
                <td><input class="input-xlarge" type="text" name="companyUserPhone" value="<{$_POST.companyUserPhone}>"  required="true" autofocus="true"></td>
            </tr>
            <tr>
                <td><b>邮箱</b></td>
                <td><input class="input-xlarge" type="text" name="companyUserEmail" value="<{$_POST.companyUserEmail}>"  required="true" autofocus="true"></td>
            </tr>
            <tr>
                <td><b>QQ</b></td>
                <td><input class="input-xlarge" type="text" name="companyUserQQ" value="<{$_POST.companyUserQQ}>"  required="true" autofocus="true"></td>
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
