<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="1" title="增加产品分类" layerUrl="goods_cats_add" layerW="400px" layerH="420px" layerT="2"><i class="icon-plus"></i> 新增</a>
        <a class="btn btn-primary layerModel" action="2" title="修改产品分类" layerUrl="goods_cats_modify" layerW="400px" layerH="420px" layerT="2"><i class="icon-pencil"></i> 编辑</a>
        <a class="btn btn-primary layerModel" action="3" title="删除分类"><i class="icon-trash"></i> 删除</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">产品分类列表</a>
    <div id="page-stats" class="block-body collapse in">
        <form action="goods_cats_del.php" method="post">
            <table class="table table-striped" id="data_list">
                <thead>
                <tr>
                    <th>#</th>
                    <th width="200">分类</th>
                    <th width="200">编号</th>
                    <th>排序</th>
                </tr>
                </thead>
                <tbody>
                <{foreach name=module from=$list key=index item=value}>
                    <tr>
                        <td><input  name="cateId[]" data-name="cateId"  type="checkbox" value="<{$value.cateId}>"></td>
                        <td>
                            <font class="level"><{$value.level}></font>
                            <{$value.cateName}>
                        </td>
                        <td><{$value.cateNo}></td>
                        <td><{$value.cateSort}></td>
                    </tr>
                    <{/foreach}>
                </tbody>
            </table>
        </form>

    </div>
</div>

<script type="text/javascript">
$(function(){
	$('body .level').each(function(){
		var count = Number($(this).text());
		var str = '';
		for(var i=1; i<count; i++){
			str += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		}
		$(this).html(str);
	})
})
</script>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>

<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>