<?php /* Smarty version Smarty-3.1.15, created on 2017-11-02 17:20:57
         compiled from "D:\wwwroot\jxc.com\erp\include\template\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3206159fae379e7af23-12459608%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f1343452fd37ecc4f3be66a7860263f762a7e955' => 
    array (
      0 => 'D:\\wwwroot\\jxc.com\\erp\\include\\template\\footer.tpl',
      1 => 1504681991,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3206159fae379e7af23-12459608',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fae379e8a925_84069849',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fae379e8a925_84069849')) {function content_59fae379e8a925_84069849($_smarty_tpl) {?>                    
	
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
