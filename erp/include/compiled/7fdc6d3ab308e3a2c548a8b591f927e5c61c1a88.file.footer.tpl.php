<?php /* Smarty version Smarty-3.1.15, created on 2018-09-19 16:38:24
         compiled from "D:\phpPro\wwwroot\StockManager\erp\include\template\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152165ba20b009d5b37-13478470%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7fdc6d3ab308e3a2c548a8b591f927e5c61c1a88' => 
    array (
      0 => 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\template\\footer.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152165ba20b009d5b37-13478470',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5ba20b009e1243_72852031',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ba20b009e1243_72852031')) {function content_5ba20b009e1243_72852031($_smarty_tpl) {?>                    
	
					<footer>
                        <hr>

                        <p></p>
                    </footer>
				</div>
			</div>
		</div>
    <script src="<?php echo @constant('ADMIN_URL');?>
/assets/lib/bootstrap/js/bootstrap.js"></script>
	
<!--- + -快捷方式的提示 --->
	
<script type="text/javascript">	
	
alertDismiss("alert-success",3);
alertDismiss("alert-info",10);
	
listenShortCut("icon-plus");
listenShortCut("icon-minus");
doSidebar();
</script>
  </body>
</html><?php }} ?>
