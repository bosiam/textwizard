/**
 *
 * Created by zhibo1 on 2014/12/15.
 */

var myApp;
myApp = myApp || (function () {
    var pleaseWaitDiv = $('<div style="width: 60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-striped"></div>');
        return {
                showPleaseWait: function() {
                pleaseWaitDiv.modal();
            },
                hidePleaseWait: function () {
                pleaseWaitDiv.modal('hide');
            }
        };
    })();
/**
 *
 * @type {{pattern: RegExp, ret: string, statusCode: number, succMsg: string, alertMsg: string, jsonde: Function, trequest: Function, defau: Function, retOutput: Function, rawOutput: Function}}
 */
var handleObj = {
    pattern:/^(http|https):\/\//,
    ret:'',
    statusCode:0,
    succMsg:'Congratulations！',
    alertMsg:'Congratulations！',
    isRaw:1,
    /**
     * 文本是否需要服务器返回
     */
    contentPlace:function(){

    },
    attrsReset: function(){
        this.statusCode = 0;
        this.alertMsg = '';
        this.isRaw = 1;
        this.ret = '';
    },
    /**
     * 清空提示消息
     */
    alertInit: function(){
        $('#fail_result_output_alert').css('display','none');
        $('#success_result_output_alert').css('display','none');
        var alert_id = (handleObj.statusCode !== 0) ? '#fail_result_output_alert' : '#success_result_output_alert';
        $(alert_id).css('display','block');
        $(alert_id).html(handleObj.alertMsg);
    },
    /**
     * json解析
     * @returns {number}
     */
    jsonde: function() {
        if(this.pattern.exec(this.content))
        {
            this.trequest();
            this.rawOutput();
        }
        //格式化json文本
        Process();
        return 1;
    },
    serializede:function(){
        this.isRaw = 3;
        this.trequest();
        this.rawOutput();
        //格式化json文本
        Process();
        return 1;
    },
    msgpackde:function(){
        this.isRaw = 3;
        this.trequest();
        this.rawOutput();
        //格式化json文本
        Process();
        return 1;
    },
    trequest:function(){
        $.ajax({
            url: this.link,
            data:{text:this.content,side:this.sside,isRaw:this.isRaw},
            type:'POST',
            async:false,
            success: function(result){
                result = $.parseJSON(result);
                handleObj.statusCode = result.status;
                handleObj.alertMsg = result.msg;
                handleObj.ret = result.data;
            }
        });
    },
    defau: function(){
        //使用处理过的数据
        this.isRaw = 2;
        this.trequest();
        this.retOutput();
        return 1;
    },
    retOutput: function(){
        $('#Canvas').html(this.ret);
    },
    rawOutput: function(){
        $('#RawJson').val(this.ret);
    }
}
/**
 * submit code raw data by ajax
 * @param link action URL
 * @param sside action side: en/de
 * @param exec handle side
 */
function enclick(link,sside,execs)
{
    var a = $('.tab-content  .active').find('.content_holder');
    var content = a.val();
    if(!content)
    {
        alert('输入框不能为空！');
        return false;
    }
    //增加遮罩
    myApp.showPleaseWait();
    var cid = a.attr('id');
    //拼装对应函数名
    var mapHandle= execs + sside;
    handleObj.attrsReset();
    if(!handleObj.hasOwnProperty(mapHandle))
    {
        mapHandle = 'defau';//
    }
    //传递提交变量
    handleObj.link = link;
    handleObj.content = content;
    handleObj.sside = sside;
    //执行方法
    var result = eval('handleObj.'+mapHandle+'()');
    //取消遮罩
    myApp.hidePleaseWait();
    //成功、错误提示
    handleObj.alertInit();
    //滑动滚动条
    element = $('#Canvas');
    offset = element.offset();
    offsetTop = offset.top - 125;
    $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}
$(function(){

    $(document).on( 'scroll', function(){

        if ($(window).scrollTop() > 100) {
            $('.scroll-top-wrapper').addClass('show');
        } else {
            $('.scroll-top-wrapper').removeClass('show');
        }
    });

    $('.scroll-top-wrapper').on('click', scrollToTop);
});

function scrollToTop() {
    verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
    element = $('body');
    offset = element.offset();
    offsetTop = offset.top;
    $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}
