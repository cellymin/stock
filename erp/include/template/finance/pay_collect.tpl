<{include file ="header.tpl"}>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="form_div">
    <form id="" method="post" action="" enctype="multipart/form-data">
        <table width="100%" class="table">
            <tr>
                <td width="150" colspan="1">供应商名称</td>
                <td colspan="3"><{$list.supplierName}></td>
            </tr>
            <tr>
                <td colspan="1">采购发票</td>
                <td colspan="3">
                    <{foreach from=$list.invoices item=i}>
                    <{$i.invoiceNo}> <a>#</a>
                    <{/foreach}>
                </td>
            </tr>
            <tr>
                <td colspan="1">合计金额</td>
                <td colspan="3"><a style="color: red;font-size: 14px;">&yen; <b><{sprintf('%.2f',$list.totalMoney)}></b></a></td>
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
                        <option value="0" <{if $list['invoices']['0']['invoiceStatus'] eq 0}>selected<{/if}>>未收票</option>
                        <option value="1" <{if $list['invoices']['0']['invoiceStatus'] eq 1}>selected<{/if}>>已收票</option>
                    </select>
                </td>
            </tr>
            <tr class="status">
                <td>预计收票时间</td>
                <td>
                    <input type="text" name="endTime" class="time_input" value="<{$list['invoices']['0']['endTime']}>" readonly>
                </td>
            </tr>
            <tr class="status">
                <td>提醒收票时间</td>
                <td>
                    <input type="text" name="noticeTime" class="time_input" value="<{$list['invoices']['0']['noticeTime']}>" readonly>
                </td>
            </tr>
            <tr class="invoiceUp">
                <td colspan="1">上传发票</td>
                <td colspan="3">
                    <label style="display: block;width: 100px;height: 100px;line-height: 100px;text-align: center;border: 1px solid #ccc;float: left">
                        上传发票
                        <input type="file" style="display: none" name="file" id="upload">

                    </label>
                    <input type="hidden" name="invoiceImgs" id="invoiceImgs" value="<{$list['invoices']['0']['invoiceImg']}>">
                    <div id="layer-photos" style="float: left;overflow: hidden;margin-left: 10px;">
                        <img style="width: 100px;height: 100px;" src="<{$smarty.const.API_PUBLIC}>/<{$list['invoices']['0']['invoiceImg']}>" alt="" id="uploadImg">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="1">备注</td>
                <td colspan="3">
                    <textarea name="remark" id="" cols="50" style="width: 400px;resize: none" rows="5"><{$list['invoices'][0]['remark']}></textarea>
                </td>
            </tr>
            <tr>
                <td><input type="hidden" value="<{$invoiceId}>" name="invoiceId">
                </td>
                <td>
                    <input type="hidden" name="nonceStr" value="<{$nonceStr}>">
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
            url: "<{$smarty.const.ADMIN_URL}>/ajax/base64Upload.php",
            data: {
                'base64': base64Data
            },
            dataType: 'json',
            timeout: 50000,
            success: function (data) {
                if (data.code == 1) {
                    $("#uploadImg").attr('src', '<{$smarty.const.API_PUBLIC}>' + data.content);
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

