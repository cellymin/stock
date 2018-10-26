<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>

<!--- START 以上内容不需更改，保证该TPL页内的标签匹配即可 --->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

	<div class="block">
        <a href="#page-menu" class="block-heading" data-toggle="collapse">快捷菜单</a>
        <div id="page-menu" class="block-body collapse in">
		<h3>
		<{if count($menus) >0  }>
			<{foreach name=menu from=$menus item=menu}>
			<span>
				<a href="<{$smarty.const.ADMIN_URL}><{$menu.menu_url}>">
					<{$menu.menu_name}>
				</a>
			</span>&nbsp;
			<{/foreach}>
		<{/if}>
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
							<li><i class="icon-exclamation-sign"></i>缺货提醒 <font><{$count1}></font><a class="btn" href="/erp/message/storage.php">查看</a></li>
							<li><i class="icon-exclamation-sign"></i>滞销提醒 <font><{$count2}></font><a class="btn" href="/erp/message/storage.php">查看</a></li>
							<li><i class="icon-exclamation-sign"></i>库存异常 <font><{$count3}></font><a class="btn" href="/erp/message/storage.php">查看</a></li>
						</ul>
					</div>
				</td>
				<td valign="top">
					<a href="#page-work" class="block-heading" data-toggle="collapse">待办事宜</a>
					<div id="page-work" class="block-body collapse in">
						<ul>
							<{foreach from=$waitWarningMsg item=v}>
							<li><i class="icon-exclamation-sign"></i><{$v.content}><a class="btn" href="<{$smarty.const.ADMIN_URL}>/message/other.php">查看</a></li>
							<{/foreach}>
							<li><i class="icon-exclamation-sign"></i>催票提醒<font><{$invoiceCount}></font><a class="btn" href="<{$smarty.const.ADMIN_URL}>/message/other.php">查看</a></li>
							<li><i class="icon-exclamation-sign"></i>催款提醒<font><{$moneyCount}></font><a class="btn" href="<{$smarty.const.ADMIN_URL}>/message/other.php">查看</a></li>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<td valign="top"  height="300">
					<a href="#page-price" class="block-heading" data-toggle="collapse">价格消息</a>
					<div id="page-price" class="block-body collapse in">
						<ul>
							<{foreach from=$priceWarningMsg item=v}>
							<li><i class="icon-exclamation-sign"></i><{$v.content['goodsName']}> <b class="<{$v.content['type']}>"><i class="icon-arrow-<{$v.content['type']}>"></i><{$v.content['value']}>%</b> <a class="btn" href="<{$smarty.const.ADMIN_URL}>/message/price.php">查看</a></li>
							<{/foreach}>
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
						        <td><{$user_info.user_name}></td>
						        <td><{$user_info.real_name}></td>
						        <td><{$user_info.mobile}></td>
						        <td><{$user_info.email}></td>
						        <td><{$user_info.login_time}></td>
						        <td><{$user_info.login_ip}></td>
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
var chartData = <{$chart}>;
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
<{include file="footer.tpl"}>