<?php /* Smarty version Smarty-3.1.15, created on 2017-10-18 14:30:43
         compiled from "E:\wwwroot\jxc.com\erp\include\template\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:394759e6f5136d1da3-30646143%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46adf5ab61c490ad1a08e7b1483a704b2befceae' => 
    array (
      0 => 'E:\\wwwroot\\jxc.com\\erp\\include\\template\\footer.tpl',
      1 => 1504681991,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '394759e6f5136d1da3-30646143',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59e6f5136dd939_19164522',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e6f5136dd939_19164522')) {function content_59e6f5136dd939_19164522($_smarty_tpl) {?>                    
	
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
