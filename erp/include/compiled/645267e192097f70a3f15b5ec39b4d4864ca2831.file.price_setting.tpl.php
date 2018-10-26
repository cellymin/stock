<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 11:33:39
         compiled from "D:\wwwroot\erp\include\template\message\price_setting.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1948859fd35131d0362-84407820%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '645267e192097f70a3f15b5ec39b4d4864ca2831' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\message\\price_setting.tpl',
      1 => 1504841216,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1948859fd35131d0362-84407820',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'goods_cates' => 0,
    'value' => 0,
    '_GET' => 0,
    'goods_options' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd351324cd65_62625682',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd351324cd65_62625682')) {function content_59fd351324cd65_62625682($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wwwroot\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="form_div">
    <form action="" method="post">
        <table width="100%">
            <tbody>
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
                <td>价格上涨预警百分比</td>
                <td>
                    <input type="text" id="upPercent" placeholder="0.00" name="upPercent" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['upPercent'];?>
">
                </td>
            </tr>
            <tr>
                <td>价格下跌预警百分比</td>
                <td>
                    <input type="text" id="downPercent" placeholder="0.00" name="downPercent" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['downPercent'];?>
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

        $("#goodsCateId").change(function () {
            var goodsCateId = $(this).val();
            var upPercent = $('#upPercent').val();
            var downPercent = $('#downPercent').val();

            location.href = 'price_setting.php?goodsCateId='+goodsCateId+'&upPercent='+upPercent+'&downPercent='+downPercent
        })
    })
</script><?php }} ?>
