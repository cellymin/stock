<{include file ="header.tpl"}>

<div class="form_div">
    <form action="storage_modify.php" method="post">
        <table width="100%">
            <tbody>
            <tr>
                <td width="120">仓库</td>
                <td>
                    <{html_options name=depotId id="depot" options=$depot_options selected=$depotId}>
                </td>
            </tr>
            <tr>
                <td>库位</td>
                <td>
                    <{html_options name=depotSubId id="depotSub" options=$depotSub_options selected=$set.depotSubId}>
                </td>
            </tr>
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
                <td>最小预警库存</td>
                <td>
                    <input type="number" id="minWarnNum" placeholder="1" required name="minWarnNum" value="<{$set.minWarnNum}>">
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

        $("#depot").change(function () {
            var depotId = $(this).val();
            var goodsCateId = $('#goodsCateId').val();
            var goodsId = $('#goodsId').val();
            var minWarnNum = $('#minWarnNum').val();
            var id = $("input[name=id]").val();

            location.href = 'storage_modify.php?id='+id+'&depotId='+depotId+'&goodsCateId='+goodsCateId+'&goodsId='+goodsId+'&minWarnNum='+minWarnNum
        });

        $("#goodsCateId").change(function () {
            var depotId = $('#depot').val();
            var depotSubId = $('#depotSub').val();
            var goodsCateId = $(this).val();
            var minWarnNum = $('#minWarnNum').val();
            var id = $("input[name=id]").val();

            location.href = 'storage_modify.php?id='+id+'&depotId='+depotId+'&goodsCateId='+goodsCateId+'&depotSubId='+depotSubId+'&minWarnNum='+minWarnNum
        })
    })
</script>