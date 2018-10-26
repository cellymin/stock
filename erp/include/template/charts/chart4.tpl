<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<style type="text/css">
#depotId,#depotSubId,#startTime,#endTime{width:150px;}
</style>

<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
	<div style="float:left;margin-right:5px">
        <label>关键词</label>
        <input type="text" name="keyword" id="keyword" placeholder="产品条码/关键词">
    </div>
    <div style="float:left;margin-right:5px">
        <label>仓库</label>
        <{html_options name=depotId id="depotId" class="input-xlarge" options=$depots_options selected=$_GET.depotId}>
    </div>
    <div style="float:left;margin-right:5px">
    	<label>类型</label>
    	<select name="table" id="table" style="width:80px;">
    		<option value="vich_orders_ip">采购</option>
    		<option value="vich_orders_id">调库</option>
    		<option value="vich_orders_iq">其他</option>
    	</select>
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
	<a href="#page-stats" class="block-heading" data-toggle="collapse">图表</a>
	<div id="page-stats" class="block-body collapse in">
	<table class="table table-striped" id="data_list">
			<thead>
			<tr>
				<th>产品条码</th>
				<th>产品名称</th>
				<th>数量</th>
				<th>产品规格</th>
				<th>时间</th>
				<th>订单编号</th>
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
		var depotId = $('#depotId').val();
		var table = $('#table').val();
		var startTime = $('#startTime').val();
		var endTime = $('#endTime').val();
		
		$('.block-heading').html('<font color="red">报表生成中,请勿刷新页面...</font>')
		$('#list').html('');
		_search(depotId, table, startTime, endTime);
		
		return false;
	})
})

function _search(depotId, table, startTime, endTime){
	$.ajax({
		type:"post",
		url:"chart4.php",
		data:{depotId:depotId, table:table, startTime:startTime, endTime:endTime, page_no:page},
		async:false,
		dataType:"json",
		success:function(e){			
			var html = '';
			html += '<tr>';
			html += '<td>'+ e[0]['goodsSn'] +'</td>';
			html += '<td>'+ e[0]['goodsName'] +'元</td>';
			html += '<td>'+ e[0]['goodsCnt'] +'</td>';
			html += '<td>'+ e[0]['goodsSpec'] +'</td>';
			html += '<td>'+ e[0]['reviewerTime'] +'</td>';
			html += '<td>'+ e[0]['orderNo'] +'</td>';
			html += '</tr>';
			$('#list').append(html);
			if(e[0].count==0){
				$('.block-heading').html('报表');
				$('#list').html('');
				alert('暂无数据');
				return false;
			}
			page ++;
			if(page<=e[0]['count']){
				setTimeout(function(){
					_search(depotId, table, startTime, endTime);
				},200)
			}else{
				$('.block-heading').html('报表');
				alert('报表生成成功')
			}
		}
	});
	return false;
}
</script>
<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>