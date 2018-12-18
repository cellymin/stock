<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<OBJECT ID="jatoolsPrinter" CLASSID="CLSID:B43D3361-D075-4BE2-87FE-057188254255" codebase="jatoolsPrinter.cab#version=8,6,0,0"></OBJECT>
		<script>
			function doPrint() {
				myDoc = {
					documents: document,
					copyrights: '杰创软件拥有版权  www.jatools.com' // 版权声明,必须   
				};
				document.getElementById("jatoolsPrinter").print(myDoc, false); // 直接打印，不弹出打印机设置对话框 
			}
		</script>
	</head>
	
	<body>
		
	<{foreach name=d item=d from=$list}>
	<div id="page<{$smarty.foreach.d.iteration}>" style="width:7cm; height:4cm; border:#ddd solid 1px;">
		<table width="100%" style="height:3cm;">
			<tr>
				<td valign="top" style="width:2cm;">
					<img src="/erp/code/code.php?goodsBarCode=<{$d.goodsBarCode}>" style="height:2cm;">
				</td>
				<td valign="top" style="padding-top:6px;">
					<b><{$d.goodsName}></b><br>
					货号：<{$d.goodsSn}><br>
					条码：<{$d.goodsBarCode}><br>
				</td>
			</tr>
		</table>
	</div>
	<{/foreach}>
		
	<button onclick="doPrint()">打印</button>
	
	</body>
</html>
