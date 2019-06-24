<?php /* Smarty version Smarty-3.1.15, created on 2019-06-24 17:10:25
         compiled from "D:\WWW\stock\erp\include\template\charts\purchase.tpl" */ ?>
<?php /*%%SmartyHeaderCode:96405d109381614493-51047173%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '993b1d16f53178d22b5013783bf7f55930aad8f1' => 
    array (
      0 => 'D:\\WWW\\stock\\erp\\include\\template\\charts\\purchase.tpl',
      1 => 1560993763,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96405d109381614493-51047173',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'subinfo' => 0,
    '_GET' => 0,
    'depotsub_option' => 0,
    'content_header' => 0,
    'goods' => 0,
    'ee' => 0,
    'page_html' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5d109381696dc9_37370985',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d109381696dc9_37370985')) {function content_5d109381696dc9_37370985($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\WWW\\stock\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<style>
    table tbody tr:last-child{ font-weight: 700;font-size: 14px;color: #000}
    .export{display:none;}
</style>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">


    <div style="float:left;margin-right:5px">
        <label>选择部门</label>
        <?php echo smarty_function_html_options(array('name'=>'departmentId','id'=>"departmentId",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['subinfo']->value,'selected'=>$_smarty_tpl->tpl_vars['_GET']->value['departmentId']),$_smarty_tpl);?>

    </div>

    <div style="float:left;margin-right:5px">
        <label>选择库位</label>
        <?php echo smarty_function_html_options(array('name'=>'depotsubId','id'=>"depotsubId",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['depotsub_option']->value,'selected'=>$_smarty_tpl->tpl_vars['_GET']->value['depotsubId']),$_smarty_tpl);?>

    </div>
    <div style="float:left;margin-right:5px">
        <label>关键词</label>
        <input type="text" name="keyword" id="keyword" placeholder="产品条码/关键词"  value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['keyword'];?>
">
    </div>
    <div style="float:left;margin-right:5px">
        <label>日期段</label>
        <input type="text" name="startTime" class="time_input" readonly value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['startTime'];?>
">
    </div>
    <div style="float:left;margin-right:5px">
        <label>至</label>
        <input type="text" name="endTime" class="time_input" readonly value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['endTime'];?>
">
    </div>
    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="beforeExport(this)">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">领用明细表</a>
    <div id="page-stats" class="block-body collapse in">
        <table class="table table-striped" border="1" id="data_list">
            <thead>
            <tr class="export" style="border-top:0 none;border-left:0 none;border-right: 0 none;border-bottom:0 none">
                <th colspan="4" style="text-align: left;border-top:0 none;border-left:0 none;border-right: 0 none;border-bottom:0 none"><?php echo $_smarty_tpl->tpl_vars['content_header']->value['menu_name'];?>
</th>
                <th colspan="5" style="text-align: right;border-top:0 none;border-left:0 none;border-right: 0 none;border-bottom:0 none"> 日期段：<?php echo $_smarty_tpl->tpl_vars['_GET']->value['startTime'];?>
至<?php echo $_smarty_tpl->tpl_vars['_GET']->value['endTime'];?>
</th>

            </tr>
            <tr>
                <th>公司</th>
                <th>部门</th>
                <th>产品编码</th>
                <th>产品名称</th>
                <th>单价</th>
                <th>数量</th>
                <th>单位</th>
                <th>领用时间</th>
                <th>总价</th>
            </tr>
            </thead>
            <tbody>
            <?php  $_smarty_tpl->tpl_vars['ee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['goods']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ee']->key => $_smarty_tpl->tpl_vars['ee']->value) {
$_smarty_tpl->tpl_vars['ee']->_loop = true;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['ee']->value['companyName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['ee']->value['departmentName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['ee']->value['goodsSn'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['ee']->value['goodsName'];?>
</td>
                    <td class="goodspri"><?php echo $_smarty_tpl->tpl_vars['ee']->value['goodsPrice'];?>
</td>
                    <td class="goodscnt"><?php echo $_smarty_tpl->tpl_vars['ee']->value['goodsCnt'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['ee']->value['unitName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['ee']->value['createTime'];?>
</td>
                    <td class="total"><?php echo $_smarty_tpl->tpl_vars['ee']->value['goodsPrice']*$_smarty_tpl->tpl_vars['ee']->value['goodsCnt'];?>
</td>
                </tr>
                <?php } ?>
            <tr><td>合计</td>
                <td></td>
                <td></td>
                <td></td>
                <td class="totalpri">0</td>
                <td class="totalcnt">0</td>
                <td></td>
                <td></td>
                <td class="totalall"></td>
            </tr>
            </tbody>
        </table>
        <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>


<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<script>
    function beforeExport(e) {

        $('.export').css('display','')
        var table = $('#data_list').html();
        method5('data_list')
        $('#data_list').html(table);
        $('.export').css('display','none');
    }
    jQuery(function($) {
        var goodspri=0,goodscnt=0,goodstotal=0;
        $('.goodspri').each(function () {
            tt = parseFloat($(this).text());
            goodspri = goodspri + tt;
        });
        $('.totalpri').text(goodspri.toFixed(4));
        $('.goodscnt').each(function () {
            tt = parseFloat($(this).text());
            goodscnt = goodscnt + tt;
        });
        $('.totalcnt').text(goodscnt.toFixed(4));
        $('.total').each(function () {
            tt = parseFloat($(this).text());
            $(this).text(tt.toFixed(2));
            goodstotal = goodstotal + tt;
            console.log(goodstotal);
        });
        console.log(goodstotal);
        $('.totalall').text(goodstotal.toFixed(2));
    });


</script><?php }} ?>
