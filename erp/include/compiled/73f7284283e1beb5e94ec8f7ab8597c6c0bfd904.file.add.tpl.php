<?php /* Smarty version Smarty-3.1.15, created on 2017-11-18 14:58:32
         compiled from "D:\wwwroot\erp\include\template\sales\add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:316495a0fda18d6daa0-62075988%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '73f7284283e1beb5e94ec8f7ab8597c6c0bfd904' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\sales\\add.tpl',
      1 => 1508298794,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '316495a0fda18d6daa0-62075988',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'goods' => 0,
    '_GET' => 0,
    'orderId' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5a0fda18dac0a4_86402140',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a0fda18dac0a4_86402140')) {function content_5a0fda18dac0a4_86402140($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<div class="form_div">
    <form method="post" action="add.php">
        <table>
            <tbody>
            <tr>
                <td width="100">商品</td>
                <td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsName'];?>
" readonly></td>
            </tr>
            <tr>
                <td>数量</td>
                <td><input name="goodsCnt" type="text" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['goodsCnt'];?>
" required></td>
            </tr>
            <tr>
                <td>价格</td>
                <td><input name="goodsPrice" type="text" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['goodsPrice'];?>
" required></td>
            </tr>
            <tr>
                <td>备注</td>
                <td><textarea name="remark" id="" cols="30" rows="5" style="resize: none"><?php echo $_smarty_tpl->tpl_vars['_GET']->value['remark'];?>
</textarea></td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="orderId" value="<?php echo $_smarty_tpl->tpl_vars['orderId']->value;?>
">
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['id'];?>
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
<script type="text/javascript">

</script>

<?php }} ?>
