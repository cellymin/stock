<?php /* Smarty version Smarty-3.1.15, created on 2018-09-29 09:34:14
         compiled from "D:\phpPro\wwwroot\StockManager\erp\include\template\sys\goods_cats.tpl" */ ?>
<?php /*%%SmartyHeaderCode:67025baed69666ff38-59572375%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2eabc37d3e95eae602b0b92f05d7176f122f2e6d' => 
    array (
      0 => 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\template\\sys\\goods_cats.tpl',
      1 => 1507618248,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '67025baed69666ff38-59572375',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'list' => 0,
    'value' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5baed6966ea052_94490808',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5baed6966ea052_94490808')) {function content_5baed6966ea052_94490808($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

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
                <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
                    <tr>
                        <td><input  name="cateId[]" data-name="cateId"  type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['cateId'];?>
"></td>
                        <td>
                            <font class="level"><?php echo $_smarty_tpl->tpl_vars['value']->value['level'];?>
</font>
                            <?php echo $_smarty_tpl->tpl_vars['value']->value['cateName'];?>

                        </td>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['cateNo'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['cateSort'];?>
</td>
                    </tr>
                    <?php } ?>
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
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>


<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
