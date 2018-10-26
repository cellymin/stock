<?php /* Smarty version Smarty-3.1.15, created on 2017-11-03 15:07:33
         compiled from "D:\wwwroot\jxc.com\erp\include\template\message\storage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3180059fc15b5a43915-74058262%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4888098bb8cda943cdcf42587b7e7b780c5aba22' => 
    array (
      0 => 'D:\\wwwroot\\jxc.com\\erp\\include\\template\\message\\storage.tpl',
      1 => 1507790585,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3180059fc15b5a43915-74058262',
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
  'unifunc' => 'content_59fc15b5b74468_27989478',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fc15b5b74468_27989478')) {function content_59fc15b5b74468_27989478($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

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
                    <td><?php if ($_smarty_tpl->tpl_vars['v']->value['fromUser']==0) {?>系统<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['v']->value['realName'];?>
<?php }?></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['content'];?>
</td>
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
