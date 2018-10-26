<?php /* Smarty version Smarty-3.1.15, created on 2017-11-03 13:19:41
         compiled from "D:\wwwroot\jxc.com\erp\include\template\storage\allot_storage_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1559159fbfc6d5a2a46-99255688%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f92a25674d6a2b2a00a98b19e5451e6e0c3ed5d7' => 
    array (
      0 => 'D:\\wwwroot\\jxc.com\\erp\\include\\template\\storage\\allot_storage_add.tpl',
      1 => 1504681991,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1559159fbfc6d5a2a46-99255688',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'goods' => 0,
    'suppliers_options' => 0,
    'depotSubs_options' => 0,
    'orderId' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fbfc6d5f0c46_93938336',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fbfc6d5f0c46_93938336')) {function content_59fbfc6d5f0c46_93938336($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wwwroot\\jxc.com\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<div class="form_div">
    <form method="post" action="allot_storage_add.php">
        <table>
            <tbody>
            <tr>
                <td>商品</td>
                <td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsName'];?>
" readonly></td>
            </tr>
            <tr>
                <td>供应商</td>
                <td><?php echo smarty_function_html_options(array('name'=>'supplierId','id'=>"DropDownTimezone",'required'=>"true",'options'=>$_smarty_tpl->tpl_vars['suppliers_options']->value,'selected'=>0),$_smarty_tpl);?>
</td>
            </tr>
            <tr>
                <td>库位</td>
                <td><?php echo smarty_function_html_options(array('name'=>'depotSubId','id'=>"DropDownTimezone",'required'=>"true",'options'=>$_smarty_tpl->tpl_vars['depotSubs_options']->value,'selected'=>0),$_smarty_tpl);?>
</td>
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
