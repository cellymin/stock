<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 11:13:41
         compiled from "D:\wwwroot\erp\include\template\sys\goods_cats_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:439959fd30650c47e8-57202273%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '480640340b67c5b63bdd96aa30bfa8f81827f33d' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\sys\\goods_cats_add.tpl',
      1 => 1507689970,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '439959fd30650c47e8-57202273',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd30650dd382_58079741',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd30650dd382_58079741')) {function content_59fd30650dd382_58079741($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<div class="form_div">
    <form id="form_data" method="post" action="">
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
                    <input type="text" name="cateName" value=""  required="true" autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>分类编号</b></td>
                <td>
                    <input type="text" name="cateNo" value="" placeholder=""  required="true" autofocus="true">
                </td>
            </tr>
            <tr>
                <td><b>排序</b></td>
                <td>
                    <input type="text" name="cateSort" value="1"  required="true">
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

    $(function () {
        opt(0,$("#goodsCateId1"));
    });

    $("#goodsCateId1").change(function () {
        var parentId = $(this).val();
        $("#goodsCateId2 option:not(:first-child)").remove();
        if(parentId!=0)
            opt(parentId,$("#goodsCateId2"))
    });

    function opt(parentId,select) {
        $.ajax({
            url:'goods_cats_add.php',
            type:'POST',
            dataType:'json',
            data:{parentId:parentId,method:'opt'},
            success:function (e) {
                if(e){
                    $.each(e,function (i,v) {
                        select.append('<option value="'+v.cateId+'">'+v.cateName+'</option>');
                    })
                }
            }
        })
    }
</script><?php }} ?>
