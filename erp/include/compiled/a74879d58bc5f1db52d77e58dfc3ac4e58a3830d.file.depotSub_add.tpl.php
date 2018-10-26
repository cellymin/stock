<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 11:00:55
         compiled from "D:\wwwroot\erp\include\template\sys\depotSub_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1741859fd2d6799b0b4-63991684%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a74879d58bc5f1db52d77e58dfc3ac4e58a3830d' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\sys\\depotSub_add.tpl',
      1 => 1507785830,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1741859fd2d6799b0b4-63991684',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_GET' => 0,
    'company_options' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd2d679e3278_80453988',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd2d679e3278_80453988')) {function content_59fd2d679e3278_80453988($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wwwroot\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->



<div class="form_div">
    <form id="form_data" method="post" action="">
        <table width="80%">
            <tr>
                <td><b>库位名称</b></td>
                <td>
                    <input type="text" name="depotSubName" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['depotSubName'];?>
"  required="true">
                </td>
            </tr>
            <tr>
                <td><b>库位编码</b></td>
                <td>
                    <input type="text" name="depotSubNo" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['depotSubNo'];?>
"  required="true">
                </td>
            </tr>
            <tr>
                <td><b>所属公司</b></td>
                <td><?php echo smarty_function_html_options(array('name'=>'companyId','id'=>"companyId",'options'=>$_smarty_tpl->tpl_vars['company_options']->value,'selected'=>$_smarty_tpl->tpl_vars['_GET']->value['companyId']),$_smarty_tpl);?>
</td>
            </tr>
            <tr>
                <td><b></b></td>
                <td>
                    <div class="btn-toolbar">
                        <input type="hidden" name="nonceStr" value="<?php echo $_smarty_tpl->tpl_vars['nonceStr']->value;?>
">
                        <input type="hidden" name="depotId" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['depotId'];?>
">
                        <button type="submit" class="btn btn-primary"><strong>保存</strong></button>
                    </div>
                </td>
            </tr>

        </table>
    </form>
</div>

<?php }} ?>
