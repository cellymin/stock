<?php /* Smarty version Smarty-3.1.15, created on 2017-11-02 21:12:46
         compiled from "C:\wamp\www\jxc.com\erp\include\template\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1431859fb19ce2556e2-38990977%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd334ff0c82221903b1b38f028353a6241f16442' => 
    array (
      0 => 'C:\\wamp\\www\\jxc.com\\erp\\include\\template\\footer.tpl',
      1 => 1504681991,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1431859fb19ce2556e2-38990977',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fb19ce298f54_29648955',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fb19ce298f54_29648955')) {function content_59fb19ce298f54_29648955($_smarty_tpl) {?>                    
	
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
