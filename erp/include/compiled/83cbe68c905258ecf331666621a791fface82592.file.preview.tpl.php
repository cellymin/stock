<?php /* Smarty version Smarty-3.1.15, created on 2017-11-02 23:46:44
         compiled from "C:\wamp\www\jxc.com\erp\include\template\code\preview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1852359fb3de4796da6-60009701%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '83cbe68c905258ecf331666621a791fface82592' => 
    array (
      0 => 'C:\\wamp\\www\\jxc.com\\erp\\include\\template\\code\\preview.tpl',
      1 => 1506136646,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1852359fb3de4796da6-60009701',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'goods' => 0,
    'set' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fb3de497f743_87562787',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fb3de497f743_87562787')) {function content_59fb3de497f743_87562787($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<style>
    *{ margin: 0;padding: 0}
</style>
<div class="form_div">
    <div style="float: left;text-align: left">
        <img src="preview.php?code=1&goodsId=<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsId'];?>
" alt="">
        <label style="text-align: center">打印属性</label>
        <table cellpadding="5">
            <tr>
                <td></td>
            </tr>
            <tr>
                <td><span id="goodsSn" class="draggable"><?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsSn'];?>
</span><br></td>
            </tr>
            <tr>
                <td><span id="goodsName" class="draggable"><?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsName'];?>
</span><br></td>
            </tr>
            <tr>
                <td><span id="cateName" class="draggable"><?php echo $_smarty_tpl->tpl_vars['goods']->value['cateName'];?>
</span><br></td>
            </tr>
            <tr>
                <td><img src="preview.php?code=2&goodsId=<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsId'];?>
" alt="" id="goodsQRCode" class="draggable"></td>
            </tr>
            <tr>
                <td><img src="preview.php?code=1&goodsId=<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsId'];?>
" alt="" id="goodsBarCode" class="draggable"></td>
            </tr>
        </table>
    </div>
    <div style="float: right;text-align: center">
        <label style="text-align: center">打印区域 宽度: <font class="width">300</font>px</label>
        <div style="width: 300px;height: 400px;border: 1px solid #ccc;" id="printArea" >

        </div>
    </div>
    <button id="code_print" class="btn btn-primary" onclick="toPrint()">保存</button>
</div>
<script>

    window.onload = function() {
        var config = <?php echo $_smarty_tpl->tpl_vars['set']->value;?>
;
        $.each(config, function (i, v) {
            var ptop = $("#printArea").offset().top;
            var pleft = $("#printArea").offset().left;

            if(v.top!=0 && v.left!=0 && i!='printArea'){
                $("#printArea").append($('#'+i));
                var top = parseInt(ptop)+parseInt(v.offsetTop);
                var left = parseInt(pleft)+parseInt(v.offsetLeft);

                console.log(top);
                console.log(left);

                $('#'+i).offset({top:top,left:left})
            }
        });
    };

    $("#printArea").css({width:config.printArea});
    $('.width').text(config.printArea);

    function toPrint() {
        $("#printArea").print({
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
