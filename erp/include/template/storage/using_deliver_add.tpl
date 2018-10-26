<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<div class="form_div">
    <form method="post" action="using_deliver_add.php">
        <table>
            <tbody>
            <tr>
                <td width="100">商品</td>
                <td><input type="text" value="<{$goods.goodsName}>" readonly></td>
            </tr>
            <tr>
                <td>供应商</td>
                <td><input type="text" value="<{$goods.supplierName}>" readonly></td>
            </tr>
            <tr>
                <td>库位</td>
                <td><input type="text" value="<{$goods.depotSubName}>" readonly></td>
            </tr>
            <tr>
                <td><b>部门</b></td>
                <td><{html_options name=departmentId id="departmentId" class="input-xlarge" options=$department_options selected=$departmentId}></td>
            </tr>
            <tr>
                <td><b>负责人</b></td>
                <td><{html_options name=employeeId id="employeeId" class="input-xlarge" options=$employee_options selected=$_GET.employeeId required="true"}></td>
            </tr>
            <tr>
                <td>数量</td>
                <td><input name="goodsCnt" type="text" required></td>
            </tr>
            <tr>
                <td>备注</td>
                <td><textarea name="remark" id="" cols="30" rows="5" style="resize: none"></textarea></td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="orderId" value="<{$orderId}>">
                    <input type="hidden" name="id" value="<{$goods.id}>">
                    <input type="hidden" name="nonceStr" value="<{$nonceStr}>">
                </td>
                <td>
                    <button class="btn btn-primary">登记</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        $('#departmentId').change(function(){
            var departmentId = $('#departmentId').val();
            window.location.href = "using_deliver_add.php?orderId=<{$orderId}>&id=<{$goods.id}>&departmentId="+departmentId
        })
    })
</script>
