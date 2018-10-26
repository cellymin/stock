<?php /* Smarty version Smarty-3.1.15, created on 2017-10-20 09:19:01
         compiled from "E:\wwwroot\jxc.com\erp\include\template\purchase\plan_order_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1977459e94f056f2da1-92824250%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01407b40625ecbcfaae22d241bac11adbea76ec0' => 
    array (
      0 => 'E:\\wwwroot\\jxc.com\\erp\\include\\template\\purchase\\plan_order_add.tpl',
      1 => 1504681991,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1977459e94f056f2da1-92824250',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'goods' => 0,
    'orderId' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59e94f05719ea6_46804367',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e94f05719ea6_46804367')) {function content_59e94f05719ea6_46804367($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<div class="form_div">
    <form method="post" action="plan_order_add.php">
        <table>
            <tbody>
            <tr>
                <td>商品</td>
                <td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsName'];?>
" readonly></td>
            </tr>
            <tr>
                <td>数量</td>
                <td><input name="goodsCnt" type="text" required></td>
            </tr>
            <tr>
                <td>价格</td>
                <td><input name="goodsPrice" type="text" required></td>
            </tr>
            <tr>
                <td>计划到货日期</td>
                <td><input readonly name="arrivalTime" type="text" class="time_input" required></td>
            </tr>
            <tr>
                <td>备注</td>
                <td><textarea name="remark" id="" cols="30" rows="5" style="resize: none"></textarea></td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="orderId" value="<?php echo $_smarty_tpl->tpl_vars['orderId']->value;?>
">
                    <input type="hidden" name="goodsId" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsId'];?>
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
