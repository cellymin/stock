<?php /* Smarty version Smarty-3.1.15, created on 2018-10-23 13:52:23
         compiled from "D:\phpPro\wwwroot\StockManager\erp\include\template\charts\global.tpl" */ ?>
<?php /*%%SmartyHeaderCode:107985bceb71743fe41-58086426%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d3e889945cf8add4a96047b0ee514ff303aa063' => 
    array (
      0 => 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\template\\charts\\global.tpl',
      1 => 1526106524,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '107985bceb71743fe41-58086426',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'company_options' => 0,
    '_GET' => 0,
    'cates' => 0,
    'c' => 0,
    'list' => 0,
    'v' => 0,
    'd' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5bceb7175ae1a4_21154681',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bceb7175ae1a4_21154681')) {function content_5bceb7175ae1a4_21154681($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<style>
    table thead tr td{ text-align: center!important;vertical-align: middle!important;border-right: 1px solid #fff}
    table tbody tr td{ text-align: center!important;vertical-align: middle!important;border-right: 1px solid #eee}
    table tbody tr:last-child{ font-weight: 700;font-size: 14px;color: #000}
</style>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">

    <div style="float:left;margin-right:5px">
        <label>选择公司</label>
        <?php echo smarty_function_html_options(array('name'=>'companyId','id'=>"companyId",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['company_options']->value,'selected'=>$_smarty_tpl->tpl_vars['_GET']->value['companyId']),$_smarty_tpl);?>

    </div>
    
    <div style="float:left;margin-right:5px">
        <label>选择分类</label>
        <select name="cateId" id="" class="input-xlarge">
            <option value="0">= 请选择 =</option>
            <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['cateId'];?>
" <?php if ($_smarty_tpl->tpl_vars['_GET']->value['cateId']==$_smarty_tpl->tpl_vars['c']->value['cateId']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['cateName'];?>
</option>
            <?php } ?>
        </select>
    </div>

    <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
        <button type="submit" class="btn btn-primary">检索</button>
        <a type="button" class="btn btn-primary" onclick="method5('data_list')">导出</a>
    </div>
    <div style="clear:both;"></div>
</form>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">材料购入、领用、盘存汇总表</a>
    <div id="page-stats" class="block-body collapse in">
        <table class="table table-striped" id="data_list">
            <thead>
            <tr>
                <td rowspan="2" >产品名称</td>
                <td rowspan="2">计量单位</td>
                <td colspan="3">上月结存量</td>
                <td colspan="3">本月入库量</td>
                <td colspan="3">本月出库量</td>
                <td colspan="3">本月结存量</td>
            </tr>
            <tr>
                <td>数量</td>
                <td>单价</td>
                <td>金额</td>
                <td>数量</td>
                <td>单价</td>
                <td>金额</td>
                <td>数量</td>
                <td>单价</td>
                <td>金额</td>
                <td>数量</td>
                <td>单价</td>
                <td>金额</td>
            </tr>
            </thead>
            <tbody>
            <!--<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['cateName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['unitName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['last']['count'];?>
</td>
                    <td></td>
                    <td><?php echo number_format($_smarty_tpl->tpl_vars['v']->value['last']['money'],2);?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['buy']['count'];?>
</td>
                    <td></td>
                    <td><?php echo number_format($_smarty_tpl->tpl_vars['v']->value['buy']['money'],2);?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['using']['count'];?>
</td>
                    <td></td>
                    <td><?php echo number_format($_smarty_tpl->tpl_vars['v']->value['using']['money'],2);?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['depot']['count'];?>
</td>
                    <td></td>
                    <td><?php echo number_format($_smarty_tpl->tpl_vars['v']->value['depot']['money'],2);?>
</td>
                </tr>
                <?php } ?>-->
            <?php  $_smarty_tpl->tpl_vars['d'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['d']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['d']->key => $_smarty_tpl->tpl_vars['d']->value) {
$_smarty_tpl->tpl_vars['d']->_loop = true;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['d']->value['goodsName'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['d']->value['unitName'];?>
</td>
                    <td class="num1"><?php echo $_smarty_tpl->tpl_vars['d']->value['pdCount']['count'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['d']->value['pdCount']['avg'];?>
</td>
                    <td class="money1"><?php echo number_format($_smarty_tpl->tpl_vars['d']->value['pdCount']['count']*$_smarty_tpl->tpl_vars['d']->value['pdCount']['avg'],2);?>
</td>
                    <td class="num2"><?php echo $_smarty_tpl->tpl_vars['d']->value['ipCount']['count'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['d']->value['ipCount']['avg'];?>
</td>
                    <td class="money2"><?php echo number_format($_smarty_tpl->tpl_vars['d']->value['ipCount']['count']*$_smarty_tpl->tpl_vars['d']->value['ipCount']['avg'],2);?>
</td>
                    <td class="num3"><?php echo $_smarty_tpl->tpl_vars['d']->value['oyCount']['count'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['d']->value['oyCount']['avg'];?>
</td>
                    <td class="money3"><?php echo number_format($_smarty_tpl->tpl_vars['d']->value['oyCount']['count']*$_smarty_tpl->tpl_vars['d']->value['oyCount']['avg'],2);?>
</td>
                    <td class="num4"><?php echo $_smarty_tpl->tpl_vars['d']->value['pdCount1']['count'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['d']->value['pdCount1']['avg'];?>
</td>
                    <td class="money4"><?php echo number_format($_smarty_tpl->tpl_vars['d']->value['pdCount1']['count']*$_smarty_tpl->tpl_vars['d']->value['pdCount1']['avg'],2);?>
</td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="2">合计</td>
                <td id="num1"></td>
                <td></td>
                <td id="money1"></td>
                <td id="num2"></td>
                <td></td>
                <td id="money2"></td>
                <td id="num3"></td>
                <td></td>
                <td id="money3"></td>
                <td id="num4"></td>
                <td></td>
                <td id="money4"></td>
            </tr>
            </tbody>

        </table>
    </div>
</div>

<script type="text/javascript">
$(function(){
num(1);num(2);num(3);num(4);
money(1);money(2);money(3);money(4);
	
})

function num(i){
	var num=0;
	$('body .num'+i).each(function(){
		num += parseFloat($(this).text());		
	})
	$('#num'+i).append(num);
}
function money(i){
	var num=0;
	$('body .money'+i).each(function(){
		num += parseFloat($(this).text());		
	})
	$('#money'+i).append(num.toFixed(2));
}

</script>

<!---操作的确认层，相当于javascript:confirm函数--->
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>

<script>

</script>
<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
