<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 10:24:10
         compiled from "D:\wwwroot\erp\include\template\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2338059fd24ca412d72-18674850%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5ffc1b8b3592bfbe01c6c7e28d329d10d549ea83' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\footer.tpl',
      1 => 1504681992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2338059fd24ca412d72-18674850',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd24ca41e025_17105295',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd24ca41e025_17105295')) {function content_59fd24ca41e025_17105295($_smarty_tpl) {?>                    
	
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
