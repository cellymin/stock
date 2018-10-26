<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 11:33:18
         compiled from "D:\wwwroot\erp\include\template\message\storage_setting.tpl" */ ?>
<?php /*%%SmartyHeaderCode:836059fd34fe2d1b94-28282904%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd994ba3b2314921cfea893b1d9a73139ec03d6c3' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\message\\storage_setting.tpl',
      1 => 1504768260,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '836059fd34fe2d1b94-28282904',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'depot_options' => 0,
    '_GET' => 0,
    'depotSub_options' => 0,
    'goods_cates' => 0,
    'value' => 0,
    'goods_options' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd34fe366498_71505077',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd34fe366498_71505077')) {function content_59fd34fe366498_71505077($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wwwroot\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="form_div">
    <form action="storage_setting.php" method="post">
        <table width="100%">
            <tbody>
            <tr>
                <td width="120">仓库</td>
                <td>
                    <?php echo smarty_function_html_options(array('name'=>'depotId','id'=>"depot",'options'=>$_smarty_tpl->tpl_vars['depot_options']->value,'selected'=>$_smarty_tpl->tpl_vars['_GET']->value['depotId']),$_smarty_tpl);?>

                </td>
            </tr>
            <tr>
                <td>库位</td>
                <td>
                    <?php echo smarty_function_html_options(array('name'=>'depotSubId','id'=>"depotSub",'options'=>$_smarty_tpl->tpl_vars['depotSub_options']->value,'selected'=>$_smarty_tpl->tpl_vars['_GET']->value['depotSubId']),$_smarty_tpl);?>

                </td>
            </tr>
            <tr>
                <td>分类</td>
                <td>
                    <select name="goodsCateId" id="goodsCateId">
                        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['goods_cates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value['cateId'];?>
" <?php if ($_smarty_tpl->tpl_vars['_GET']->value['goodsCateId']==$_smarty_tpl->tpl_vars['value']->value['cateId']) {?>selected<?php }?> data-num="<?php echo $_smarty_tpl->tpl_vars['value']->value['level'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['cateName'];?>
</option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>商品</td>
                <td>
                    <?php echo smarty_function_html_options(array('name'=>'goodsId','id'=>"goodsId",'options'=>$_smarty_tpl->tpl_vars['goods_options']->value,'selected'=>$_smarty_tpl->tpl_vars['_GET']->value['goodsId']),$_smarty_tpl);?>

                </td>
            </tr>
            <tr>
                <td>最小预警库存</td>
                <td>
                    <input type="number" id="minWarnNum" placeholder="1" name="minWarnNum" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['minWarnNum'];?>
">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="hidden" name="nonceStr" value="<?php echo $_smarty_tpl->tpl_vars['nonceStr']->value;?>
">
                    <button type="submit" class="btn btn-primary">保存</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        $('#goodsCateId option').each(function(){
            var count = Number($(this).attr('data-num'));
            var cateName = $(this).text();
            var str = '|';
            if(count>1){
                for(var i=1; i<count; i++){
                    str += '--';
                }
                $(this).html(str + " " + cateName);
            }
        });

        $("#depot").change(function () {
            var depotId = $(this).val();
            var goodsCateId = $('#goodsCateId').val();
            var goodsId = $('#goodsId').val();
            var minWarnNum = $('#minWarnNum').val();

            location.href = 'storage_setting.php?depotId='+depotId+'&goodsCateId='+goodsCateId+'&goodsId='+goodsId+'&minWarnNum='+minWarnNum
        });

        $("#goodsCateId").change(function () {
            var depotId = $('#depot').val();
            var depotSubId = $('#depotSub').val();
            var goodsCateId = $(this).val();
            var minWarnNum = $('#minWarnNum').val();

            location.href = 'storage_setting.php?depotId='+depotId+'&goodsCateId='+goodsCateId+'&depotSubId='+depotSubId+'&minWarnNum='+minWarnNum
        })
    })
</script><?php }} ?>
