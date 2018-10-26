<?php /* Smarty version Smarty-3.1.15, created on 2018-09-29 09:34:16
         compiled from "D:\phpPro\wwwroot\StockManager\erp\include\template\sys\goods_cats_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:229915baed698989682-57030800%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8d11398b7209dc2f0f4c1fffd2162286e0115d91' => 
    array (
      0 => 'D:\\phpPro\\wwwroot\\StockManager\\erp\\include\\template\\sys\\goods_cats_add.tpl',
      1 => 1507689970,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '229915baed698989682-57030800',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5baed698989689_45007648',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5baed698989689_45007648')) {function content_5baed698989689_45007648($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

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
