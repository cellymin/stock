<?php /* Smarty version Smarty-3.1.15, created on 2018-09-29 09:34:03
         compiled from "D:\phpPro\wwwroot\StockManager\erp\include\template\sys\goods.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204465baed68b764172-16119242%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5c9292885b4fa29e34d6024d822854bd0b850238' => 
    array (
      0 => 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\template\\sys\\goods.tpl',
      1 => 1511413987,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204465baed68b764172-16119242',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'cateList' => 0,
    'value' => 0,
    '_GET' => 0,
    'list' => 0,
    'page_html' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5baed68b81b325_20340729',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5baed68b81b325_20340729')) {function content_5baed68b81b325_20340729($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="1" title="新增商品" layerUrl="goods_add" layerW="900px" layerH="500px" layerT="2"><i class="icon-plus"></i> 新增</a>
        <a class="btn btn-primary layerModel" action="2" title="编辑商品" layerUrl="goods_modify" layerW="900px" layerH="500px" layerT="2"><i class="icon-pencil"></i> 编辑</a>
        <a class="btn btn-primary layerModel" action="3" title="删除商品" ><i class="icon-trash"></i> 删除</a>
    </div>

    <div style="float:left;margin-right:5px">
        <label>选择分类</label>
        <select name="goodsCateId" id="goodsCateId">
			<option value="0">=请选择=</option>
			<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cateList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['value']->value['cateId'];?>
" data-num="<?php echo $_smarty_tpl->tpl_vars['value']->value['level'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['cateName'];?>
</option>
			<?php } ?>
		</select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['keyword'];?>
" placeholder="输入货号,助记词,产品名称" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
        <a type="button" class="btn btn-primary" onclick="openModal()">导入</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">产品列表</a>
    <div id="page-stats" class="block-body collapse in">
    	<form method="post" action="goods_del.php">
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>货号</th>
                <th>条形码</th>
                <th>名称</th>
                <th>规格</th>
                <th>分类</th>
                <th>单位</th>
                <th>上次进价</th>
                <th>历史最低价</th>
                <th>历史最高价</th>
                <th>平均采购价</th>
                <th>生产日期</th>
                <th>作废日期</th>
                <th>助记词</th>
                <th>备注</th>
            </tr>
            </thead>
            <tbody>
            <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
                <tr>

                    <td><input type="checkbox" name="goodsId[]" data-name="goodsId" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['goodsId'];?>
"></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['goodsSn'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['goodsBarCode'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['goodsName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['goodsSpec'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['cateName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['unitName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['lastPrice'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['minPrice'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['maxPrice'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['avgPrice'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['productionDate'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['invalidDate'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['searchKey'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['remark'];?>
</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
            </form>
        <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="inputExcel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">商品导入</h4>
            </div>
            <div class="modal-body">
                <form id="excelForm" method="post" action="goods.php" enctype="multipart/form-data">
                    <label>excel表格<input type="file" name="excel"></label>
                    <input type="hidden" name="method" value="excel">
                    <button type="sub" class="btn btn-primary" >导入</button>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
    function openModal(){
        $("#inputExcel").modal('show');
    }
</script>
<!---操作的确认层，相当于javascript:confirm函数--->
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>


<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