/*json format raw js code from http://www.bodurov.com/JsonFormatter/*/
window.SINGLE_TAB = "  ";
window.ImgCollapsed = "../images/Collapsed.gif";
window.ImgExpanded = "../images/Expanded.gif";
window.QuoteKeys = true;
function $id(id){ return document.getElementById(id); }
function IsArray(obj) {
    return obj &&
        typeof obj === 'object' &&
        typeof obj.length === 'number' &&
        !(obj.propertyIsEnumerable('length'));
}
function Process(){
    SetTab();
    window.IsCollapsible = $id("CollapsibleView").checked;
    var json = $id("RawJson").value;
    var html = "";
    try{
        if(json == "") json = "\"\"";
        var obj = eval("["+json+"]");
        html = ProcessObject(obj[0], 0, false, false, false);
        handleObj.alertMsg = "Congratulations!";
        handleObj.statusCode = 0;
        $('#ControlsRow').css('display','block');
        $id("Canvas").innerHTML = "<PRE class='CodeContainer'>"+html+"</PRE>";
    }catch(e){
        handleObj.alertMsg = "JSON is not well formated:\n"+e.message;
        handleObj.statusCode = -1;
        $id("Canvas").innerHTML = "";
    }
}
window._dateObj = new Date();
window._regexpObj = new RegExp();
function ProcessObject(obj, indent, addComma, isArray, isPropertyContent){
    var html = "";
    var comma = (addComma) ? "<span class='Comma'>,</span> " : "";
    var type = typeof obj;
    var clpsHtml ="";
    if(IsArray(obj)){
        if(obj.length == 0){
            html += GetRow(indent, "<span class='ArrayBrace'>[ ]</span>"+comma, isPropertyContent);
        }else{
            clpsHtml = window.IsCollapsible ? "<span><img src=\""+window.ImgExpanded+"\" onClick=\"ExpImgClicked(this)\" /></span><span class='collapsible'>" : "";
            html += GetRow(indent, "<span class='ArrayBrace'>[</span>"+clpsHtml, isPropertyContent);
            for(var i = 0; i < obj.length; i++){
                html += ProcessObject(obj[i], indent + 1, i < (obj.length - 1), true, false);
            }
            clpsHtml = window.IsCollapsible ? "</span>" : "";
            html += GetRow(indent, clpsHtml+"<span class='ArrayBrace'>]</span>"+comma);
        }
    }else if(type == 'object'){
        if (obj == null){
            html += FormatLiteral("null", "", comma, indent, isArray, "Null");
        }else if (obj.constructor == window._dateObj.constructor) {
            html += FormatLiteral("new Date(" + obj.getTime() + ") /*" + obj.toLocaleString()+"*/", "", comma, indent, isArray, "Date");
        }else if (obj.constructor == window._regexpObj.constructor) {
            html += FormatLiteral("new RegExp(" + obj + ")", "", comma, indent, isArray, "RegExp");
        }else{
            var numProps = 0;
            for(var prop in obj) numProps++;
            if(numProps == 0){
                html += GetRow(indent, "<span class='ObjectBrace'>{ }</span>"+comma, isPropertyContent);
            }else{
                clpsHtml = window.IsCollapsible ? "<span><img src=\""+window.ImgExpanded+"\" onClick=\"ExpImgClicked(this)\" /></span><span class='collapsible'>" : "";
                html += GetRow(indent, "<span class='ObjectBrace'>{</span>"+clpsHtml, isPropertyContent);
                var j = 0;
                for(var prop in obj){
                    var quote = window.QuoteKeys ? "\"" : "";
                    html += GetRow(indent + 1, "<span class='PropertyName'>"+quote+prop+quote+"</span>: "+ProcessObject(obj[prop], indent + 1, ++j < numProps, false, true));
                }
                clpsHtml = window.IsCollapsible ? "</span>" : "";
                html += GetRow(indent, clpsHtml+"<span class='ObjectBrace'>}</span>"+comma);
            }
        }
    }else if(type == 'number'){
        html += FormatLiteral(obj, "", comma, indent, isArray, "Number");
    }else if(type == 'boolean'){
        html += FormatLiteral(obj, "", comma, indent, isArray, "Boolean");
    }else if(type == 'function'){
        if (obj.constructor == window._regexpObj.constructor) {
            html += FormatLiteral("new RegExp(" + obj + ")", "", comma, indent, isArray, "RegExp");
        }else{
            obj = FormatFunction(indent, obj);
            html += FormatLiteral(obj, "", comma, indent, isArray, "Function");
        }
    }else if(type == 'undefined'){
        html += FormatLiteral("undefined", "", comma, indent, isArray, "Null");
    }else{
        html += FormatLiteral(obj.toString().split("\\").join("\\\\").split('"').join('\\"'), "\"", comma, indent, isArray, "String");
    }
    return html;
}
function FormatLiteral(literal, quote, comma, indent, isArray, style){
    if(typeof literal == 'string')
        literal = literal.split("<").join("&lt;").split(">").join("&gt;");
    var str = "<span class='"+style+"'>"+quote+literal+quote+comma+"</span>";
    if(isArray) str = GetRow(indent, str);
    return str;
}
function FormatFunction(indent, obj){
    var tabs = "";
    for(var i = 0; i < indent; i++) tabs += window.TAB;
    var funcStrArray = obj.toString().split("\n");
    var str = "";
    for(var i = 0; i < funcStrArray.length; i++){
        str += ((i==0)?"":tabs) + funcStrArray[i] + "\n";
    }
    return str;
}
function GetRow(indent, data, isPropertyContent){
    var tabs = "";
    for(var i = 0; i < indent && !isPropertyContent; i++) tabs += window.TAB;
    if(data != null && data.length > 0 && data.charAt(data.length-1) != "\n")
        data = data+"\n";
    return tabs+data;
}
function CollapsibleViewClicked(){
    $id("CollapsibleViewDetail").style.visibility = $id("CollapsibleView").checked ? "visible" : "hidden";
    Process();
}

