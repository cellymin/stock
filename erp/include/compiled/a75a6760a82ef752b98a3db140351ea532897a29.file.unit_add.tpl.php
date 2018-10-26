<?php /* Smarty version Smarty-3.1.15, created on 2017-11-23 15:37:09
         compiled from "D:\wwwroot\erp\include\template\sys\unit_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3195259fd318c17f885-94603998%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a75a6760a82ef752b98a3db140351ea532897a29' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\sys\\unit_add.tpl',
      1 => 1511421064,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3195259fd318c17f885-94603998',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd318c19da18_96528798',
  'variables' => 
  array (
    '_POST' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd318c19da18_96528798')) {function content_59fd318c19da18_96528798($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<div class="form_div">

            <form id="form_data" method="post" action="">
                <table width="80%">
                    <tr>
                        <td><b>计量单位</b></td>
                        <td>
                            <input type="text" name="unitName" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['unitName'];?>
"  required="true" autofocus="true">
                        </td>
                    </tr>
                    <tr>
                        <td><b>单位编号</b></td>
                        <td>
                            <input type="text" name="unitNo" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['unitNo'];?>
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
