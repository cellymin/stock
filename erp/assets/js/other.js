function listenShortCut(clazz) {
    $('.' + clazz).click(function () {
        elem = $(this);
        url = $(this).attr("url");
        method = $(this).attr("method");
        $.getJSON(url + "&method=" + method, function (json) {

            if (json.result) {
                $(".bb-alert").find("span").html(json.msg);
                $(".bb-alert").fadeIn();

                setTimeout(function () {
                    $(".bb-alert").fadeOut();
                }, 3000);
                setTimeout(function () {
                    if (method == "add") {
                        elem.attr("method", "del")
                        elem.attr("class", "icon-minus");
                    } else if (method == "del") {
                        elem.attr("method", "add")
                        elem.attr("class", "icon-plus");
                    }
                }, 3000);

            }
        });
    });
}

function alertDismiss(clazz, sec) {
    setTimeout(function () {
        $('.' + clazz).fadeOut();
    }, sec * 1000);
}

function doSidebar() {
    $('.doSidebarClz').click(function () {
        elem = $(this);
        clz = elem.find("a").find("i").attr("class");
        var cookie = $.cookie('sidebarStatus');
        cookie = cookie == null ? "yes" : cookie;
        //当前侧栏打开，要关闭侧栏
        if (cookie == "yes") {
            $('#sidebar-nav').attr("class", "sidebar-nav-hide");
            $('#content').attr("class", "content-fullscreen");
            $('#body').attr("class", "body-fullscreen");
            elem.find("a").html("打开侧栏<i class=\"icon-step-forward\"></i>");
            $.cookie('sidebarStatus', 'no');
        } else {
            //当前侧栏关闭，要打开侧栏
            $('#sidebar-nav').attr("class", "sidebar-nav");
            $('#content').attr("class", "content");
            $('#body').attr("class", "body");
            elem.find("a").html("关闭侧栏<i class=\"icon-step-backward\"></i>");
            $.cookie('sidebarStatus', 'yes');
        }
    });
}

(function ($) {
    $.fn.inputTime = function () {
        this.datepicker({dateFormat: "yy-mm-dd"});
        this.datepicker("option", "firstDay", 1);
    }
}(jQuery));

$(function () {
    var inputs = document.getElementsByClassName('time_input');
    for (var i = 0; i < inputs.length; i++) {
        $(inputs[i]).inputTime();
    }

    $('form').prop('autocomplete',false);

});

var idTmr;
function  getExplorer() {
    var explorer = window.navigator.userAgent ;
    //ie
    if (explorer.indexOf("MSIE") >= 0|| (explorer.indexOf("Windows NT 6.1;") >= 0 && explorer.indexOf("Trident/7.0;") >= 0)) {
        return 'ie';
    }
    //firefox
    else if (explorer.indexOf("Firefox") >= 0) {
        return 'Firefox';
    }
    //Chrome
    else if(explorer.indexOf("Chrome") >= 0){
        return 'Chrome';
    }
    //Opera
    else if(explorer.indexOf("Opera") >= 0){
        return 'Opera';
    }
    //Safari
    else if(explorer.indexOf("Safari") >= 0){
        return 'Safari';
    }
}
function method5(tableid) {
    if(getExplorer()=='ie')
    {
        var curTbl = document.getElementById(tableid);
        curTbl.style.border="1px";
        curTbl.style.backgroundClip="padding-box";
        curTbl.style.position="relative";

        var oXL;
        try{
            oXL = new ActiveXObject("Excel.Application"); //创建AX对象excel
        }catch(e){
            alert("无法启动Excel!\n\n如果您确信您的电脑中已经安装了Excel，"+"那么请调整IE的安全级别。\n\n具体操作：\n\n"+"工具 → Internet选项 → 安全 → 自定义级别 → 对没有标记为安全的ActiveX进行初始化和脚本运行 → 启用");
            return false;
        }
        var oWB = oXL.Workbooks.Add();
        var oSheet = oWB.ActiveSheet;
        var Lenr = curTbl.rows.length;
        for (i = 0; i < Lenr; i++){
            var Lenc = curTbl.rows(i).cells.length;
            for (j = 0; j < Lenc; j++){
                oSheet.Cells(i + 1, j + 1).Borders.LineStyle=1;
                oSheet.Cells(i + 1, j + 1).value = curTbl.rows(i).cells(j).innerText;
            }
        }
        oXL.Visible = true;
    }
    else
    {
        tableToExcel(tableid)
    }
}
function Cleanup() {
    window.clearInterval(idTmr);
    CollectGarbage();
}
var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,',
        template = '<html><head><meta charset="UTF-8"></head><body><table border="1">{table}</table></body></html>',
        base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) },
        format = function(s, c) {
            return s.replace(/{(\w+)}/g,
                function(m, p) { return c[p]; }) }
    return function(table, name) {
        if (!table.nodeType) table = document.getElementById(table);
        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
        window.location.href = uri + base64(format(template, ctx))
    }
})()
