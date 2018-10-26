<?php /* Smarty version Smarty-3.1.15, created on 2017-10-18 15:48:17
         compiled from "E:\wwwroot\jxc.com\erp\include\template\message\price.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1229959e707415f6aa7-61674106%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b8e5356cfd3a446c382ad58442ad62f89fdf739' => 
    array (
      0 => 'E:\\wwwroot\\jxc.com\\erp\\include\\template\\message\\price.tpl',
      1 => 1507790547,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1229959e707415f6aa7-61674106',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'list' => 0,
    'v' => 0,
    'page_html' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59e707416aa5d2_10489398',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e707416aa5d2_10489398')) {function content_59e707416aa5d2_10489398($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>



<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">列表</a>
    <div id="page-stats" class="block-body collapse in">
        <form method="post" action="">
            <table class="table table-striped" id="data_list">
                <thead>
                <tr>
                    <th>#</th>
                    <th>发送方</th>
                    <th>消息内容</th>
                    <th>所属公司</th>
                    <th>消息时间</th>
                </tr>
                </thead>
                <tbody>
                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                    <tr>
                        <td></td>
                        <td><?php if ($_smarty_tpl->tpl_vars['v']->value['fromUser']==0) {?>系统<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['v']->value['real_name'];?>
<?php }?></td>
                        <td>价格预警：商品:<?php echo $_smarty_tpl->tpl_vars['v']->value['content']['goodsName'];?>
,类型:<?php if ($_smarty_tpl->tpl_vars['v']->value['content']['type']=='up') {?>上涨<?php } else { ?>下跌<?php }?>,百分比:<?php echo $_smarty_tpl->tpl_vars['v']->value['content']['value'];?>
%</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['companyName'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['createTime'];?>
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
