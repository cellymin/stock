<?php /* Smarty version Smarty-3.1.15, created on 2017-11-03 14:26:13
         compiled from "D:\wwwroot\jxc.com\erp\include\template\charts\return.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1415659fc0c05b90364-05169984%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84088e4904b8b5402e1ecc128fbdfb55fa485cd0' => 
    array (
      0 => 'D:\\wwwroot\\jxc.com\\erp\\include\\template\\charts\\return.tpl',
      1 => 1507771877,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1415659fc0c05b90364-05169984',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'company_options' => 0,
    '_GET' => 0,
    'list' => 0,
    't' => 0,
    'li' => 0,
    'g' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fc0c05ca5926_44347097',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fc0c05ca5926_44347097')) {function content_59fc0c05ca5926_44347097($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wwwroot\\jxc.com\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<style>
    table tbody tr:last-child{ font-weight: 700;font-size: 14px;color: #000}
</style>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">


    <div style="float:left;margin-right:5px">
        <label>选择公司</label>
        <?php echo smarty_function_html_options(array('name'=>'companyId','id'=>"companyId",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['company_options']->value,'selected'=>$_smarty_tpl->tpl_vars['_GET']->value['companyId']),$_smarty_tpl);?>

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
    <a href="#page-stats" class="block-heading" data-toggle="collapse">领用汇总表</a>
    <div id="page-stats" class="block-body collapse in">
        <table class="table table-striped" border="1" id="data_list">
            <thead>
            <tr>
                <td>部门\项目</td>
                <?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['total']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value) {
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
                <td><?php echo $_smarty_tpl->tpl_vars['t']->value['cateName'];?>
</td>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php  $_smarty_tpl->tpl_vars['li'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['li']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['li']->key => $_smarty_tpl->tpl_vars['li']->value) {
$_smarty_tpl->tpl_vars['li']->_loop = true;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['li']->value['departmentName'];?>
</td>
                <?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['g']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['li']->value['goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value) {
$_smarty_tpl->tpl_vars['g']->_loop = true;
?>
                <td><?php echo $_smarty_tpl->tpl_vars['g']->value['money'];?>
</td>
                <?php } ?>
            </tr>
            <?php } ?>
            <tr>
                <td>合计</td>
                <?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['total']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value) {
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
                <td><?php echo $_smarty_tpl->tpl_vars['t']->value['money'];?>
</td>
                <?php } ?>
            </tr>
            </tbody>

        </table>
    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>


<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
