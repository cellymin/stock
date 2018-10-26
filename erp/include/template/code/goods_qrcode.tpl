<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="1" title="设置模板" layerUrl="design" layerW="800px" layerH="600px" layerT="2"><i class="icon-plus"></i> 设置模板</a>
        <a class="btn btn-primary layerModel" action="2" title="预览" layerUrl="preview" layerW="800px" layerH="600px" layerT="2"><i class="icon-plus"></i> 预览</a>
        <!--<a class="btn btn-primary"><i class="icon-plus"></i> 打印</a>-->
    </div>

    <div style="float:left;margin-right:5px">
        <label>选择分类</label>
        <select name="goodsCateId" id="goodsCateId">
            <option value="0">=请选择=</option>
            <{foreach name=module from=$cateList key=index item=value}>
            <option value="<{$value.cateId}>" data-num="<{$value.level}>"><{$value.cateName}></option>
            <{/foreach}>
        </select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<{$_GET.keyword}>" placeholder="输入货号,助记词,产品名称" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">产品列表</a>
    <div id="page-stats" class="block-body collapse in">
        <form method="post" action="">
            <table class="table table-striped" id="data_list">
                <thead>
                <tr>
                    <th ><input type="checkbox" id="chkAll"></th>
                    <th width="150">货号</th>
                    <th width="150">条形码</th>
                    <th width="300">名称</th>
                    <th width="200">规格</th>
                    <th width="100">分类</th>
                    <th width="100">单位</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <{foreach name=module from=$list key=index item=value}>
                    <tr>
                        <td width="100"><input type="checkbox" name="goodsId[]" data-name="goodsId" value="<{$value.goodsId}>"></td>
                        <td><{$value.goodsSn}></td>
                        <td><{$value.goodsBarCode}></td>
                        <td><{$value.goodsName}></td>
                        <td><{$value.goodsSpec}></td>
                        <td><{$value.cateName}></td>
                        <td><{$value.unitName}></td>
                        <td></td>
                    </tr>
                    <{/foreach}>
                </tbody>
            </table>
            <{$page_html}>
    </div>
</div>


<script type="text/javascript">
    $(function(){
        $('#goodsCateId option').each(function(){
            var count = Number($(this).attr('data-num'));
            var cateName = $(this).text();
            var str = '|'
            if(count>1){
                for(var i=1; i<count; i++){
                    str += '--';
                }
                $(this).html(str + " " + cateName);
            }
        });
    });
</script>
<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>

<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>