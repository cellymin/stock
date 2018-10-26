<?php /* Smarty version Smarty-3.1.15, created on 2017-11-02 17:02:54
         compiled from "E:\wwwroot\jxc.com\erp\include\template\storage\purchase_storage_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:327359fadf3e8de505-99874240%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67952c4656ea0998296be43fc074284c6216fea8' => 
    array (
      0 => 'E:\\wwwroot\\jxc.com\\erp\\include\\template\\storage\\purchase_storage_add.tpl',
      1 => 1504681991,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '327359fadf3e8de505-99874240',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'goods' => 0,
    'depots_options' => 0,
    '_GET' => 0,
    'depotSubs_options' => 0,
    'orderId' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fadf3e9a1a06_43028830',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fadf3e9a1a06_43028830')) {function content_59fadf3e9a1a06_43028830($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'E:\\wwwroot\\jxc.com\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<div class="form_div">
    <form method="post" action="purchase_storage_add.php">
        <table>
            <tbody>
            <tr>
                <td>商品</td>
                <td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsName'];?>
" readonly></td>
            </tr>
            <tr>
                <td>仓库</td>
                <td><?php echo smarty_function_html_options(array('name'=>'depotId','id'=>"depotId",'required'=>"true",'options'=>$_smarty_tpl->tpl_vars['depots_options']->value,'selected'=>$_smarty_tpl->tpl_vars['_GET']->value['depotId']),$_smarty_tpl);?>
</td>
            </tr>
            <tr>
                <td>库位</td>
                <td><?php echo smarty_function_html_options(array('name'=>'depotSubId','id'=>"depotSubId",'required'=>"true",'options'=>$_smarty_tpl->tpl_vars['depotSubs_options']->value,'selected'=>0),$_smarty_tpl);?>
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
<script>
    $(function(){
        $('#depotId').change(function(){
            var depotId = $('#depotId').val();
            window.location.href = "purchase_storage_add.php?orderId=<?php echo $_smarty_tpl->tpl_vars['orderId']->value;?>
&goodsId=<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsId'];?>
&depotId="+depotId
        })
    })
</script>

<?php }} ?>
