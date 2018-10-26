<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 11:37:38
         compiled from "D:\wwwroot\erp\include\template\code\depotSub_preview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:400459fd360257bdd5-24973355%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79dcfd4708e55005a3b764e64cf099482e36e42d' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\code\\depotSub_preview.tpl',
      1 => 1509759872,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '400459fd360257bdd5-24973355',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'depotSub' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd36025a0104_39411287',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd36025a0104_39411287')) {function content_59fd36025a0104_39411287($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="form_div">
    <table id="barcode_preview" border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td style="text-align: center" id="print_area">
                <span style="font-size: 12px;display: block;margin: 0;">{$depotSub.depotSubName}</span>
                <img src="depotSub_preview.php?code=1&depotSubId=<?php echo $_smarty_tpl->tpl_vars['depotSub']->value['depotSubId'];?>
" alt="" >
            </td>
        </tr>
    </table>
    <button id="code_print" class="btn btn-primary" onclick="toPrint()">打印</button>
</div>
<script>

    function toPrint() {
        $("#print_area").print({
            //是否包含父文档的样式，默认为true
            globalStyles : true,
            //是否包含media='print'的链接标签。会被globalStyles选项覆盖，默认为false
            mediaPrint : false,
            //外部样式
            stylesheet : '<?php echo @constant('ADMIN_URL');?>
/assets/css/print.css',
            //Print in a hidden iframe
            iframe : true,
            //不想打印的元素的jQuery选择器
            noPrintSelector : ".avoid-this",
            //Add this at top
            prepend : '',
            //将内容添加到打印内容的后面
            append : '',
            //回调方法
            deferred: $.Deferred().done(function() {
                console.log('Printing done', arguments);
                $('.pageHead').hide();
            })
        });
    }
</script>
<?php }} ?>