function QuoteKeysClicked(){
    window.QuoteKeys = $id("QuoteKeys").checked;
    Process();
}

function CollapseAllClicked(){
    EnsureIsPopulated();
    TraverseChildren($id("Canvas"), function(element){
        if(element.className == 'collapsible'){
            MakeContentVisible(element, false);
        }
    }, 0);
}
function ExpandAllClicked(){
    EnsureIsPopulated();
    TraverseChildren($id("Canvas"), function(element){
        if(element.className == 'collapsible'){
            MakeContentVisible(element, true);
        }
    }, 0);
}
function MakeContentVisible(element, visible){
    var img = element.previousSibling.firstChild;
    if(!!img.tagName && img.tagName.toLowerCase() == "img"){
        element.style.display = visible ? 'inline' : 'none';
        element.previousSibling.firstChild.src = visible ? window.ImgExpanded : window.ImgCollapsed;
    }
}
function TraverseChildren(element, func, depth){
    for(var i = 0; i < element.childNodes.length; i++){
        TraverseChildren(element.childNodes[i], func, depth + 1);
    }
    func(element, depth);
}
function ExpImgClicked(img){
    var container = img.parentNode.nextSibling;
    if(!container) return;
    var disp = "none";
    var src = window.ImgCollapsed;
    if(container.style.display == "none"){
        disp = "inline";
        src = window.ImgExpanded;
    }
    container.style.display = disp;
    img.src = src;
}
function CollapseLevel(level){
    EnsureIsPopulated();
    TraverseChildren($id("Canvas"), function(element, depth){
        if(element.className == 'collapsible'){
            if(depth >= level){
                MakeContentVisible(element, false);
            }else{
                MakeContentVisible(element, true);
            }
        }
    }, 0);
}
function TabSizeChanged(){
    Process();
}
function SetTab(){
    var select = $id("TabSize");
    window.TAB = MultiplyString(parseInt(select.options[select.selectedIndex].value), window.SINGLE_TAB);
}
function EnsureIsPopulated(){
    if(!$id("Canvas").innerHTML && !!$id("RawJson").value) Process();
}
function MultiplyString(num, str){
    var sb =[];
    for(var i = 0; i < num; i++){
        sb.push(str);
    }
    return sb.join("");
}
function SelectAllClicked(){

    if(!!document.selection && !!document.selection.empty) {
        document.selection.empty();
    } else if(window.getSelection) {
        var sel = window.getSelection();
        if(sel.removeAllRanges) {
            window.getSelection().removeAllRanges();
        }
    }

    var range =
        (!!document.body && !!document.body.createTextRange)
            ? document.body.createTextRange()
            : document.createRange();

    if(!!range.selectNode)
        range.selectNode($id("Canvas"));
    else if(range.moveToElementText)
        range.moveToElementText($id("Canvas"));

    if(!!range.select)
        range.select($id("Canvas"));
    else
        window.getSelection().addRange(range);
}
function LinkToJson(){
    var val = $id("RawJson").value;
    val = escape(val.split('/n').join(' ').split('/r').join(' '));
    $id("InvisibleLinkUrl").value = val;
    $id("InvisibleLink").submit();
}

