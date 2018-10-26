<?php /* Smarty version Smarty-3.1.15, created on 2017-11-03 13:50:34
         compiled from "D:\wwwroot\jxc.com\erp\include\template\charts\chart2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:700959fbb7d1be7bb8-27742526%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8758512a8382da2edb8fd82312ed465be80584b' => 
    array (
      0 => 'D:\\wwwroot\\jxc.com\\erp\\include\\template\\charts\\chart2.tpl',
      1 => 1509688222,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '700959fbb7d1be7bb8-27742526',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fbb7d1cab0b8_92238271',
  'variables' => 
  array (
    'company_options' => 0,
    '_GET' => 0,
    'depots_options' => 0,
    'depotId' => 0,
    'depotsSub_options' => 0,
    '_depotSubId' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fbb7d1cab0b8_92238271')) {function content_59fbb7d1cab0b8_92238271($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wwwroot\\jxc.com\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

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
	        <?php echo smarty_function_html_options(array('name'=>'companyId','id'=>"companyId",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['company_options']->value,'selected'=>$_smarty_tpl->tpl_vars['_GET']->value['companyId']),$_smarty_tpl);?>

	    </div>
	    <div style="float:left;margin-right:5px">
	        <label>仓库</label>
	        <?php echo smarty_function_html_options(array('name'=>'depotId','id'=>"depotId",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['depots_options']->value,'selected'=>$_smarty_tpl->tpl_vars['depotId']->value),$_smarty_tpl);?>

	    </div>
	    <div style="float:left;margin-right:5px">
	        <label>库位</label>
	        <?php echo smarty_function_html_options(array('name'=>'depotSubId','id'=>"depotSubId",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['depotsSub_options']->value,'selected'=>$_smarty_tpl->tpl_vars['_depotSubId']->value),$_smarty_tpl);?>

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
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
