<!DOCTYPE html>
<html>
    <head>
        <title>{block name=title}{/block}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <LINK REL="icon" type="image/gif" href="{assert_url('/si.gif')}">
        <link rel="stylesheet" href="{assert_url('/css/bootstrap.css')}">
        <link rel="stylesheet" href="{assert_url('/css/bootstrap-notify.css')}">
        <link rel="stylesheet" href="{assert_url('/css/Style.css')}">
        <script src="{assert_url('/js/jquery1.7.js')}" type="text/javascript"></script>
        <script src="{assert_url('/js/jquery.form.js')}" type="text/javascript"></script>
        <script src="{assert_url('/js/jquery.tmpl.js')}" type="text/javascript"></script>
        <script src="{assert_url('/js/bootstrap.js')}" type="text/javascript"></script>
        <script src="{assert_url('/js/bootstrap-modal.js')}" type="text/javascript"></script>
        <script src="{assert_url('/js/bootstrap-tab.js')}" type="text/javascript"></script>

        {block name=css}{/block}
    </head>
    <body>
        <div class="container">
            {* The header file with the main logo and stuff  *}
            {include file='header.tpl'}
            {block name=body}{/block}
            {include file='footer.tpl'}
        </div>
        <div class="progress progress-striped active hide" id="loading" 
             style="position:fixed;top:45%; left:45%;width: 200px; z-index:2000;">
            <div class="bar" style="width: 100%; "></div>
        </div>
        <div class="alerts" id="notify" style="display:none;">
            <div class="alert-message">
                <a class="close" href="#">×</a>
                <div id="notify-content"></div>
            </div>
        </div>
        <div class='notifications top-right'></div>
        <script>
            {literal}
                 $(function(){
                     $.ajaxSetup({
                            error: function(jqXHR, exception) {
                                    if (jqXHR.status === 0) {
                                            message ='Not connect.\n Verify Network.';
                                    } else if (jqXHR.status == 404) {
                                            message ='Requested page not found. [404]';
                                    } else if (jqXHR.status == 500) {
                                            message ='Internal Server Error [500].';
                                    } else if (exception === 'parsererror') {
                                            message ='Requested JSON parse failed.';
                                    }else if (exception === 'timeout') {
                                            message ='Time out error.';
                                    } else if (exception === 'abort') {
                                            message ='Ajax request aborted.';
                                    } else {
                                            message ='Uncaught Error.\n' + jqXHR.responseText;
                                    }
                                        var r = JSON.parse(jqXHR.responseText);
                                          if(r.message !=undefined || r.message != ''){
                                              message = r.result;
                                         }
                                    $('#notify-content').text(message);
                                    $('.alert-message').addClass('error');
                                    $('#notify').fadeIn().fadeOut(2500);
                            }
            });
            {/literal}
            {block name=script}{/block}
            {literal}
                 
                }).ajaxStart(function(){$('#loading').show();})
                  .ajaxStop(function(){$('#loading').delay(5000).hide();})
                  .ajaxSuccess(function(event,xhr,option){
                                $('#loading').delay(5000).hide();
                                var e = JSON.parse(xhr.responseText);
                                if(e != undefined && e.result !=undefined){
                                    $('#notify-content').text(e.message);
                                    $('.alert-message').addClass('success');
                                    $('#notify').fadeIn().fadeOut(1500);
                                }
                            }
);
            {/literal}
        
        </script>
    </body>
</html>