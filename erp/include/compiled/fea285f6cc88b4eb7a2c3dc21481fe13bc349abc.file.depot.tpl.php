<?php /* Smarty version Smarty-3.1.15, created on 2017-11-03 08:53:35
         compiled from "D:\wwwroot\jxc.com\erp\include\template\sys\depot.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2816459fbbe0f5dd745-70036829%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fea285f6cc88b4eb7a2c3dc21481fe13bc349abc' => 
    array (
      0 => 'D:\\wwwroot\\jxc.com\\erp\\include\\template\\sys\\depot.tpl',
      1 => 1507785773,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2816459fbbe0f5dd745-70036829',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    '_GET' => 0,
    'list' => 0,
    'depot' => 0,
    'index' => 0,
    'depotSubs' => 0,
    'v' => 0,
    'g' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fbbe0f6eee48_18117310',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fbbe0f6eee48_18117310')) {function content_59fbbe0f6eee48_18117310($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <a  class="btn btn-primary layerModel" action="1" title="新增仓库" layerUrl="depot_add" layerW="400px" layerH="420px" layerT="2"><i class="icon-plus"></i> 新增</a>
        <a  class="btn btn-primary layerModel" action="2" title="修改仓库" layerUrl="depot_modify" layerW="400px" layerH="420px" layerT="2"><i class="icon-pencil"></i> 编辑</a>
        <a class="btn btn-primary layerModel" action="3" title="删除仓库" ><i class="icon-trash"></i> 删除</a>
    </div>

    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['keyword'];?>
" placeholder="输入名称" >
        <input type="hidden" name="search" value="1" >
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
    </div>
    <div style="clear:both;"></div>
</form>


<div class="well" >
    <form action="depot_del.php" method="post">
        <ul class="nav nav-tabs" id="data_list">
            <?php  $_smarty_tpl->tpl_vars['depot'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['depot']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['depot']->key => $_smarty_tpl->tpl_vars['depot']->value) {
$_smarty_tpl->tpl_vars['depot']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['depot']->key;
?>
                <li class="<?php if (($_smarty_tpl->tpl_vars['_GET']->value['depotId']==$_smarty_tpl->tpl_vars['depot']->value['depotId']||($_smarty_tpl->tpl_vars['_GET']->value['depotId']==0&&$_smarty_tpl->tpl_vars['index']->value==0))) {?>active<?php }?>">
                    <a href="depot.php?depotId=<?php echo $_smarty_tpl->tpl_vars['depot']->value['depotId'];?>
"><?php echo $_smarty_tpl->tpl_vars['depot']->value['depotName'];?>
</a>
                    <?php if (($_smarty_tpl->tpl_vars['_GET']->value['depotId']==$_smarty_tpl->tpl_vars['depot']->value['depotId']||($_smarty_tpl->tpl_vars['_GET']->value['depotId']==0&&$_smarty_tpl->tpl_vars['index']->value==0))) {?>
                    <input type="checkbox" name="depotId" checked style="display: none" data-name="depotId" value="<?php echo $_smarty_tpl->tpl_vars['depot']->value['depotId'];?>
">
                    <?php }?>
                </li>
            <?php } ?>
            <a style="float: right"  class="btn btn-primary layerModel" action="2" title="新增库位" layerUrl="depotSub_add" layerW="400px" layerH="300px" layerT="2"><i class="icon-plus"></i> 新增库位</a>
        </ul>
    </form>

    <div class="tab-content" id="depot_list">
        <ul>
            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['depotSubs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
            <li class="layerModel" action="2" title="库位详情" layerUrl="depotSub_goods" layerD="depotSubId=<?php echo $_smarty_tpl->tpl_vars['v']->value['depotSubId'];?>
" layerW="60%" layerH="70%" layerT="2">
                <span><?php echo $_smarty_tpl->tpl_vars['v']->value['depotSubName'];?>
</span>
                <div class="btn" >
                    <table width="100%">
                        <?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['g']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['v']->value['goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value) {
$_smarty_tpl->tpl_vars['g']->_loop = true;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['g']->value['goodsName'];?>
</td>
                            <td width="40%" align="right"><?php echo $_smarty_tpl->tpl_vars['g']->value['goodsCnt'];?>
</td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
<!---操作的确认层，相当于javascript:confirm函数--->
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>


<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
