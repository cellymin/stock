<?php /* Smarty version Smarty-3.1.15, created on 2017-11-02 17:03:53
         compiled from "E:\wwwroot\jxc.com\erp\include\template\finance\finance_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2452659fadf79709901-36813102%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36e788988b3d3333e57c0fa8e4656dec0f0bd1f6' => 
    array (
      0 => 'E:\\wwwroot\\jxc.com\\erp\\include\\template\\finance\\finance_add.tpl',
      1 => 1508234831,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2452659fadf79709901-36813102',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'invoiceId' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fadf7977ec02_34442390',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fadf7977ec02_34442390')) {function content_59fadf7977ec02_34442390($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form id="" method="post" action="" enctype="multipart/form-data">
        <table width="100%" class="table">
            <tr>
                <td width="150" colspan="1">类型</td>
                <td colspan="3">
                    <select name="type" id="">
                        <option value="1">收入</option>
                        <option value="2">支出</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="150" colspan="1">发票类型</td>
                <td colspan="3">
                    <select name="cate" id="" >
                        <option value="">请选择</option>
                        <option value="1">水费</option>
                        <option value="2">电费</option>
                        <option value="3">物流</option>
                        <option value="4">工资</option>
                        <option value="5">餐饮</option>
                        <option value="6">配送</option>
                        <option value="7">社保</option>
                        <option value="10">固定资产</option>
                        <option value="0">其他</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="1">合计金额</td>
                <td colspan="3">
                    <input type="text" name="money">
                </td>
            </tr>
            <tr>
                <td colspan="1">备注</td>
                <td colspan="3">
                    <textarea name="remark" id="" cols="50" style="width: 400px;resize: none" rows="5"></textarea>
                </td>
            </tr>
            <tr>
                <td><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['invoiceId']->value;?>
" name="invoiceId">
                </td>
                <td>
                    <input type="hidden" name="nonceStr" value="<?php echo $_smarty_tpl->tpl_vars['nonceStr']->value;?>
">
                    <button class="btn btn-primary" type="submit">提交</button>
                </td>
            </tr>
        </table>
    </form>
</div>
<script>


</script>

<?php }} ?>
