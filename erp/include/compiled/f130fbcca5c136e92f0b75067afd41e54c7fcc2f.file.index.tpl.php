<?php /* Smarty version Smarty-3.1.15, created on 2017-11-02 21:13:00
         compiled from "C:\wamp\www\jxc.com\erp\include\template\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1663059fb19dcdfc034-05154395%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f130fbcca5c136e92f0b75067afd41e54c7fcc2f' => 
    array (
      0 => 'C:\\wamp\\www\\jxc.com\\erp\\include\\template\\index.tpl',
      1 => 1508315451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1663059fb19dcdfc034-05154395',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'menus' => 0,
    'menu' => 0,
    'count1' => 0,
    'count2' => 0,
    'count3' => 0,
    'waitWarningMsg' => 0,
    'v' => 0,
    'invoiceCount' => 0,
    'moneyCount' => 0,
    'priceWarningMsg' => 0,
    'user_info' => 0,
    'chart' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fb19dd423034_83970065',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fb19dd423034_83970065')) {function content_59fb19dd423034_83970065($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!--- START 以上内容不需更改，保证该TPL页内的标签匹配即可 --->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>


	<div class="block">
        <a href="#page-menu" class="block-heading" data-toggle="collapse">快捷菜单</a>
        <div id="page-menu" class="block-body collapse in">
		<h3>
		<?php if (count($_smarty_tpl->tpl_vars['menus']->value)>0) {?>
			<?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value) {
$_smarty_tpl->tpl_vars['menu']->_loop = true;
?>
			<span>
				<a href="<?php echo @constant('ADMIN_URL');?>
<?php echo $_smarty_tpl->tpl_vars['menu']->value['menu_url'];?>
">
					<?php echo $_smarty_tpl->tpl_vars['menu']->value['menu_name'];?>

				</a>
			</span>&nbsp;
			<?php } ?>
		<?php }?>
		</h3>
		</div> 
    </div>

	<div class="block">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" id="warning_msg">
			<tr>
				<td width="30%" valign="top" height="200">
					<a href="#page-storage" class="block-heading" data-toggle="collapse">库存消息</a>
					<div id="page-storage" class="block-body collapse in">
						<ul>
							<li><i class="icon-exclamation-sign"></i>缺货提醒 <font><?php echo $_smarty_tpl->tpl_vars['count1']->value;?>
</font><a class="btn" href="/erp/message/storage.php">查看</a></li>
							<li><i class="icon-exclamation-sign"></i>滞销提醒 <font><?php echo $_smarty_tpl->tpl_vars['count2']->value;?>
</font><a class="btn" href="/erp/message/storage.php">查看</a></li>
							<li><i class="icon-exclamation-sign"></i>库存异常 <font><?php echo $_smarty_tpl->tpl_vars['count3']->value;?>
</font><a class="btn" href="/erp/message/storage.php">查看</a></li>
						</ul>
					</div>
				</td>
				<td valign="top">
					<a href="#page-work" class="block-heading" data-toggle="collapse">待办事宜</a>
					<div id="page-work" class="block-body collapse in">
						<ul>
							<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['waitWarningMsg']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
							<li><i class="icon-exclamation-sign"></i><?php echo $_smarty_tpl->tpl_vars['v']->value['content'];?>
<a class="btn" href="<?php echo @constant('ADMIN_URL');?>
/erp/message/other.php">查看</a></li>
							<?php } ?>
							<li><i class="icon-exclamation-sign"></i>催票提醒<font><?php echo $_smarty_tpl->tpl_vars['invoiceCount']->value;?>
</font><a class="btn" href="<?php echo @constant('ADMIN_URL');?>
/erp/message/other.php">查看</a></li>
							<li><i class="icon-exclamation-sign"></i>催款提醒<font><?php echo $_smarty_tpl->tpl_vars['moneyCount']->value;?>
</font><a class="btn" href="<?php echo @constant('ADMIN_URL');?>
/erp/message/other.php">查看</a></li>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<td valign="top"  height="300">
					<a href="#page-price" class="block-heading" data-toggle="collapse">价格消息</a>
					<div id="page-price" class="block-body collapse in">
						<ul>
							<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['priceWarningMsg']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
							<li><i class="icon-exclamation-sign"></i><?php echo $_smarty_tpl->tpl_vars['v']->value['content']['goodsName'];?>
 <b class="<?php echo $_smarty_tpl->tpl_vars['v']->value['content']['type'];?>
"><i class="icon-arrow-<?php echo $_smarty_tpl->tpl_vars['v']->value['content']['type'];?>
"></i><?php echo $_smarty_tpl->tpl_vars['v']->value['content']['value'];?>
%</b> <a class="btn" href="<?php echo @constant('ADMIN_URL');?>
/erp/message/price.php">查看</a></li>
							<?php } ?>
						</ul>
					</div>
				</td>
				<td valign="top">
					<a href="#page-charts" class="block-heading" data-toggle="collapse">数据分析</a>
					<div id="page-charts" class="block-body collapse in">
						<div id="data_charts" style="width: 100%;height:250px"></div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	
	<div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">当前用户信息</a>
        <div id="page-stats" class="block-body collapse in">
			
               <table class="table table-striped">  
						     
							 <tr>
						        <td>用户名</td>
						        <td>真实姓名</td>
						        <td>手机号</td>
						        <td>Email</td>
						        <td>登录时间</td>
						        <td>登录IP</td>
					          </tr>
						      <tr>
						        <td><?php echo $_smarty_tpl->tpl_vars['user_info']->value['user_name'];?>
</td>
						        <td><?php echo $_smarty_tpl->tpl_vars['user_info']->value['real_name'];?>
</td>
						        <td><?php echo $_smarty_tpl->tpl_vars['user_info']->value['mobile'];?>
</td>
						        <td><?php echo $_smarty_tpl->tpl_vars['user_info']->value['email'];?>
</td>
						        <td><?php echo $_smarty_tpl->tpl_vars['user_info']->value['login_time'];?>
</td>
						        <td><?php echo $_smarty_tpl->tpl_vars['user_info']->value['login_ip'];?>
</td>
					          </tr>
					        
					      </table>
		</div>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>注意！</strong>请保管好您的个人信息，一点发生密码泄露请紧急联系管理员。</div>
        </div>
    </div>
<script>
	var myChart = echarts.init(document.getElementById('data_charts'));
	var colors = ['#5793f3', '#d14a61', '#675bba'];
var chartData = <?php echo $_smarty_tpl->tpl_vars['chart']->value;?>
;
	option = {
		color: colors,

		tooltip: {
			trigger: 'none',
			axisPointer: {
				type: 'cross'
			}
		},
		legend: {
			data:['2017 采购金额', '2017 采购数量']
		},
		grid: {
			top: 70,
			bottom: 50
		},
		xAxis: [
			{
				type: 'category',
				axisTick: {
					alignWithLabel: true
				},
				axisLine: {
					onZero: false,
					lineStyle: {
						color: colors[1]
					}
				},
				axisPointer: {
					label: {
						formatter: function (params) {
							return '数量  ' + params.value
									+ (params.seriesData.length ? '：' + params.seriesData[0].data : '');
						}
					}
				},
				data: chartData.data3
			},
			{
				type: 'category',
				axisTick: {
					alignWithLabel: true
				},
				axisLine: {
					onZero: false,
					lineStyle: {
						color: colors[0]
					}
				},
				axisPointer: {
					label: {
						formatter: function (params) {
							return ' 金额 ' + params.value
									+ (params.seriesData.length ? '：' + params.seriesData[0].data : '');
						}
					}
				},
				data: chartData.data3
			}
		],
		yAxis: [
			{
				type: 'value'
			}
		],
		series: [
			{
				name:'2017 采购金额',
				type:'line',
				xAxisIndex: 1,
				smooth: true,
				data: chartData.data1
			},
			{
				name:'2017 采购数量',
				type:'line',
				smooth: true,
				data: chartData.data2
			}
		]
	};

	myChart.setOption(option);

</script>
<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
