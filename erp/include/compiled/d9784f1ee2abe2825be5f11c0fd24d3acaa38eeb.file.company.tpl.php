<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 10:24:58
         compiled from "D:\wwwroot\erp\include\template\sys\company.tpl" */ ?>
<?php /*%%SmartyHeaderCode:921559fd24fa5b23e8-15408324%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd9784f1ee2abe2825be5f11c0fd24d3acaa38eeb' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\sys\\company.tpl',
      1 => 1507772056,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '921559fd24fa5b23e8-15408324',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    '_GET' => 0,
    'list' => 0,
    'value' => 0,
    'page_html' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd24fa641f97_56090612',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd24fa641f97_56090612')) {function content_59fd24fa641f97_56090612($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="1" title="增加公司" layerUrl="company_add" layerW="700px" layerH="450px" layerT="2"><i class="icon-plus"></i> 新增</a>
        <a class="btn btn-primary layerModel" action="2" title="修改公司" layerUrl="company_modify" layerW="700px" layerH="450px" layerT="2"><i class="icon-pencil"></i> 编辑</a>
        <a class="btn btn-primary layerModel" action="3"  title="删除公司"><i class="icon-trash"></i> 删除</a>
    </div>

    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['keyword'];?>
" placeholder="输入名称" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">公司列表</a>
    <div id="page-stats" class="block-body collapse in">
    	<form method="post" action="company_del.php">
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>公司名称</th>
                <th>地址</th>
                <th>公司电话</th>
                <th>联系人</th>
                <th>联系电话</th>
                <th>邮箱</th>
                <th>联系人QQ</th>
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
                    <td><input type="checkbox" name="companyId[]" data-name="companyId" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['companyId'];?>
"></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['companyName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['companyAddress'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['companyTel'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['companyUserName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['companyUserPhone'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['companyUserEmail'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['companyUserQQ'];?>
</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </form>
        <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>


<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
