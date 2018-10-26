<?php /* Smarty version Smarty-3.1.15, created on 2017-12-07 11:11:27
         compiled from "D:\wwwroot\erp\include\template\purchase\arrival_order_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104865a28b15fe76dc6-88481405%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ab4302f9035b507f97ad683584e75710df1854f9' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\purchase\\arrival_order_modify.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104865a28b15fe76dc6-88481405',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'goods' => 0,
    'orderId' => 0,
    'id' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5a28b15febb7f8_73738780',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a28b15febb7f8_73738780')) {function content_5a28b15febb7f8_73738780($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<div class="form_div">
    <form method="post" action="arrival_order_modify.php">
        <table>
            <tbody>
            <tr>
                <td>商品</td>
                <td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsName'];?>
" readonly></td>
            </tr>
            <tr>
                <td>数量</td>
                <td><input name="goodsCnt" type="text" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsCnt'];?>
" required></td>
            </tr>
            <tr>
                <td>价格</td>
                <td><input name="goodsPrice" type="text" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsPrice'];?>
" required></td>
            </tr>
            <tr>
                <td>备注</td>
                <td><textarea name="remark" id="" cols="30" rows="5" style="resize: none"><?php echo $_smarty_tpl->tpl_vars['goods']->value['remark'];?>
</textarea></td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="orderId" value="<?php echo $_smarty_tpl->tpl_vars['orderId']->value;?>
">
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
                    <input type="hidden" name="nonceStr" value="<?php echo $_smarty_tpl->tpl_vars['nonceStr']->value;?>
">
                </td>
                <td>
                    <button class="btn btn-primary">登记</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

<?php }} ?>
