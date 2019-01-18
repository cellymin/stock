<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<style type="text/css">
#startTime,#endTime{width:150px;}
</style>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
	<div style="float:left;margin-right:5px">
        <label>关键词</label>
        <input type="text" name="keyword" id="keyword" placeholder="产品条码/关键词">
    </div>
    <div style="float:left;margin-right:5px">
        <label>选择公司</label>
        <{html_options name=companyId id="companyId" class="input-xlarge" options=$company_options selected=$_GET.companyId}>
    </div>
    <div style="float:left;margin-right:5px">
        <label>日期段</label>
        <input type="text" name="startTime" id="startTime" class="time_input" readonly value="<{$_GET.startTime}>">
    </div>
    <div style="float:left;margin-right:5px">
        <label>至</label>
        <input type="text" name="endTime" id="endTime" class="time_input" readonly value="<{$_GET.endTime}>">
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">报表</a>
	<div id="page-stats" class="block-body collapse in">
	<table class="table table-striped" id="data_list">
			<thead>
			<tr>
				<th>商品条码</th>
				<th>商品名称</th>
				<th>单价</th>
				<th>采购数量</th>
				<th>规格</th>
				<th>入库时间</th>		
				<th>单号</th>		
			</tr>
			</thead>
			<tbody id="list">
		  </tbody>
		</table>						
	</div>
</div>

<script type="text/javascript">
var page = 1;
$(function(){
	$('.form_search').submit(function(){
		page = 1;
		var keyword = $('#keyword').val();
		var companyId = $('#companyId').val();
		var startTime = $('#startTime').val();
		var endTime = $('#endTime').val();

		// $('.block-heading').html('<font color="red">报表生成中,请勿刷新页面...</font>')
		$('#list').html('');
		_search(keyword, companyId, startTime, endTime);
		
		return false;
	})
})

function _search(keyword, companyId, startTime, endTime){
	$.ajax({
		type:"post",
		url:"chart1.php",
		data:{keyword:keyword, companyId:companyId, startTime:startTime, endTime:endTime, page_no:page},
		async:false,
		dataType:"json",
		success:function(e){
		    var i;
		    for (i=0;i<e.length;i++){
                var html = '';
                html += '<tr>';
                html += '<td>'+ e[i]['goodsSn'] +'</td>';
                html += '<td>'+ e[i]['goodsName'] +'</td>';
                html += '<td>'+ e[i]['goodsPrice'] +'元</td>';
                html += '<td>'+ e[i]['goodsCnt'] +'</td>';
                html += '<td>'+ e[i]['goodsSpec'] +'</td>';
                html += '<td>'+ e[i]['reviewerTime'] +'</td>';
                html += '<td>'+ e[i]['orderNo'] +'</td>';
                html += '</tr>';
                $('#list').append(html);
            }

			if(e[0].count==0){
				$('.block-heading').html('报表');
				$('#list').html('');
				alert('暂无数据');
				return false;
			}
			// page ++;
			// if(page<=e[0]['count']){
			// 	setTimeout(function(){
			// 		_search(keyword, companyId, startTime, endTime);
			// 	},200)
			// }
			else{
				$('.block-heading').html('报表');
				alert('报表生成成功')
			}
		}
	});
}
</script>
<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>