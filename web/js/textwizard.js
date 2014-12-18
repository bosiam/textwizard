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
/**
 * submit code raw data by ajax
 * @param link action URL
 * @param sside action side: en/de
 */
function enclick(link,sside)
{
    var a = $('.tab-content  .active').find('.content_holder');
    var content = a.val();
    var cid = a.attr('id');
    if(content)
    {
        $.ajax({
            url: link,
            context: document.body,
            data:{text:content,type:cid,side:sside},
            type:'POST',
            success: function(result){
                $('#output_direct').val(result);
                var alert_id = (result == 0) ? 'fail_result_output_alert' : 'success_result_output_alert';
                $(alert_id).css('display','block');
            }
        });
    }
}

