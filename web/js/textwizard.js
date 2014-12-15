/**
 *
 * Created by zhibo1 on 2014/12/15.
 */
alert(111);
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

