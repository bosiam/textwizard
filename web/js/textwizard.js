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
    myApp.showPleaseWait();
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
                myApp.hidePleaseWait();
                $('#output_direct').html(result);
                var alert_id = (result == 0) ? '#fail_result_output_alert' : '#success_result_output_alert';
                $(alert_id).css('display','block');
                element = $('#result_output');
                offset = element.offset();
                offsetTop = offset.top - 50;
                $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
            }
        });
    }
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

