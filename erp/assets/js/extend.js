$(document).on('click', '.layerModel', function () {

    var action = parseInt($(this).attr('action'));
    var checkboxs = $('#data_list input[type=checkbox]:checked');
    var value = '';
    var name = "";
    if (action == 2) {
        if (checkboxs.length == 0) {
            layer.msg('请选择操作项', {time: 1200, icon: 5});
            return false;
        }
        if (checkboxs.length > 1) {
            layer.msg('禁止多选', {time: 1500, icon: 2});
            return false;
        }
        value = checkboxs.val();
        name = checkboxs.attr('data-name');
    }
    if (action == 3) {
        if (checkboxs.length == 0) {
            layer.msg('请选择操作项', {time: 1500, icon: 5});
            return false;
        }
    }
    if(action==4){
        $.each(checkboxs,function (i,v) {
            name = $(v).attr('data-name');
            value = value+','+$(v).val();
        });
    }
    if (action != 3) {
        var url = $(this).attr('layerUrl');
        var title = $(this).attr('title');
        var width = $(this).attr('layerW');
        var height = $(this).attr('layerH');
        var type = parseInt($(this).attr('layerT'));
        var param = $(this).attr('layerD');

        if (param == undefined)
            param = '';

        top.layer.open({
            type: type,
            title: title,
            maxmin: false,
            shadeClose: false, //点击遮罩关闭层
            area: [width, height],
            resize: false,
            scrollbar:false,
            id: url,
            content: url + '.php?' + name + '=' + value + '&' + param,
            success: function (layero, index) {
                if ($.inArray(index, parent.myFrame) == -1) {
                    window.parent.myFrame.push(index);
                }
            },
            end: function () {
                var index = window.parent.myFrame[window.parent.myFrame.length - 1];
                window.parent.myFrame.splice($.inArray(index, window.parent.myFrame), 1);
            }
        });
    } else {
        /* 询问框*/
        layer.confirm('确认此操作？', {
            btn: ['是', '否'] //按钮
        }, function () {
            $("#data_list").parent().submit();
        });

    }

});

$(document).on('click', '#data_list #chkAll', function () {
    var f = $(this).prop('checked');
    $(this).parents('#data_list').find('input[type=checkbox]').not('#chkAll').prop('checked', f);
});


var myFrame = [];



