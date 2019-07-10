<?php /* Smarty version Smarty-3.1.15, created on 2019-06-24 16:35:12
         compiled from "D:\WWW\stock\erp\include\template\finance\pay_invoice.tpl" */ ?>
<?php /*%%SmartyHeaderCode:33495d108b4089b0d9-41332765%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f48a47ebbc889e01d52c17aca1a0b1102c191a4' => 
    array (
      0 => 'D:\\WWW\\stock\\erp\\include\\template\\finance\\pay_invoice.tpl',
      1 => 1548156764,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '33495d108b4089b0d9-41332765',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'js_confirm' => 0,
    'invoiceInfo' => 0,
    'date' => 0,
    'v' => 0,
    'spanno' => 0,
    'orderNo' => 0,
    'goodsList' => 0,
    'iindex' => 0,
    'vv' => 0,
    'adjustpri' => 0,
    'invoiceId' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5d108b4094fe45_46494856',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d108b4094fe45_46494856')) {function content_5d108b4094fe45_46494856($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\WWW\\stock\\erp\\include\\config/../../include/lib/Smarty/plugins\\modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->tpl_vars['js_confirm']->value;?>

<div class="form_div">
    <div style="overflow: hidden" class="avoid-this">
        <button id="orderPrint" class="btn btn-primary" style="float: left;margin-bottom: 20px;"> 打印</button>
        <a type="button" class="btn btn-primary" onclick="method5('oorder')" style="margin-left: 10px;">导出</a>
    </div>
    <div style="clear:both;"></div>
    <div style="margin: 0 auto;">
        <table id="oorder" border="1" cellpadding="0" cellspacing="0"
               style="text-align: center; margin: 0 auto;width: 970px">
            <tr>
                <th style="border: none; text-align: right;">供应商ID:</th>
                <td style="border: none; text-align: left"><?php echo $_smarty_tpl->tpl_vars['invoiceInfo']->value['supplierId'];?>
</td>
                <th style="border: none; text-align: right" colspan="2">供应商名称:</th>
                <td style="border: none; text-align: left" colspan="3"><?php echo $_smarty_tpl->tpl_vars['invoiceInfo']->value['supplierName'];?>
</td>
                <th style="border: none; text-align: right">日期:</th>
                <td style="border: none; text-align: left"  colspan="2"><?php echo $_smarty_tpl->tpl_vars['date']->value;?>
</td>
            </tr>
            <tr>
                <td width="180px">入库单号</td>
                <td width="80px">入库时间</td>
                <td width="40px">已合并</td>
                <td width="50px">行号</td>
                <td width="80px">商品条码</td>
                <td width="200px">商品名称</td>
                <td width="50px">单位</td>

                <td width="50px">数量</td>
                <td width="100px">单价(不含税)</td>
                <td width="50px">金额</td>
            </tr>
            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['invoiceInfo']->value['invoices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
            <tr>
            <td rowspan="<?php echo $_smarty_tpl->tpl_vars['spanno']->value[$_smarty_tpl->tpl_vars['v']->value['invoiceId']];?>
"><?php echo $_smarty_tpl->tpl_vars['orderNo']->value[$_smarty_tpl->tpl_vars['v']->value['invoiceId']]['orderNo'];?>
</td>
            <td rowspan="<?php echo $_smarty_tpl->tpl_vars['spanno']->value[$_smarty_tpl->tpl_vars['v']->value['invoiceId']];?>
"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['createTime'],"%Y/%m/%d");?>
</td>
            <td rowspan="<?php echo $_smarty_tpl->tpl_vars['spanno']->value[$_smarty_tpl->tpl_vars['v']->value['invoiceId']];?>
"><?php if ($_smarty_tpl->tpl_vars['orderNo']->value[$_smarty_tpl->tpl_vars['v']->value['invoiceId']]['ifhe']==0) {?>否<?php } else { ?>是<?php }?></td>
            <?php  $_smarty_tpl->tpl_vars['vv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vv']->_loop = false;
 $_smarty_tpl->tpl_vars['iindex'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['goodsList']->value[$_smarty_tpl->tpl_vars['v']->value['invoiceId']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vv']->key => $_smarty_tpl->tpl_vars['vv']->value) {
$_smarty_tpl->tpl_vars['vv']->_loop = true;
 $_smarty_tpl->tpl_vars['iindex']->value = $_smarty_tpl->tpl_vars['vv']->key;
?>
            <?php if ($_smarty_tpl->tpl_vars['iindex']->value!=0) {?>
            <tr>
            <?php }?>
            <td class="hanghao">1</td>
            <td><?php echo $_smarty_tpl->tpl_vars['vv']->value['goodsSn'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['vv']->value['goodsName'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['vv']->value['unitName'];?>
</td>
            <td class="goodscount"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['vv']->value['goodsCnt']);?>
</td>
            <td> <?php if ($_smarty_tpl->tpl_vars['vv']->value['usecostpri']>0) {?><?php echo $_smarty_tpl->tpl_vars['vv']->value['usecostpri'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['vv']->value['goodsPrice'];?>
 <?php }?></td>

            <td class="goodsmon"
                attrid=" <?php if ($_smarty_tpl->tpl_vars['vv']->value['usecostpri']>0) {?><?php echo $_smarty_tpl->tpl_vars['vv']->value['usecostpri']*$_smarty_tpl->tpl_vars['vv']->value['goodsCnt'];?>
 <?php } else { ?>  <?php echo $_smarty_tpl->tpl_vars['vv']->value['goodsPrice']*$_smarty_tpl->tpl_vars['vv']->value['goodsCnt'];?>
 <?php }?>">
                <?php if ($_smarty_tpl->tpl_vars['vv']->value['usecostpri']>0) {?>
                <?php echo sprintf("%0.2f",($_smarty_tpl->tpl_vars['vv']->value['usecostpri']*$_smarty_tpl->tpl_vars['vv']->value['goodsCnt']));?>

                <?php } else { ?>
                <?php echo sprintf("%0.2f",($_smarty_tpl->tpl_vars['vv']->value['goodsPrice']*$_smarty_tpl->tpl_vars['vv']->value['goodsCnt']));?>
 <?php }?>
            </td>
            </tr>
            <?php } ?>
            <?php } ?>
            <tr>
                <td>小计</td>
                <td colspan="6"></td>
                <td class="totalcount">0</td>
                <td></td>
                <td class="totalmon">0</td>
            </tr>

            <tr>
                <td>合计（不含税）</td>
                <td colspan="8"></td>
                <td class="noratetotal">0</td>
            </tr>
            <tr>
                <td>开票调整</td>
                <td colspan="9"></td>
            </tr>

            <tr>
                <td>税金（税率)<span class="rate"><?php echo $_smarty_tpl->tpl_vars['invoiceInfo']->value['taxrate'];?>
</span>)</td>
                <td colspan="8"></td>
                <td class="ratemon">0</td>
            </tr>
            <tr>
                <td>合计（含税）</td>
                <td colspan="8"></td>
                <td class="ratetotal">0</td>
            </tr>
            <tr>
                <td>合并调整金额</td>
                <td colspan="8"></td>
                <td class="adj"><?php echo $_smarty_tpl->tpl_vars['adjustpri']->value;?>
</td>
            </tr>
            <tr>
                <td>实际开票金额</td>
                <td colspan="8"></td>
                <td class="tickpri"></td>
            </tr>
            <tr class="kong">
                <td colspan="10" height="20px"></td>
            </tr>
            <tr class="kong">
                <td>审核人：</td>
                <td colspan="2"></td>
                <td colspan="2">采购员：</td>
                <td colspan="1"></td>
                <td colspan="2">仓管员：</td>
                <td colspan="2"></td>
            </tr>
            <input type="hidden" class="invoiceIds" value="<?php echo $_smarty_tpl->tpl_vars['invoiceId']->value;?>
" />
        </table>
    </div>

</div>
<script>
    jQuery(function ($) {
        'use strict';
        $("#orderPrint").on('click', function () {
            var invoiceIds = $('.invoiceIds').val();
            if(invoiceIds!='' && invoiceIds!='undefined'){
                $.ajax({
                    type:"post",
                    url:"pay_invoice.php?action=changeSta",
                    data:{invoiceIds:invoiceIds},
                    async:false,
                    dataType:"json",
                    success:function(e){
                    if(e==1){
                      alert('对账成功');
                    }else{
                        alert('对账失败');
                    }
                    }
                });
            }
            $('.pageHead').show();
            $(".form_div").print({
                //是否包含父文档的样式，默认为true
                globalStyles: true,
                //是否包含media='print'的链接标签。会被globalStyles选项覆盖，默认为false
                mediaPrint: false,
                //外部样式
                stylesheet: '<?php echo @constant('ADMIN_URL');?>
/assets/css/print.css',
                //Print in a hidden iframe
                iframe: false,
                //不想打印的元素的jQuery选择器
                noPrintSelector: ".avoid-this",
                //Add this at top
                prepend: 'Hello World',
                //将内容添加到打印内容的后面
                append: '11111',
                //回调方法
                deferred: $.Deferred().done(function () {
                    console.log('Printing done', arguments);
                    $('.pageHead').hide();
                })
            });
        });
        // Fork https://github.com/sathvikp/jQuery.print for the full list of options
        var goodscnt = 0,
            goodspri = 0.00,
            tt = 0.00,
            rate = parseFloat($('.rate').text()),
            ratemon = 0,
            hanghao = 0,
            ratepri = 0;
        $('.goodscount').each(function () {
            goodscnt = goodscnt + parseInt($(this).text());
        });
        $('.goodsmon').each(function () {
            tt = parseFloat($(this).attr('attrid'));
            goodspri = goodspri + tt;
        });

        ratepri = goodspri * (1 + rate);//含税价
        ratemon = goodspri * rate;//税金
        $('.totalcount').text(goodscnt);//总数量
        $('.totalmon').text(goodspri.toFixed(2));//不含税价

        $('.noratetotal').text(goodspri.toFixed(2));//不含税价
        $('.ratetotal').text(ratepri.toFixed(2));//含税价
        $('.ratemon').text(ratemon.toFixed(2));//税金

        $('.hanghao').each(function () {
            $(this).text(hanghao + 1);
            hanghao = hanghao + 1
        });
        var dh = $('tr td:first-child');
        var arr = [];
        for (var i = 0; i < dh.length; i++) {
            arr.push(dh[i].innerText);
        }
        var adj = $('.adj').text();
        var tickpri = 0;
        var adjpri = parseFloat(adj.substr(1));//调整金额
        if(adj.indexOf('+') != -1){
            tickpri = parseFloat($('.ratetotal').text())+adjpri;
            $('.tickpri').text(tickpri.toFixed(2))
        }else if(adj.indexOf('-') != -1){
            tickpri = parseFloat($('.ratetotal').text())-adjpri;
            $('.tickpri').text(tickpri.toFixed(2))
        }
    });

</script>

<?php }} ?>
