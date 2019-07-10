<?php /* Smarty version Smarty-3.1.15, created on 2019-07-10 13:18:40
         compiled from "D:\WWW\stock\erp\include\template\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:247105d257530034271-00140311%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a982120f791531bb54272ad922ce88aa8cad2fe' => 
    array (
      0 => 'D:\\WWW\\stock\\erp\\include\\template\\footer.tpl',
      1 => 1548827222,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '247105d257530034271-00140311',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5d25753003d3c5_56036964',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d25753003d3c5_56036964')) {function content_5d25753003d3c5_56036964($_smarty_tpl) {?>                    
	
					<footer>
                        <hr>

                        <p></p>
                    </footer>
				</div>
			</div>
		</div>
    <script src="<?php echo @constant('ADMIN_URL');?>
/assets/lib/bootstrap/js/bootstrap.js"></script>
	
<!--  快捷方式的提示 -->
	
<script type="text/javascript">	
	
alertDismiss("alert-success",3);
alertDismiss("alert-info",10);
	
listenShortCut("icon-plus");
listenShortCut("icon-minus");
doSidebar();
</script>
  </body>
</html><?php }} ?>
