<?php /* Smarty version Smarty-3.1.15, created on 2018-10-23 13:13:48
         compiled from "D:\phpPro\wwwroot\StockManager\erp\include\template\sys\employee.tpl" */ ?>
<?php /*%%SmartyHeaderCode:306415bceae0c388c95-07322720%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89b165076d71b51a0cc11beaf7587521fc7c6e72' => 
    array (
      0 => 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\template\\sys\\employee.tpl',
      1 => 1507772026,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '306415bceae0c388c95-07322720',
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
    'value' => 0,
    'page_html' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5bceae0c43fe43_41322861',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bceae0c43fe43_41322861')) {function content_5bceae0c43fe43_41322861($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a class="btn btn-primary layerModel" action="1" title="新增员工" layerUrl="employee_add" layerW="600px" layerH="500px" layerT="2"><i class="icon-plus"></i> 新增</a>
        <a class="btn btn-primary layerModel" action="2" title="修改员工" layerUrl="employee_modify" layerW="600px" layerH="500px" layerT="2"><i class="icon-pencil"></i> 编辑</a>
        <a class="btn btn-primary layerModel"  action="3"  title="删除员工"><i class="icon-trash"></i> 删除</a>
    </div>

    <div style="float:left;margin-right:5px">
        <label>选择公司</label>
        <?php echo smarty_function_html_options(array('name'=>'companyId','id'=>"DropDownTimezone",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['company_options']->value,'selected'=>$_smarty_tpl->tpl_vars['_GET']->value['companyId']),$_smarty_tpl);?>

    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['keyword'];?>
" placeholder="输入姓名" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>
<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">员工列表</a>
    <div id="page-stats" class="block-body collapse in">
    	<form method="post" action="employee_del.php">
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>公司</th>
                <th>部门</th>
                <th>员工姓名</th>
                <th>员工地址</th>
                <th>联系方式</th>
                <th>邮箱</th>
                <th>QQ</th>
                <th>职务</th>
                <th>公司名称</th>
                <th>部门名称</th>
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
                    <td><input type="checkbox" name="employeeId[]" data-name="employeeId" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['employeeId'];?>
"></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['companyId'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['departmentId'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['employeeName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['employeeAddress'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['employeePhone'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['employeeEmail'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['employeeQQ'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['employeeJob'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['companyName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['departmentName'];?>
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
