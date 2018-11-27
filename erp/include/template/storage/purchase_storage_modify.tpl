<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<div class="form_div">
    <form method="post" action="purchase_storage_modify.php">
        <table>
            <tbody>
            <tr>
                <td>商品</td>
                <td><input type="text" value="<{$goods.goodsName}>" readonly></td>
            </tr>
            <tr>
                <td>仓库</td>
                <td><{html_options name=depotId id="depotId" required="true" options=$depots_options selected=$depotId}></td>
            </tr>
            <tr>
                <td>库位</td>
                <td><{html_options name=depotSubId id="DropDownTimezone" required="true" options=$depotSubs_options selected=$depotSubId}></td>
            </tr>
            <tr>
                <td>数量</td>
                <td><input name="goodsCnt" type="text" value="<{$goods.goodsCnt}>" required></td>
            </tr>
            <tr>
                <td>不含税价格</td>
                <td><input name="goodsPrice" type="text" value="<{$goods.goodsPrice}>" required onchange="ratejisuan(this)" ></td>
            </tr>
            <tr>
                <td>税率</td>
                <td><input name="" type="text" disabled="disabled"  value="<{$taxrate}>" class="taxrate"></td>
            </tr>
            <tr>
                <td>含税价</td>
                <td><input name="ratepri" type="text" readonly  value="<{$hanpri}>" class="hanpri"></td>
            </tr>
            <tr>
                <td>备注</td>
                <td><textarea name="remark" id="" cols="30" rows="5" style="resize: none"><{$goods.remark}></textarea></td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="orderId" value="<{$orderId}>">
                    <input type="hidden" name="id" value="<{$id}>">
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

<script>
    $(function(){
        $('#depotId').change(function(){
            var depotId = $('#depotId').val();
            window.location.href = "purchase_storage_modify.php?orderId=<{$orderId}>&id=<{$id}>&depotId="+depotId
        })
    })
    function ratejisuan(e) {
        var buhanpri = parseFloat($(e).val());//不含税价
        var rate = parseFloat($('.taxrate').val());//税率
        var hanpri = buhanpri*(1+rate); //不含税价格=含税价/(1+税率)
        $('.hanpri').val(decimal(hanpri,6));
    }
    function decimal(num,v){
        var vv = Math.pow(10,v);
        return Math.round(num*vv)/vv;
    }
</script>
