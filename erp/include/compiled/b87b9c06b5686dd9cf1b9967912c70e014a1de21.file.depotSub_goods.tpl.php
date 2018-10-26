<?php /* Smarty version Smarty-3.1.15, created on 2017-10-18 15:05:00
         compiled from "E:\wwwroot\jxc.com\erp\include\template\sys\depotSub_goods.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2173159e6fd1c4126b8-56185137%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b87b9c06b5686dd9cf1b9967912c70e014a1de21' => 
    array (
      0 => 'E:\\wwwroot\\jxc.com\\erp\\include\\template\\sys\\depotSub_goods.tpl',
      1 => 1507785804,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2173159e6fd1c4126b8-56185137',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'depotSub' => 0,
    '_GET' => 0,
    'list' => 0,
    'value' => 0,
    'page_html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59e6fd1c4e55e3_29115859',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e6fd1c4e55e3_29115859')) {function content_59e6fd1c4e55e3_29115859($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="form_div">
    <form class="form_search" action="" method="GET" style="margin-bottom:0px;">
        <div style="padding-top:0px;padding-bottom:0px;margin-bottom:0px;float: right">
            <a class="btn btn-primary layerModel" action="2" title="修改库位" layerUrl="depotSub_modify"
               layerD="depotId=<?php echo $_smarty_tpl->tpl_vars['depotSub']->value['depotId'];?>
" layerW="400px" layerH="300px" layerT="2"><i
                        class="icon-pencil"></i> 编辑</a>
            <a class="btn btn-primary layerModel" action="3"><i class="icon-trash"></i> 删除库位</a>
        </div>
        <div style="float:left;margin-right:5px">
            <input type="text" name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['keyword'];?>
" placeholder="输入批次号,产品名称">
            <input type="hidden" name="depotId" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['depotId'];?>
">
            <input type="hidden" name="depotSubId" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['depotSubId'];?>
">
        </div>
        <div class="btn-toolbar" style="padding-top:0px;padding-bottom:0px;margin-bottom:0px">
            <button type="submit" class="btn btn-primary"> 检索</button>
        </div>
        <div style="clear:both;"></div>
    </form>


    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">库位产品</a>
        <div id="page-stats" class="block-body collapse in">
            <form action="depotSub_del.php" method="post">
                <table class="table table-striped" id="data_list">
                    <thead>
                    <tr>
                        <th>#
                            <input type="checkbox" style="display: none;" name="depotSubId" data-name="depotSubId" checked value="<?php echo $_smarty_tpl->tpl_vars['depotSub']->value['depotSubId'];?>
">
                            <input type="hidden" name="depotId" value="<?php echo $_smarty_tpl->tpl_vars['depotSub']->value['depotId'];?>
">
                        </th>
                        <th>批次号</th>
                        <th>商品名称</th>
                        <th>商品数量</th>
                        <th>仓库</th>
                        <th>库位</th>
                        <th>入库时间</th>
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
                            <td></td>
                            <td><?php echo $_smarty_tpl->tpl_vars['value']->value['batchNo'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['value']->value['goodsName'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['value']->value['goodsCnt'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['value']->value['depotName'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['value']->value['depotSubName'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['value']->value['createTime'];?>
</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
            <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

        </div>
    </div>
</div>



<?php }} ?>
