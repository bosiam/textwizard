/**
 *
 * Created by zhibo1 on 2014/12/15.
 */

var myApp;
myApp = myApp || (function () {
    var pleaseWaitDiv = $('<div style="width: 60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-striped"><span class="sr-only">60% Complete</span></div>');
    return {
    showPleaseWait: function() {
    pleaseWaitDiv.modal();
    },
    hidePleaseWait: function () {
    pleaseWaitDiv.modal('hide');
    }
    };
    })();

function enclick(link)
{
    var a = $('.tab-content  .active').find('.content_holder');
    var content = a.val();
    var cid = a.attr('id');
    var method = '';
    var success_html = '' +
        '<div role="alert" class="alert alert-success">' +
        '<strong>Well done!</strong>' +
        ' You successfully read this important alert message.' +
        '<p class="pull-right">' +
        '<a href="#" >另存为</a> ' +
        '<a href="#">复制到粘贴板</a>' +
        '</p></div>';
    if(cid === 'content_paste_direct')
    {
        method = 'paste';
    }
    else if(cid === 'content_from_url')
    {
        method = 'url'
    }
    if(content)
    {
        $.ajax({
            url: link,
            context: document.body,
            data:{text:content,type:method},
            type:'POST',
            success: function(result){
                $('#output_direct').val(result);
                $('#result_output').prepend(success_html);
            }
        });
    }
}

