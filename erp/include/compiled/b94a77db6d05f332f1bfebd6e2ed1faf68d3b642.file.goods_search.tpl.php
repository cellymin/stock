<?php /* Smarty version Smarty-3.1.15, created on 2017-11-03 13:19:31
         compiled from "D:\wwwroot\jxc.com\erp\include\template\storage\goods_search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1501459fbfc63897d78-35732602%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b94a77db6d05f332f1bfebd6e2ed1faf68d3b642' => 
    array (
      0 => 'D:\\wwwroot\\jxc.com\\erp\\include\\template\\storage\\goods_search.tpl',
      1 => 1504882579,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1501459fbfc63897d78-35732602',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_GET' => 0,
    'goodsCate' => 0,
    'v' => 0,
    'depotSubs' => 0,
    'depotSubId' => 0,
    'orderAddUrl' => 0,
    'list' => 0,
    'value' => 0,
    'page_html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fbfc63a87f07_09216440',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fbfc63a87f07_09216440')) {function content_59fbfc63a87f07_09216440($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wwwroot\\jxc.com\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form class="form_search" action="" method="GET" style="margin-bottom:0px;float: left;">
        <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['type'];?>
">
        <input type="hidden" name="orderId" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['orderId'];?>
">
        <?php if (!in_array($_smarty_tpl->tpl_vars['_GET']->value['type'],array('ALLOT_OUT','USE_OUT','INVENTORY'))) {?>
        <div style="float:left;margin-right:5px">
            <select name="goodsCateId" id="" style="width: 130px">
                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['goodsCate']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['cateId'];?>
" <?php if ($_smarty_tpl->tpl_vars['_GET']->value['goodsCateId']==$_smarty_tpl->tpl_vars['v']->value['cateId']) {?>selected<?php }?>>
                <?php if ($_smarty_tpl->tpl_vars['v']->value['level']>1) {?>
                |<?php echo str_repeat('-',$_smarty_tpl->tpl_vars['v']->value['level']);?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['v']->value['cateName'];?>

                <?php } else { ?>
                <?php echo $_smarty_tpl->tpl_vars['v']->value['cateName'];?>

                <?php }?>
                </option>
                <?php } ?>
            </select>
        </div>
        <?php } else { ?>
        <div style="float:left;margin-right:5px">
            <?php echo smarty_function_html_options(array('name'=>'depotSubId','id'=>"DropDownTimezone",'required'=>"true",'options'=>$_smarty_tpl->tpl_vars['depotSubs']->value,'selected'=>$_smarty_tpl->tpl_vars['depotSubId']->value),$_smarty_tpl);?>

        </div>

        <?php }?>

        <div style="float:left;margin-right:5px">
            <input type="text" name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['keyword'];?>
" placeholder="输入货号,助记词,产品名称"
                   style="width: 160px;">
        </div>
        <div class="btn-toolbar" style="padding-bottom:0px;margin-top:0px;margin-bottom:0px;float: left">
            <button type="submit" class="btn btn-primary"><i class="icon-search"></i></button>
        </div>
        <div style="clear:both;"></div>
    </form>
    <div class="btn-toolbar" style="padding-bottom:0px;margin-top:0px;margin-bottom:0px;float: right">
        <button type="submit" class="btn btn-primary layerModel" action="2" title="登记商品" layerUrl="<?php echo $_smarty_tpl->tpl_vars['orderAddUrl']->value;?>
"
                layerW="450px" layerH="550px" layerT="2" layerD="orderId=<?php echo $_smarty_tpl->tpl_vars['_GET']->value['orderId'];?>
"><i class="icon-plus"></i> 登记
        </button>
   
    </div>
    <div>
        <?php if (!in_array($_smarty_tpl->tpl_vars['_GET']->value['type'],array('ALLOT_OUT','USE_OUT','INVENTORY'))) {?>
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>名称</th>
                <th>规格</th>
                <th>单位</th>
                <th>上次进价</th>
                <th>最低进价</th>
                <th>最高进价</th>
                <th>平均进价</th>
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
                    <td><input data-name="goodsId" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['goodsId'];?>
" type="checkbox"></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['goodsName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['goodsSpec'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['unitName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['lastPrice'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['minPrice'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['maxPrice'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['avgPrice'];?>
</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <th>#</th>
                <th>名称</th>
                <th>批次号</th>
                <th>仓库</th>
                <th>库位</th>
                <th>数量</th>
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
                    <td><input data-name="id" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" type="checkbox"></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['goodsName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['batchNo'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['depotName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['depotSubName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['goodsCnt'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['value']->value['createTime'];?>
</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php }?>
        <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

    </div>
</div>
<?php }} ?>
