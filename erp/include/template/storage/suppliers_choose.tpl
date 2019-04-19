<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form class="form_search" action="" method="GET" style="margin-bottom:0px;float: left;">
        <div style="float:left;margin-right:5px">
            <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入货号,助记词,产品名称"
                   style="width: 160px;">
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
                <th>名称</th>
                <th>税率</th>
            </tr>
            </thead>
            <tbody>
            <{foreach name=module from=$list key=index item=value}>
                <tr>
                    <td><input data-name="goodsId" type="checkbox" value="<{$value.supplierId}>" onclick="ifmore()"></td>
                    <td class="supp"><{$value.supplierName}></td>
                    <td class="taxrate"><{$value.taxrate}></td>
                </tr>
                <{/foreach}>
            </tbody>
        </table>
        <{$page_html}>
    </div>
</div>
<script>
function ifmore(){
    $('input:checkbox:checked').each(function(i){
       if(i>0){
           $(this).prop("checked",false);
           alert("不能选择多个");
       }
    });
}
function choosesupplier() {

    var index = parent.layer.getFrameIndex(window.name);

    $('input:checkbox:checked').each(function(i){
        if(i>0){
            alert("不能选择多个");
            return false;
        }
        var checkid = $(this).val();
        var supp = $(this).parent().parent().find('.supp').text();
        var taxrate = $(this).parent().parent().find('.taxrate').text();
        parent.$('#selectInputClone').val(supp);
        parent.$('.selectssss').remove();
        parent.$('#selectInputClone').after('<input class="selectssss" name="'+parent.$('#selectInputClone').attr("name")+'" type="hidden" value="'+checkid+'"  taxrate="'+taxrate+'" />');
        parent.layer.close(index);
    });
}

</script>
