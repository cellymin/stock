<?php /* Smarty version Smarty-3.1.15, created on 2017-12-07 10:31:40
         compiled from "D:\wwwroot\erp\include\template\finance\pay_collect.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7705a28a80c1244a4-84470747%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55b4fd816bd8ed4adf57ff99fa0898bb2f2ed538' => 
    array (
      0 => 'D:\\wwwroot\\erp\\include\\template\\finance\\pay_collect.tpl',
      1 => 1508296828,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7705a28a80c1244a4-84470747',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'i' => 0,
    'invoiceId' => 0,
    'nonceStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5a28a80c1ecb53_61436296',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a28a80c1ecb53_61436296')) {function content_5a28a80c1ecb53_61436296($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form id="" method="post" action="" enctype="multipart/form-data">
        <table width="100%" class="table">
            <tr>
                <td width="150" colspan="1">供应商名称</td>
                <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['list']->value['supplierName'];?>
</td>
            </tr>
            <tr>
                <td colspan="1">采购发票</td>
                <td colspan="3">
                    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['invoices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
                    <?php echo $_smarty_tpl->tpl_vars['i']->value['invoiceNo'];?>
 <a>#</a>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td colspan="1">合计金额</td>
                <td colspan="3"><a style="color: red;font-size: 14px;">&yen; <b><?php echo sprintf('%.2f',$_smarty_tpl->tpl_vars['list']->value['totalMoney']);?>
</b></a></td>
            </tr>
            <tr>
                <td>财务类型</td>
                <td style="color: red;font-size: 14px;">
                    采购支出
                </td>
            </tr>
              <tr>
                <td colspan="1">发票状态</td>
                <td colspan="3">
                    <select name="invoiceStatus" id="invoice">
                        <option value="0" <?php if ($_smarty_tpl->tpl_vars['list']->value['invoices']['0']['invoiceStatus']==0) {?>selected<?php }?>>未收票</option>
                        <option value="1" <?php if ($_smarty_tpl->tpl_vars['list']->value['invoices']['0']['invoiceStatus']==1) {?>selected<?php }?>>已收票</option>
                    </select>
                </td>
            </tr>
            <tr class="status">
                <td>预计收票时间</td>
                <td>
                    <input type="text" name="endTime" class="time_input" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['invoices']['0']['endTime'];?>
" readonly>
                </td>
            </tr>
            <tr class="status">
                <td>提醒收票时间</td>
                <td>
                    <input type="text" name="noticeTime" class="time_input" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['invoices']['0']['noticeTime'];?>
" readonly>
                </td>
            </tr>
            <tr class="invoiceUp">
                <td colspan="1">上传发票</td>
                <td colspan="3">
                    <label style="display: block;width: 100px;height: 100px;line-height: 100px;text-align: center;border: 1px solid #ccc;float: left">
                        上传发票
                        <input type="file" style="display: none" name="file" id="upload">

                    </label>
                    <input type="hidden" name="invoiceImgs" id="invoiceImgs" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['invoices']['0']['invoiceImg'];?>
">
                    <div id="layer-photos" style="float: left;overflow: hidden;margin-left: 10px;">
                        <img style="width: 100px;height: 100px;" src="<?php echo @constant('API_PUBLIC');?>
/<?php echo $_smarty_tpl->tpl_vars['list']->value['invoices']['0']['invoiceImg'];?>
" alt="" id="uploadImg">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="1">备注</td>
                <td colspan="3">
                    <textarea name="remark" id="" cols="50" style="width: 400px;resize: none" rows="5"><?php echo $_smarty_tpl->tpl_vars['list']->value['invoices'][0]['remark'];?>
</textarea>
                </td>
            </tr>
            <tr>
                <td><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['invoiceId']->value;?>
" name="invoiceId">
                </td>
                <td>
                    <input type="hidden" name="nonceStr" value="<?php echo $_smarty_tpl->tpl_vars['nonceStr']->value;?>
">
                    <button class="btn btn-primary" type="submit">提交</button>
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
    $("#upload").change(function () {
        var file = this.files[0];
        if (file.size > 5 * 1024 * 1024) {
            alert("你上传的文件太大了！")
        }
        //
        var reader = new FileReader();
        reader.onload = function () {
            var base64 = reader.result;
            //上传图片
            base64_uploading(base64);
        };
        reader.readAsDataURL(file);
    });

    //AJAX上传base64
    function base64_uploading(base64Data) {
        $.ajax({
            type: 'POST',
            url: "<?php echo @constant('ADMIN_URL');?>
/ajax/base64Upload.php",
            data: {
                'base64': base64Data
            },
            dataType: 'json',
            timeout: 50000,
            success: function (data) {
                if (data.code == 1) {
                    $("#uploadImg").attr('src', '<?php echo @constant('API_PUBLIC');?>
' + data.content);
                    $("#invoiceImgs").val(data.content);
                }
                var icon = data.code == 1 ? 1 : 5;
                layer.msg(data.msg, {time:1500,icon: icon});
            },
            complete: function (e) {

            },
            error: function (xhr, type) {
                layer.msg('上传超时啦，再试试', {time:1500,icon: 5});
            }
        });
    }

    $("#layer-photos").click(function () {
        layer.photos({
            photos: '#layer-photos'
            ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
        });
    });

</script>

<?php }} ?>
