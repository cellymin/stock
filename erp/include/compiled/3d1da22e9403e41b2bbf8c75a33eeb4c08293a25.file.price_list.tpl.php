<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 11:29:09
         compiled from "D:\wwwroot\erp\include\template\purchase\price_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2211259fd34051eb884-36067628%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3d1da22e9403e41b2bbf8c75a33eeb4c08293a25' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\purchase\\price_list.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2211259fd34051eb884-36067628',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'suppliers_options' => 0,
    'supplierId' => 0,
    'goodsId' => 0,
    'sortType' => 0,
    'list' => 0,
    'v' => 0,
    'page_html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd340526bb03_90780454',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd340526bb03_90780454')) {function content_59fd340526bb03_90780454($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wwwroot\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="form_div">
    <form class="form_search" action="" id="search" method="GET" style="margin-bottom:0px;">
        <div style="float:left;margin-right:5px">
            <?php echo smarty_function_html_options(array('name'=>'supplierId','id'=>"supplierId",'required'=>"true",'options'=>$_smarty_tpl->tpl_vars['suppliers_options']->value,'selected'=>$_smarty_tpl->tpl_vars['supplierId']->value),$_smarty_tpl);?>

        </div>
        <div class="btn-toolbar" style="padding-bottom:0px;margin-bottom:0px">
            <button type="submit" class="btn btn-primary">检索</button>
        </div>
        <input type="hidden" name="goodsId" value="<?php echo $_smarty_tpl->tpl_vars['goodsId']->value;?>
">
        <input type="hidden" name="sortType" value="<?php echo $_smarty_tpl->tpl_vars['sortType']->value;?>
">
        <div style="clear:both;"></div>
    </form>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>供应商</th>
            <th>联系方式</th>
            <th>采购时间</th>
            <th>数量</th>
            <th>价格 <i class="<?php if ($_smarty_tpl->tpl_vars['sortType']->value=='desc') {?>icon-arrow-down<?php } else { ?>icon-arrow-up<?php }?> sortType"></i></th>
        </tr>
        </thead>
        <tbody>
        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['supplierName'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['supplierTel'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['createTime'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['goodsCnt'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['goodsPrice'];?>
</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

</div>
<script>
    $('.sortType').click( function () {
        var type = 'asc';
        if($(this).hasClass('icon-arrow-up')){
            type = 'desc';
        }
        $("input[name=sortType]").val(type);
        $("#search").submit();
    })
</script><?php }} ?>
