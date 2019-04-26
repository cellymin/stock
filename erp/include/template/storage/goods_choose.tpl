<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form class="form_search" action="" method="GET" style="margin-bottom:0px;float: left;">
        <div style="float:left;margin-right:5px">
            <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入货号,助记词,产品名称"
                   style="width: 160px;">
        </div>
        <div style="float:left;margin-right:5px">
            <select name="goodsCateId" id="" style="width: 130px">
                <{foreach from=$goodsCate item=v}>
            <option value="<{$v.cateId}>" <{if $_GET.goodsCateId==$v.cateId}>selected<{/if}>>
                <{if $v.level>1}>
                |<{str_repeat('-',$v.level)}>&nbsp;<{$v.cateName}>
                <{else}>
                <{$v.cateName}>
                <{/if}>
                </option>
                <{/foreach}>
            </select>
        </div>
        <div class="btn-toolbar" style="padding-bottom:0px;margin-top:0px;margin-bottom:0px;float: left">
            <button type="submit" class="btn btn-primary"><i class="icon-search"></i></button>
        </div>
        <div style="clear:both;"></div>
    </form>
    <div class="btn-toolbar" style="padding-bottom:0px;margin-top:0px;margin-bottom:0px;float: right">
        <button class="btn btn-primary" onclick="choosesupplier()">选择</button>
    </div>
    <div>

        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>商品名称</th>
                <th>规格</th>
                <th>单位</th>
                <th>上次进价</th>
                <th>最低进价</th>
                <th>最高进价</th>
                <th>平均进价</th>
            </tr>
            </thead>
            <tbody>
            <{foreach name=module from=$list key=index item=value}>
                <tr>
                    <td><input data-name="goodsId" type="checkbox" value="<{$value.goodsId}>" onclick="ifexist(this)">
                    </td>
                    <td class="goodsName"><{$value.goodsName}></td>
                    <td class="goodsSpec"><{$value.goodsSpec}></td>
                    <td class="unitName"><{$value.unitName}></td>
                    <td class="lastPrice"><{$value.lastPrice}></td>
                    <td class="minPrice"><{$value.minPrice}></td>
                    <td class="maxPrice"><{$value.maxPrice}></td>
                    <td class="avgPrice"><{$value.avgPrice}></td>
                </tr>
                <{/foreach}>
            </tbody>
        </table>
        <{$page_html}>
    </div>
</div>
<script>
    var goodsname = new Array();

    function ifexist(e) {
        var clickname = $(e).parent().next().text();
        if (goodsname.length == 0) {
            parent.$('#tb_1 tr').each(function (i) {

                if (i > 0) {
                    var idname = $(this).children().eq(0).children().eq(0).attr('id');
                    console.log(idname);
                    if(idname=='selectInputGClone'){
                        return true;
                    }else{
                        var gname = $(this).children().eq(0).text().trim().replace(/\s/g, "");
                        if (gname != '' && gname != '选择') {
                            goodsname.push(gname)
                        }
                    }
                }
            })
        }
        var k = goodsname.indexOf(clickname);
        if (k >= 0 && $(e).attr('checked') == 'checked') {
            alert('商品重复');
            $(e).attr('checked', false);
            return false;
        } else {
            if ($(e).attr('checked') == 'checked') {
                goodsname.push(clickname);
            }
            else {
                var index = goodsname.indexOf(clickname);
                if (index > -1) {
                    goodsname.splice(index, 1);
                }
            }
        }
    }

    function choosesupplier() {
        var index = parent.layer.getFrameIndex(window.name);
        trs = '';
        var taxrate = parseFloat(parent.$('.selectssss').attr('taxrate'));

        if (1 < taxrate || taxrate <= 0) {
            alert('税率不合法')
            return false;
        }
        $('input:checkbox:checked').each(function (i) {

            var goodsId = $(this).val();
            var goodsName = $(this).parent().parent().find('.goodsName').text();
            var goodsSpec = $(this).parent().parent().find('.goodsSpec').text();
            var unitName = $(this).parent().parent().find('.unitName').text();
            var lastPrice = $(this).parent().parent().find('.lastPrice').text();
            var hanpri = parseFloat(lastPrice) * (1 + taxrate);
            $(this).attr('checked', false);
            trs += '<tr><td><i class="gname">' + goodsName + '</i><i class="icon-pencil" attid="'+goodsId+ '" onclick="changename(this)" title="修改商品名称"></i></td><td>' + goodsSpec + '</td><td>' + unitName + '</td><td><input type="text" value="" style="width:45px;" onkeyup="changenum()"></td><td><input type="text" style="width:45px;" class="hanpri" value=" ' + hanpri.toFixed(2) + '" onkeyup="ratejisuan(this)" /></td><td class="buhanpri">' + parseFloat(lastPrice).toFixed(6) + '</td><td  class="pritype"><select name="costprice"><option value="1" selected="selected">不含税价</option><option value="2">含税价</option> </select></td><td onclick="delgoods(this)"><img class="imgDel" src="../assets/images/trash.png"></td></tr>'
        });
        parent.$('#tb_1').children().children().eq(-2).after(trs);
        parent.$('.goodsName').val(goodsname);

    }

</script>
