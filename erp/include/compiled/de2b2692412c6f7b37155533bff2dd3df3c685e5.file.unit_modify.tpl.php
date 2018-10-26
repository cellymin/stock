<?php /* Smarty version Smarty-3.1.15, created on 2017-11-23 15:37:46
         compiled from "D:\wwwroot\erp\include\template\sys\unit_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3136459fd31a3bb6aa8-24273038%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de2b2692412c6f7b37155533bff2dd3df3c685e5' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\sys\\unit_modify.tpl',
      1 => 1511421345,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3136459fd31a3bb6aa8-24273038',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd31a3bdf343_08648880',
  'variables' => 
  array (
    'unit' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd31a3bdf343_08648880')) {function content_59fd31a3bdf343_08648880($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<div class="form_div">
            <form id="form_data" method="post" action="">
            	<input type="hidden" name="unitId" value="<?php echo $_smarty_tpl->tpl_vars['unit']->value['unitId'];?>
">
                <table width="80%">
                    <tr>
                        <td><b>计量单位</b></td>
                        <td>
                            <input type="text" name="unitName" value="<?php echo $_smarty_tpl->tpl_vars['unit']->value['unitName'];?>
"  required="true" autofocus="true">
                        </td>
                    </tr>
                    <tr>
                        <td><b>单位编号</b></td>
                        <td>
                            <input type="text" name="unitNo" value="<?php echo $_smarty_tpl->tpl_vars['unit']->value['unitNo'];?>
"  required="true" autofocus="true">
                        </td>
                    </tr>
                    <tr>
                        <td><b></b></td>
                        <td>
                            <div class="btn-toolbar">
                                <input type="hidden" name="nonceStr" value="<?php echo $_smarty_tpl->tpl_vars['nonceStr']->value;?>
">
                                <button type="submit" class="btn btn-primary"><strong>保存</strong></button>
                            </div>
                        </td>
                    </tr>

                </table>
            </form>

</div>
<?php }} ?>
