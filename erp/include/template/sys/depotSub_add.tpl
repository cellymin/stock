<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->



<div class="form_div">
    <form id="form_data" method="post" action="">
        <table width="80%">
            <tr>
                <td><b>库位名称</b></td>
                <td>
                    <input type="text" name="depotSubName" value="<{$_GET.depotSubName}>"  required="true">
                </td>
            </tr>
            <tr>
                <td><b>库位编码</b></td>
                <td>
                    <input type="text" name="depotSubNo" value="<{$_GET.depotSubNo}>"  required="true">
                </td>
            </tr>
            <tr>
                <td><b>所属公司</b></td>
                <td><{html_options name=companyId id="companyId"  options=$company_options selected=$_GET.companyId}></td>
            </tr>
            <tr>
                <td><b></b></td>
                <td>
                    <div class="btn-toolbar">
                        <input type="hidden" name="nonceStr" value="<{$nonceStr}>">
                        <input type="hidden" name="depotId" value="<{$_GET.depotId}>">
                        <button type="submit" class="btn btn-primary"><strong>保存</strong></button>
                    </div>
                </td>
            </tr>

        </table>
    </form>
</div>

