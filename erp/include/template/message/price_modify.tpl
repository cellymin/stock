<{include file ="header.tpl"}>

<div class="form_div">
    <form action="" method="post">
        <table width="100%">
            <tbody>
            <tr>
                <td>分类</td>
                <td>
                    <select name="goodsCateId" id="goodsCateId">
                        <{foreach name=module from=$goods_cates key=index item=value}>
                    <option value="<{$value.cateId}>" <{if $goodsCateId==$value.cateId}>selected<{/if}> data-num="<{$value.level}>"><{$value.cateName}></option>
                        <{/foreach}>
                    </select>
                </td>
            </tr>
            <tr>
                <td>商品</td>
                <td>
                    <{html_options name=goodsId id="goodsId" options=$goods_options selected=$set.goodsId}>
                </td>
            </tr>
            <tr>
                <td>价格上涨预警百分比</td>
                <td>
                    <input type="text" id="upPercent" placeholder="0.00" name="upPercent" value="<{$set.upPercent}>">
                </td>
            </tr>
            <tr>
                <td>价格下跌预警百分比</td>
                <td>
                    <input type="text" id="downPercent" placeholder="0.00" name="downPercent" value="<{$set.downPercent}>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="hidden" name="nonceStr" value="<{$nonceStr}>">
                    <input type="hidden" name="id" value="<{$set.id}>">
                    <button type="submit" class="btn btn-primary">保存</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        $('#goodsCateId option').each(function(){
            var count = Number($(this).attr('data-num'));
            var cateName = $(this).text();
            var str = '|';
            if(count>1){
                for(var i=1; i<count; i++){
                    str += '--';
                }
                $(this).html(str + " " + cateName);
            }
        });

        $("#goodsCateId").change(function () {
            var goodsCateId = $(this).val();
            var id = $("input[name=id]").val();

            location.href = 'price_modify.php?id='+id+'&goodsCateId='+goodsCateId+'&warnPercent='+warnPercent
        })
    })
</script>