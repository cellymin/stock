var flag = false;//标记点击也面时输入框下方的div是否消失
var selectOptions = null;//输入框提示的option数组

function inputSelect(){

    if(arguments.length == 0 ){
        alert("未传入参数");
        return ;
    }
    if(typeof arguments[0] != "string"){
        alert("第一个参数请传入字符串");
    }
    var reg = /[#\.]?./;
    if(!reg.test(arguments[0])){
        alert("输入参数表达式不正确");
        return ;
    }
    var select = $(arguments[0]);
    //给selectInput添加输入框内文本改变事件在IE下为oninput在其他浏览器下为onpropertychange
    var selectInput = "<input id='" + "selectInputClone" + "'  oninput='onInput(this);' onpropertychange='onPropertyChange(this);'  type='text' name='" + select.attr("name") + "' placeholder='请输入供应商名称或者字母简写'></input>";
    var selectDiv = "<div id='" + "selectDiv" + "'></div>";
    var selectOption_ = select.find("option");
    selectOptions = new Array(selectOption_.length);
    var childrenOption = null;
    for(var i = 0; i < selectOption_.length; i++){
        childrenOption = selectOption_.get(i);
        //alert(childrenOption);操蛋jquery的查找语句找出来的是DOM对象而不是jquery对象
        selectOptions[i] = $(childrenOption);
    }
    //移除原生的select,添加新的input
    select.before(selectInput);
    select.after(selectDiv);
    select.remove();
    var selectInputClone = $("#selectInputClone");
    var left = selectInputClone.offset().left;
    var top = selectInputClone.offset().top + selectInputClone.height() + 5;
    var width = selectInputClone.width();
    $("#selectDiv").css({
        // "position":"absolute",
        // "top":top,
        // "left":left,
        // "width":width,
        "border":"1px solid #aaaaaa",
        "display":"none"
    })

    //文本框单击事件
    selectInputClone.click(function(){
        var selectDiv = $("#selectDiv");
        selectDiv.empty();
        var selectInputVal = selectInputClone.val();
        //输入框内未填入信息是下方提示
        if(selectInputVal == "undefined" || selectInputVal == "null" || selectInputVal == "" ){
            for(var i = 0 ; i < selectOptions.length ; i++ ){
                selectDiv.append("<span class='selectSpan' onclick='chooseOption(this);' onmouseover='mi();' onmouseout='mo();'  taxrate='"+selectOptions[i].attr('taxrate')+"' ssd='"+selectOptions[i].attr('ss')+"' value='" + selectOptions[i].val() + "'>" + selectOptions[i].text() + "</span><br>");
            }
            selectDiv.show();
            return;
        }
        //输入框内有数据时下方提示
        var matchOption = selectOptions.filter(function(item,index,array){
            var regExpStr = "";
            for(var i = 0; i < selectInputVal.length; i++){
                if(selectInputVal.charAt(i) !=' '){
                    regExpStr += "[" + selectInputVal.charAt(i).toLowerCase() + "]+";
                }
            }
            var reg = new RegExp(regExpStr);
            var tt = (item.val()+''+item.attr('dd')+''+item.attr('es')).replace(/\s/g, "");
            if(reg.test( tt )){
                return true;
            }else{
                return false;
            }
        });
        for(var i = 0 ; i < matchOption.length ; i++ ){
            selectDiv.append("<span class='selectSpan' onclick='chooseOption(this);' onmouseover='mi();' onmouseout='mo();' taxrate='"+matchOption[i].attr('taxrate')+"' ssd='"+matchOption[i].attr('ss')+"' value='" + matchOption[i].val() + "'><b>" + matchOption[i].text() + "</b></span><br>");
        }
        selectDiv.show();
        return;
    })

    //文本框失去焦点事件
    selectInputClone.focusout(function(){
        if(!flag)
            $("#selectDiv").hide();
    })


}

//下方span单击事件
function chooseOption(obj){
    $("#selectInputClone").val($(obj).attr("value"));
    $('.selectssss').remove();
    $('#selectInputClone').after('<input class="selectssss" name="'+$('#selectInputClone').attr("name")+'" taxrate="'+$(obj).attr("taxrate")+'" type="hidden" value="'+$(obj).attr("ssd")+'" />');
    $("#selectDiv").hide();
    afterChangeSupp($(obj).attr("taxrate"));
}

//span鼠标进入事件
function mi(){
    flag = true;
}
//鼠标移除事件
function mo(){
    flag = false;

}
//IE下的文本框改变事件
function onInput(obj){
    changeSelectDivOption(obj);
    $('.selectssss').remove();
}
//其他文本框内容改变事件
function onPropertyChange(obj){
    changeSelectDivOption(obj);
    $('.selectssss').remove();
}

function changeSelectDivOption(obj){
    $("#selectDiv").empty();
    var va = $(obj).val();
    if(va == ""){
        selectOptions.forEach(function(item,index,array){
            $("#selectDiv").append("<span class='selectSpan' onclick='chooseOption(this);' onmouseover='mi();' onmouseout='mo();' taxrate='"+item.attr('taxrate')+"' ssd='"+item.attr('ss')+"' value='" + item.val() + "'><b>" + item.text() + "</b></span><br>");
        });
    }else {
        var regStr = "";
        for ( var i = 0; i < va.length ; i++){
            if(va.charAt(i) != ' '){
                regStr += "[" + va.charAt(i).toLowerCase() + "]+";
            }
        }
        //这里写$.ajax()异步请求扩充selectOptions数组，selectOptions内未option对象，也就是说，如果是json的话要将json转为option的jqery对象数组

        var reg = new RegExp(regStr);
        selectOptions.forEach(function(item,index,array){
            var tt = (item.val()+'  '+item.attr('dd')+''+item.attr('es')).replace(/\s/g, "");
            if(reg.test(tt)){
                $("#selectDiv").append("<span class='selectSpan' onclick='chooseOption(this);' onmouseover='mi();' onmouseout='mo();' taxrate='"+item.attr('taxrate')+"' ssd='"+item.attr('ss')+"' value='" + item.val() + "'><b>" + item.text() + "</b></span><br>");
            }
        });

        //这里可以遍历新的异步请求数组照上面写
    }

}

//1.初始化
inputSelect("#selectInput");