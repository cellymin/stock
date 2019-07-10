<?php /* Smarty version Smarty-3.1.15, created on 2019-06-24 17:09:08
         compiled from "D:\WWW\stock\erp\include\template\charts\return.tpl" */ ?>
<?php /*%%SmartyHeaderCode:207915d10933441c642-61589552%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04db6d999a48a16ed0aa8d7b87a1324df8eae383' => 
    array (
      0 => 'D:\\WWW\\stock\\erp\\include\\template\\charts\\return.tpl',
      1 => 1561008736,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '207915d10933441c642-61589552',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'company_options' => 0,
    '_GET' => 0,
    'content_header' => 0,
    'list' => 0,
    't' => 0,
    'li' => 0,
    'g' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5d10933447c179_46417313',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d10933447c179_46417313')) {function content_5d10933447c179_46417313($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\WWW\\stock\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
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
        <label>选择公司</label>
        <?php echo smarty_function_html_options(array('name'=>'companyId','id'=>"companyId",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['company_options']->value,'selected'=>$_smarty_tpl->tpl_vars['_GET']->value['companyId']),$_smarty_tpl);?>

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
    <a href="#page-stats" class="block-heading" data-toggle="collapse">领用汇总表</a>
    <div id="page-stats" class="block-body collapse in">
        <table class="table table-striped" border="1" id="data_list">
            <thead>
            <tr class="export">
                <th style="border-top:0 none;border-left:0 none;border-right: 0 none;border-bottom:0 none">
                    <?php echo $_smarty_tpl->tpl_vars['content_header']->value['menu_name'];?>

                </th>
                <th colspan="<?php echo count(end($_smarty_tpl->tpl_vars['list']->value['list']))+1;?>
" style="text-align: right;border-top:0 none;border-left:0 none;border-right: 0 none;border-bottom:0 none">
                    日期段：<?php echo $_smarty_tpl->tpl_vars['_GET']->value['startTime'];?>
至<?php echo $_smarty_tpl->tpl_vars['_GET']->value['endTime'];?>

                </th>
            </tr>
            <tr>
                <td>部门\项目</td>
                <?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['total']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value) {
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
                <td><?php echo $_smarty_tpl->tpl_vars['t']->value['cateName'];?>
</td>
                <?php } ?>
                <td>小计</td>
            </tr>
            </thead>
            <tbody>
            <?php  $_smarty_tpl->tpl_vars['li'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['li']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['li']->key => $_smarty_tpl->tpl_vars['li']->value) {
$_smarty_tpl->tpl_vars['li']->_loop = true;
?>
            <tr class="avghang">
                <td><?php echo $_smarty_tpl->tpl_vars['li']->value['departmentName'];?>
</td>
                <?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['g']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['li']->value['goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['kg']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value) {
$_smarty_tpl->tpl_vars['g']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['kg']['iteration']++;
?>
                <td class="heng"><?php echo number_format($_smarty_tpl->tpl_vars['g']->value['money'],2);?>
</td>
                <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['kg']['iteration']==count($_smarty_tpl->tpl_vars['g']->value)) {?>
                <td class="hengtotal">0</td>
                <?php }?>
                <?php } ?>

            </tr>
            <?php } ?>
            <tr class="avghang">
                <td>合计</td>
                <?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['total']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value) {
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
                <td class="heng"><?php echo number_format($_smarty_tpl->tpl_vars['t']->value['money'],2);?>
</td>
                <?php } ?>
                <td class="hengtotal">0</td>
            </tr>
            </tbody>

        </table>
    </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>

<script>
    $(function () {
        var kk=0;

        // $('.avghang').find('.heng').each(function (i,e) {
        //     kk = kk + parseFloat($(this).text().replace(/,/g,''));
        //     console.log(parseFloat($(this).text().replace(/,/g,'')));
        // })
        $('#data_list').find('.avghang').each(function (j,k) {
            var ll = 0
            $(this).find('.heng').each(function (i,e) {
                ll = ll + parseFloat($(this).text().replace(/,/g,''));
                kk = kk + parseFloat($(this).text().replace(/,/g,''));
                })
            $(this).find('.hengtotal').text(ll.toFixed(2));
        })
    })
    function beforeExport(e) {

        $('.export').css('display','')
        var table = $('#data_list').html();
        method5('data_list')
        $('#data_list').html(table);
        $('.export').css('display','none');
    }
</script>
<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
