<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 11:31:42
         compiled from "D:\wwwroot\erp\include\template\finance\search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:734659fd349ed22656-36389640%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9cc248f79d83c1be40a0593c5b1aca0ef0fe793e' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\finance\\search.tpl',
      1 => 1508235300,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '734659fd349ed22656-36389640',
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
  'unifunc' => 'content_59fd349edd5951_68926870',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd349edd5951_68926870')) {function content_59fd349edd5951_68926870($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="2" title="详情" layerUrl="finance_detail" layerW="850px"
           layerH="640px" layerT="2"><i class="icon-pencil"></i> 详情</a>
        <a class="btn btn-primary layerModel" action="4" title="新增" layerUrl="finance_add" layerW="1000px"
           layerH="650px" layerT="2"><i class="icon-plus"></i> 新增</a>
    </div>
    <div style="float:left;margin-right:5px">
        <label>类型</label>
        <select name="type" id="">
            <option value="0" <?php if ($_smarty_tpl->tpl_vars['_GET']->value['type']==0) {?>selected<?php }?>>全部</option>
            <option value="1" <?php if ($_smarty_tpl->tpl_vars['_GET']->value['type']==1) {?>selected<?php }?>>支出</option>
            <option value="2" <?php if ($_smarty_tpl->tpl_vars['_GET']->value['type']==2) {?>selected<?php }?>>收入</option>
        </select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>日期段</label>
        <input type="text" name="startTime" class="time_input" readonly value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['startTime'];?>
">
    </div>
    <div style="float:left;margin-right:5px">
        <label>至</label>
        <input type="text" name="endTime" class="time_input" readonly value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['endTime'];?>
">
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">财务列表</a>
    <div id="page-stats" class="block-body collapse in">
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>类型</th>
                <th>收支类型</th>
                <th>对象</th>
                <th>公司</th>
                <th>日期</th>
                <th>金额</th>
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
                    <td><input type="checkbox" data-name="financeId" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['financeId'];?>
"></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['typeDesc'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['cateDesc'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['targetName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['companyName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['createTime'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['money'];?>
</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>


<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
