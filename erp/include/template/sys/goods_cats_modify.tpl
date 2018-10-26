<{include file ="header.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->


<div class="form_div">
    <form id="form_data" method="post" action="" autocomplete="off">
    	<input type="hidden" name="cateId" value="<{$info.cateId}>" />
        <table>
			<tr>
				<td><b>一级分类</b></td>
				<td>
					<select name="goodsCateId1" id="goodsCateId1">
						<option value="0">=请选择=</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>二级分类</b></td>
				<td>
					<select name="goodsCateId2" id="goodsCateId2">
						<option value="0">=请选择=</option>
					</select>
				</td>
			</tr>
            <tr>
                <td><b>分类名称</b></td>
                <td>
                    <input type="text" name="cateName" value="<{$info.cateName}>"  required="true" autofocus="true">
                </td>
            </tr>
			<tr>
				<td><b>分类编号</b></td>
				<td>
					<input type="text" name="cateNo" value="<{$info.cateNo}>"  required="true" autofocus="true">
				</td>
			</tr>
            <tr>
                <td><b>排序</b></td>
                <td>
                    <input type="text" name="cateSort" value="<{$info.cateSort}>"  required="true" autofocus="true">
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
<script type="text/javascript">
	var pid = '<{$info.parentId}>';
	var ppid = '<{$info.ppid}>';
	var isCheck = '';

	$(function () {
		opt(0,$("#goodsCateId1"),1);
        var id = ppid;
		if(ppid==0)
		    id = pid;
        if(id!=0)
            opt(id,$("#goodsCateId2"),2);
	});

	$("#goodsCateId1").change(function () {
		var parentId = $(this).val();
		$("#goodsCateId2 option:not(:first-child)").remove();
        if(parentId!=0)
		    opt(parentId,$("#goodsCateId2"),0)
	});

	function opt(parentId,select,type) {
        console.log(parentId);
		$.ajax({
			url:'goods_cats_modify.php',
			type:'POST',
			dataType:'json',
			async:false,
			data:{parentId:parentId,method:'opt'},
			success:function (e) {
				if(e){
					$.each(e,function (i,v) {
						isCheck = '';
                        if (type == 1 && ppid == v.cateId)
                            isCheck = 'selected';
                        if (type == 2 && pid == v.cateId)
                            isCheck = 'selected';
                        if (ppid == 0 && pid == v.cateId)
                            isCheck = 'selected';
                        select.append('<option value="' + v.cateId + '" ' + isCheck + '>' + v.cateName + '</option>');
                    })
				}
			}
		})
	}
</script>