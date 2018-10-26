<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->



<div class="form_div">
    <form id="form_data" method="post" action="">
    	<input type="hidden" name="companyId" value="<{$company.companyId}>">
        <table>
            <tr>
                <td><b>公司名称</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="companyName" value="<{$company.companyName}>"  required="true" autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>公司地址</b></td>
                <td>
                    <input class="input-xlarge" type="text" name="companyAddress" value="<{$company.companyAddress}>"  placeholder=""  required="true" >
                </td>
            </tr>
            <tr>
	            <td><b>公司电话</b></td>
	            <td>
	                <input class="input-xlarge" type="text" name="companyTel" value="<{$company.companyTel}>"  placeholder=""  required="true" >
	            </td>
	        </tr>
            <tr>
                <td><b>联系人</b></td>
                <td><input class="input-xlarge" type="text" name="companyUserName" value="<{$company.companyUserName}>"  required="true" autofocus="true"></td>
            </tr>
            <tr>
                <td><b>联系电话</b></td>
                <td><input class="input-xlarge" type="text" name="companyUserPhone" value="<{$company.companyUserPhone}>"  required="true" autofocus="true"></td>
            </tr>
            <tr>
                <td><b>联系邮箱</b></td>
                <td><input class="input-xlarge" type="text" name="companyUserEmail" value="<{$company.companyUserEmail}>"  required="true" autofocus="true"></td>
            </tr>
              <tr>
                <td><b>联系人QQ</b></td>
                <td><input class="input-xlarge" type="text" name="companyUserQQ" value="<{$company.companyUserQQ}>"  required="true" autofocus="true"></td>
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
