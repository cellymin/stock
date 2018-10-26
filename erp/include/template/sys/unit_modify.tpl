<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<div class="form_div">
            <form id="form_data" method="post" action="">
            	<input type="hidden" name="unitId" value="<{$unit.unitId}>">
                <table width="80%">
                    <tr>
                        <td><b>计量单位</b></td>
                        <td>
                            <input type="text" name="unitName" value="<{$unit.unitName}>"  required="true" autofocus="true">
                        </td>
                    </tr>
                    <tr>
                        <td><b>单位编号</b></td>
                        <td>
                            <input type="text" name="unitNo" value="<{$unit.unitNo}>"  required="true" autofocus="true">
                        </td>
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
