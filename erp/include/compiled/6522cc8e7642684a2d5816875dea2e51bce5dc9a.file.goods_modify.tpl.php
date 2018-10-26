<?php /* Smarty version Smarty-3.1.15, created on 2017-11-04 09:52:42
         compiled from "C:\wamp\www\jxc.com\erp\include\template\sys\goods_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:652859fd1d6a3c5776-90058619%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6522cc8e7642684a2d5816875dea2e51bce5dc9a' => 
    array (
      0 => 'C:\\wamp\\www\\jxc.com\\erp\\include\\template\\sys\\goods_modify.tpl',
      1 => 1507693339,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '652859fd1d6a3c5776-90058619',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'goods' => 0,
    'unitList' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_59fd1d6a6acfd7_60691815',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fd1d6a6acfd7_60691815')) {function content_59fd1d6a6acfd7_60691815($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'C:\\wamp\\www\\jxc.com\\erp\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<div class="form_div">
    <form id="form_data" method="post" action="">
        <table>
            <tr>
                <td><b>产品货号</b></td>
                <td>
                    <input type="text" name="goodsSn" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsSn'];?>
" placeholder="供应商条码"  required="true" >
                    <!--<span class="label label-important">系统自动生成</span>-->
                </td>
                <th><b>产品条码</b>
                    <!--<span class="label label-important">如有条码扫描仪可直接扫描</span>-->
                </th>
                <td>
                    <input type="text" readonly name="goodsBarCode" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsBarCode'];?>
"  placeholder="如有条码扫描仪可直接扫描"  required="true" >
                    <!--<span class="label label-important">如使用条形码,销售时可直接使用</span>-->
                </td>
            </tr>
            <tr>

            </tr>
            <tr>
                <td><b>产品名称</b></td>
                <td><input type="text" name="goodsName" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsName'];?>
"  required="true" ></td>
                <th><b>产品规格</b></th>
                <td><input type="text" name="goodsSpec" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsSpec'];?>
"  required="true" ></td>
            </tr>
            <tr>
                <td><b>所属分类</b></td>
                <td>
                    <select name="goodsCateId1" id="goodsCateId1" style="width: 100px">
                        <option value="0">=请选择=</option>
                    </select>
                    <select name="goodsCateId2" id="goodsCateId2" style="width: 100px">
                        <option value="0">=请选择=</option>
                    </select>
                    <select name="goodsCateId" id="goodsCateId" style="width: 100px">
                        <option value="0">=请选择=</option>
                    </select>
                </td>
                <th><b>计量单位</b></th>
                <td><?php echo smarty_function_html_options(array('name'=>'goodsUnitId','id'=>"goodsUnitId",'options'=>$_smarty_tpl->tpl_vars['unitList']->value,'selected'=>$_smarty_tpl->tpl_vars['goods']->value['goodsUnitId']),$_smarty_tpl);?>
</td>
            </tr>
            
            <input type="hidden" name="lastPrice" value="0" readonly="readonly">
            <input type="hidden" name="minPrice" value="0"  readonly="readonly">
            <input type="hidden" name="maxPrice" value="0"  readonly="readonly">
            <input type="hidden" name="avgPrice" value="0"  readonly="readonly">
            <tr>
                <td><b>生产日期</b></td>
                <td><input type="text" readonly name="productionDate" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['productionDate'];?>
" class="time_input" placeholder="" ></td>
                <th><b>作废日期</b></th>
                <td><input type="text" readonly name="invalidDate" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['invalidDate'];?>
" class="time_input" placeholder="" ></td>
            </tr>
            <tr>
                <td><b>助记词</b>
                    <!--<span class="label label-important">用于快速搜寻产品用</span>-->
                </td>
                <td colspan="3"><input type="text" name="searchKey" value="<?php echo $_smarty_tpl->tpl_vars['goods']->value['searchKey'];?>
"  placeholder="用于快速搜寻产品用"  ></td>
            </tr>
            <tr>
                <td><b>备注</b></td>
                <td colspan="3"><textarea name="remark" rows="3" ><?php echo $_smarty_tpl->tpl_vars['goods']->value['remark'];?>
</textarea></td>
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
    var catId1 = '<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsCateId1'];?>
';
    var catId2 = '<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsCateId2'];?>
';
    var catId3 = '<?php echo $_smarty_tpl->tpl_vars['goods']->value['goodsCateId'];?>
';
    var isCheck = '';

    $(function () {
        opt(0,$("#goodsCateId1"),1);
        opt(catId1,$("#goodsCateId2"),2);
        opt(catId2,$("#goodsCateId"),3);
    });

    $("#goodsCateId1").change(function () {
        var parentId = $(this).val();
        $("#goodsCateId2 option:not(:first-child)").remove();
        $("#goodsCateId option:not(:first-child)").remove();
        if(parentId!=0)
            opt(parentId,$("#goodsCateId2"))
    });

    $("#goodsCateId2").change(function () {
        var parentId = $(this).val();
        $("#goodsCateId option:not(:first-child)").remove();
        if(parentId!=0)
            opt(parentId,$("#goodsCateId"))
    });

    function opt(parentId,select,type=0) {
        $.ajax({
            url:'goods_modify.php',
            type:'POST',
            dataType:'json',
            async:false,
            data:{parentId:parentId,method:'opt'},
            success:function (e) {
                if(e){
                    $.each(e,function (i,v) {
                        isCheck = '';
                        if(type==1 && v.cateId==catId1)
                            isCheck='selected';
                        if(type==2 && v.cateId==catId2)
                            isCheck='selected';
                        if(type==3 && v.cateId==catId3)
                            isCheck='selected';
                        select.append('<option value="'+v.cateId+'" '+isCheck+'>'+v.cateName+'</option>');
                    })
                }
            }
        })
    }
</script><?php }} ?>
