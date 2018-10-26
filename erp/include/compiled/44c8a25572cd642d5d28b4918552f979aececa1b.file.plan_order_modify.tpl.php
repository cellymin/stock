<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 10:50:15
         compiled from "D:\wwwroot\erp\include\template\purchase\plan_order_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:318059fd2ae7e8f832-04925498%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44c8a25572cd642d5d28b4918552f979aececa1b' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\purchase\\plan_order_modify.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '318059fd2ae7e8f832-04925498',
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
  'unifunc' => 'content_59fd2ae7ed81f3_19837327',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd2ae7ed81f3_19837327')) {function content_59fd2ae7ed81f3_19837327($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<div class="form_div">
    <form method="post" action="plan_order_modify.php">
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
                <td>计划到货日期</td>
                <td><input readonly name="arrivalTime" type="text" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['arrivalTime'];?>
" class="time_input" required></td>
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
