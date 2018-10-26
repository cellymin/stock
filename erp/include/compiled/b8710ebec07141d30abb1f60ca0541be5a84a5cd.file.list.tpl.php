<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 10:24:41
         compiled from "D:\wwwroot\erp\include\template\order\list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:954959fd24e9b422c8-23550722%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8710ebec07141d30abb1f60ca0541be5a84a5cd' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\order\\list.tpl',
      1 => 1508307188,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '954959fd24e9b422c8-23550722',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'type' => 0,
    'create_url' => 0,
    'details_url' => 0,
    '_GET' => 0,
    'content_header' => 0,
    'delete_url' => 0,
    'list' => 0,
    'value' => 0,
    'page_html' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd24e9ccb039_40882368',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd24e9ccb039_40882368')) {function content_59fd24e9ccb039_40882368($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<form class="form_search" action="" method="GET" style="margin-bottom:0px">
    <div class="btn-toolbar" style="float:right;padding-top:15px;">
        <?php if (($_smarty_tpl->tpl_vars['type']->value!='OTHER_IN'&&$_smarty_tpl->tpl_vars['type']->value!='OTHER_OUT')) {?>
        <a class="btn btn-primary layerModel" action="1" title="新增订单" layerUrl="<?php echo $_smarty_tpl->tpl_vars['create_url']->value;?>
" layerW="500px"
           layerH="400px" layerT="2"><i class="icon-plus"></i> 新增</a>
        <?php }?>
        <a class="btn btn-primary layerModel" action="2" title="订单详情" layerUrl="<?php echo $_smarty_tpl->tpl_vars['details_url']->value;?>
" layerW="1000px"
           layerH="660px" layerT="2"><i class="icon-pencil"></i> 修改</a>
        <?php if (($_smarty_tpl->tpl_vars['type']->value!='OTHER_IN'&&$_smarty_tpl->tpl_vars['type']->value!='OTHER_OUT')) {?>
        <a class="btn btn-primary layerModel" action="3" title="订单删除"><i class="icon-trash"></i> 删除</a>
        <?php }?>
    </div>

    <div style="float:left;margin-right:5px">
        <label>选择状态</label>
        <select name="status" id="">
            <option value="0"<?php if ($_smarty_tpl->tpl_vars['_GET']->value['status']==0) {?>selected<?php }?>>全部</option>
            <?php if (($_smarty_tpl->tpl_vars['type']->value!='OTHER_IN'&&$_smarty_tpl->tpl_vars['type']->value!='OTHER_OUT')) {?>
            <option value="1"<?php if ($_smarty_tpl->tpl_vars['_GET']->value['status']==1) {?>selected<?php }?>>未提交</option>
            <?php }?>
            <option value="2"<?php if ($_smarty_tpl->tpl_vars['_GET']->value['status']==2) {?>selected<?php }?>>待审核</option>
            <option value="3"<?php if ($_smarty_tpl->tpl_vars['_GET']->value['status']==3) {?>selected<?php }?>>审核未通过</option>
            <option value="4"<?php if ($_smarty_tpl->tpl_vars['_GET']->value['status']==4) {?>selected<?php }?>>审核通过</option>
        </select>
    </div>
    <div style="float:left;margin-right:5px">
        <label>查询所有请留空</label>
        <input type="text" name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['keyword'];?>
" placeholder="输入单号">
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse"><?php echo $_smarty_tpl->tpl_vars['content_header']->value['menu_name'];?>
列表</a>
    <div id="page-stats" class="block-body collapse in">
        <form action="<?php echo $_smarty_tpl->tpl_vars['delete_url']->value;?>
.php" method="post">
            <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
            <table class="table table-striped" id="data_list">
                <thead>
                <tr>
                    <th><input type="checkbox" id="chkAll"></th>
                    <th>单号</th>
                    <?php if (in_array($_smarty_tpl->tpl_vars['type']->value,array('PLAN','ARRIVAL','RETURN','PURCHASE_IN'))) {?>
                    <th>供应商</th>
                    <?php } elseif (in_array($_smarty_tpl->tpl_vars['type']->value,array('ALLOT_IN','ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT'))) {?>
                    <th>仓库</th>
                    <?php } else { ?>
                    <th>客户</th>
                    <?php }?>
                    <th>操作人员</th>
                    <th>时间</th>
                    <th>备注</th>
                    <th>总额</th>
                    <th>产品总数</th>
                    <th>状态</th>
                    <th>审核备注</th>
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
                        <td><input data-name="orderId" name="orderId[]" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['orderId'];?>
" type="checkbox"></td>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['orderNo'];?>
</td>
                        <?php if (in_array($_smarty_tpl->tpl_vars['type']->value,array('PLAN','ARRIVAL','RETURN','PURCHASE_IN'))) {?>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['supplierName'];?>
</td>
                        <?php } elseif (in_array($_smarty_tpl->tpl_vars['type']->value,array('ALLOT_IN','ALLOT_OUT','USE_OUT','INVENTORY','OTHER_IN','OTHER_OUT'))) {?>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['depotName'];?>
</td>
                        <?php } else { ?>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['customerName'];?>
</td>
                        <?php }?>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['user_name'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['createTime'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['remark'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['totalMoney'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['totalCnt'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['status'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['value']->value['reviewerMemo'];?>
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
