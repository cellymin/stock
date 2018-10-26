<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 10:01:41
         compiled from "C:\wamp\www\jxc.com\erp\include\template\sys\goods_cats_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2971659fd1f852135c2-76335127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b0ce006a85381cdf1c618c0813f3e62c469d6b67' => 
    array (
      0 => 'C:\\wamp\\www\\jxc.com\\erp\\include\\template\\sys\\goods_cats_modify.tpl',
      1 => 1507687136,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2971659fd1f852135c2-76335127',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'info' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd1f853291a3_08761172',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd1f853291a3_08761172')) {function content_59fd1f853291a3_08761172($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->


<div class="form_div">
    <form id="form_data" method="post" action="" autocomplete="off">
    	<input type="hidden" name="cateId" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['cateId'];?>
" />
        <table>
			<tr>
				<td><b>一级分类</b></td>
				<td>
					<select name="goodsCateId1" id="goodsCateId1">
						<option value="0">=请选择=</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>二级分类</b></td>
				<td>
					<select name="goodsCateId2" id="goodsCateId2">
						<option value="0">=请选择=</option>
					</select>
				</td>
			</tr>
            <tr>
                <td><b>分类名称</b></td>
                <td>
                    <input type="text" name="cateName" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['cateName'];?>
"  required="true" autofocus="true">
                </td>
            </tr>
			<tr>
				<td><b>分类编号</b></td>
				<td>
					<input type="text" name="cateNo" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['cateNo'];?>
"  required="true" autofocus="true">
				</td>
			</tr>
            <tr>
                <td><b>排序</b></td>
                <td>
                    <input type="text" name="cateSort" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['cateSort'];?>
"  required="true" autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b></b></td>
                <td>
                    <div class="btn-toolbar">
						<input type="hidden" name="nonceStr" value="<?php echo $_smarty_tpl->tpl_vars['nonceStr']->value;?>
">
                        <button type="submit" class="btn btn-primary"><strong>保存</strong></button>
                    </div>
                </td>
            </tr>

        </table>
    </form>
</div>
<script type="text/javascript">
	var pid = '<?php echo $_smarty_tpl->tpl_vars['info']->value['parentId'];?>
';
	var ppid = '<?php echo $_smarty_tpl->tpl_vars['info']->value['ppid'];?>
';
	var isCheck = '';

	$(function () {
		opt(0,$("#goodsCateId1"),1);
        var id = ppid;
		if(ppid==0)
		    id = pid;
        if(id!=0)
            opt(id,$("#goodsCateId2"),2);
	});

	$("#goodsCateId1").change(function () {
		var parentId = $(this).val();
		$("#goodsCateId2 option:not(:first-child)").remove();
        if(parentId!=0)
		    opt(parentId,$("#goodsCateId2"),0)
	});

	function opt(parentId,select,type) {
        console.log(parentId);
		$.ajax({
			url:'goods_cats_modify.php',
			type:'POST',
			dataType:'json',
			async:false,
			data:{parentId:parentId,method:'opt'},
			success:function (e) {
				if(e){
					$.each(e,function (i,v) {
						isCheck = '';
                        if (type == 1 && ppid == v.cateId)
                            isCheck = 'selected';
                        if (type == 2 && pid == v.cateId)
                            isCheck = 'selected';
                        if (ppid == 0 && pid == v.cateId)
                            isCheck = 'selected';
                        select.append('<option value="' + v.cateId + '" ' + isCheck + '>' + v.cateName + '</option>');
                    })
				}
			}
		})
	}
</script><?php }} ?>
