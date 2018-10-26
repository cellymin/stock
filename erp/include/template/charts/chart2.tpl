<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<style type="text/css">
#depotId,#depotSubId{width:150px;}
</style>	
<div class="tab-pane active in" id="home">
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
	        <label>仓库</label>
	        <{html_options name=depotId id="depotId" class="input-xlarge" options=$depots_options selected=$depotId}>
	    </div>
	    <div style="float:left;margin-right:5px">
	        <label>库位</label>
	        <{html_options name=depotSubId id="depotSubId" class="input-xlarge" options=$depotsSub_options selected=$_depotSubId}>
	    </div>
	    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
	        <button type="submit" class="btn btn-primary">检索</button>
	        <a type="button" class="btn btn-primary" onclick="method5('data_list1')">导出</a>
	    </div>
	    <div style="clear:both;"></div>
	</form>
	
	<div class="block">
		<a href="#page-stats" class="block-heading" data-toggle="collapse">报表</a>
		<div id="page-stats" class="block-body collapse in">
		<table class="table table-striped" id="data_list1">
				<thead>
				<tr>
					<th>产品条码</th>
					<th>产品名称</th>
					<th>产品规格</th>
					<th>库存数量</th>
					<th>公司名称</th>
					<th>仓库</th>
					<th>库位</th>
				</tr>
				</thead>
				<tbody id="list">
			  </tbody>
			</table>						
		</div>
	</div>
</div>
	
<script type="text/javascript">
var page = 1;
$(function(){	
	$('#depotId').change(function(){
		window.location.href = "chart2.php?depotId="+this.value
	})
	
	$('.form_search').submit(function(){
		page = 1;
		var companyId = $('#companyId').val();
		var keyword = $('#keyword').val();
		var depotId = $('#depotId').val();
		var depotSubId = $('#depotSubId').val();
		
		$('.block-heading').html('<font color="red">报表生成中,请勿刷新页面...</font>')
		$('#list').html('');
		_search(companyId, keyword, depotId, depotSubId);
		
		return false;
	})
})

function _search(companyId, keyword, depotId, depotSubId){
	$.ajax({
		type:"post",
		url:"chart2.php",
		data:{companyId:companyId, keyword:keyword, depotId:depotId, depotSubId:depotSubId, page_no:page},
		async:false,
		dataType:"json",
		success:function(e){
			var html = '';
			html += '<tr>';
			html += '<td>'+ e[0]['goodsSn'] +'</td>';
			html += '<td>'+ e[0]['goodsName'] +'</td>';
			html += '<td>'+ e[0]['goodsSpec'] +'</td>';
			html += '<td>'+ e[0]['goodsCnt'] +'</td>';
			html += '<td>'+ e[0]['companyName'] +'</td>';
			html += '<td>'+ e[0]['depotName'] +'</td>';
			html += '<td>'+ e[0]['depotSubName'] +'</td>';
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
					_search(companyId, keyword, depotId, depotSubId);
				},200)
			}else{
				$('.block-heading').html('报表');
				alert('报表生成成功')
			}
		}
	});
}
</script>	
<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>