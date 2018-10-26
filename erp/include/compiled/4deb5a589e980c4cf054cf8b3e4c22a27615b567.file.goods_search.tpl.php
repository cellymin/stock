<?php /* Smarty version Smarty-3.1.15, created on 2017-11-18 14:58:00
         compiled from "D:\wwwroot\erp\include\template\sales\goods_search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:34875a0fd9f8768591-63378353%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4deb5a589e980c4cf054cf8b3e4c22a27615b567' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\sales\\goods_search.tpl',
      1 => 1508298370,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34875a0fd9f8768591-63378353',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_GET' => 0,
    'depots' => 0,
    'index' => 0,
    'd' => 0,
    'orderAddUrl' => 0,
    'list' => 0,
    'value' => 0,
    'page_html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5a0fd9f883c413_49913953',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a0fd9f883c413_49913953')) {function content_5a0fd9f883c413_49913953($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form class="form_search" action="" method="GET" style="margin-bottom:0px;float: left;">
        <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['type'];?>
">
        <input type="hidden" name="orderId" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['orderId'];?>
">
        <div style="float:left;margin-right:5px">
            <select name="depotId" id="depotId" style="width: 130px">
                <?php  $_smarty_tpl->tpl_vars['d'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['d']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['depots']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['d']->key => $_smarty_tpl->tpl_vars['d']->value) {
$_smarty_tpl->tpl_vars['d']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['d']->key;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['_GET']->value['depotId']==$_smarty_tpl->tpl_vars['index']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['d']->value;?>
</option>
                <?php } ?>
            </select>
            <select name="depotSubId" id="depotSubId" style="width: 130px">
            </select>
        </div>

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
                layerW="450px" layerH="400px" layerT="2" layerD="orderId=<?php echo $_smarty_tpl->tpl_vars['_GET']->value['orderId'];?>
"><i class="icon-plus"></i> 登记
        </button>
   
    </div>
    <div>
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
        <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

    </div>
</div>
<script>
    var depotId = '<?php echo $_smarty_tpl->tpl_vars['_GET']->value['depotId'];?>
';
    var depotSubId = '<?php echo $_smarty_tpl->tpl_vars['_GET']->value['depotSubId'];?>
';
    var isCheck = '';
    $(function () {
        if(depotId!=0)
            getGoods('<?php echo $_smarty_tpl->tpl_vars['_GET']->value['depotId'];?>
');
    });
    $('#depotId').on('change',function () {
        $("#depotSubId").html('');
        var id  = $(this).val();
        if(id!=0){
            getGoods(id);
        }
    });
    function getGoods(id) {
        $.post('goods_search.php',{depotId:id},function (e) {
            if(e){
                $.each(e,function (i,v) {
                    isCheck = '';
                    if(i==depotSubId)
                        isCheck = 'selected';
                    $("#depotSubId").append('<option value="'+i+'" '+isCheck+'>'+v+'</option>');
                })
            }
        },'json');
    }
</script>
<?php }} ?>
