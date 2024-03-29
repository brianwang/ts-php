<!DOCTYPE html>
<html>
    <head>
        <title>{block name=title}{/block}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <LINK REL="icon" type="image/gif" href="{assert_url('/si.gif')}">
        <link rel="stylesheet" href="{assert_url('/css/bootstrap.css')}"/>
        <link rel="stylesheet" href="{assert_url('/css/bootstrap-notify.css')}"/>
        <link rel="stylesheet" href="{assert_url('/css/Style.css')}"/>
        <!--link rel="stylesheet" href="{assert_url('/css/snippet.css')}"/-->
        <link href="{assert_url('/codeprettify/prettify.css')}" type="text/css" rel="stylesheet" />
        <script src="{assert_url('/js/jquery1.7.js')}" type="text/javascript"></script>
        <script src="{assert_url('/js/underscore.js')}" type="text/javascript"></script>
        <script src="{assert_url('/js/backbone.js')}" type="text/javascript"></script>
        <script src="{assert_url('/js/ba-debug.js')}" type="text/javascript"></script>
        <script src="{assert_url('/ckeditor/ckeditor.js')}" type="text/javascript"></script>
        <script src="{assert_url('/ckeditor/config.js')}" type="text/javascript"></script>

        <script src="{assert_url('/ckeditor/adapters/jquery.js')}" type="text/javascript"></script>
        <!--script src="{assert_url('/ckeditor/jquery.CKEditor.js')}" type="text/javascript"></script-->
        <script src="{assert_url('/js/jquery.form.js')}" type="text/javascript"></script>
        <script src="{assert_url('/js/jquery.tmpl.js')}" type="text/javascript"></script>
        <script src="{assert_url('/js/bootstrap.js')}" type="text/javascript"></script>
        <script src="{assert_url('/js/bootstrap-modal.js')}" type="text/javascript"></script>
        <script src="{assert_url('/js/bootstrap-tab.js')}" type="text/javascript"></script>
        <script src="{assert_url('/jquery-validation-1.9.0/jquery.validate.js')}" type="text/javascript"></script>
        <script src="{assert_url('/jquery-validation-1.9.0/additional-methods.js')}" type="text/javascript"></script>
        <script src="{assert_url('/codeprettify/prettify.js')}" type="text/javascript"></script>
        <script>
            function copyToClipboard (text) {
            if(window.prompt ("Copy to clipboard: Ctrl+C, Enter", text) == true){
                      
        }
    }
    function copyIntoClipboard(text) {
    var flashId = 'flashId-HKxmj5';
    /* Replace this with your clipboard.swf location */
    var clipboardSWF = '/public/clipboard.swf';
    if(!document.getElementById(flashId)) {
    var div = document.createElement('div');
    div.id = flashId;
    document.body.appendChild(div);
}
document.getElementById(flashId).innerHTML = '';
var content = '<embed src="' + 
    clipboardSWF +
    '" FlashVars="clipboard=' + encodeURIComponent(text) +
    '" width="0" height="0" type="application/x-shockwave-flash"></embed>';
document.getElementById(flashId).innerHTML = content;
}
        </script>
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
                
                 $('.ratings_stars').hover(
            // Handles the mouseover
            function() {
                $(this).prevAll().andSelf().addClass('ratings_over');
                var text= $(this).attr('hint');
                $(this).parent().find('.total_votes').text(text);
                $(this).nextAll().removeClass('ratings_vote'); 
            },
            // Handles the mouseout
            function() {
                $(this).prevAll().andSelf().removeClass('ratings_over');
                $(this).parent().find('.total_votes').text('');
            }
        );
        
     function set_votes(widget) {
        var avg = $(widget).data('fsr').avg;
        var votes = $(widget).data('fsr').number_votes;
        $(widget).parent().find('.avgvalue').text(avg);
        $(widget).parent().find('.votes').text(votes);
        $(widget).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
        $(widget).find('.star_' + avg).nextAll().removeClass('ratings_vote'); 
    }
       $('.typeahead').ajaxStart(function(){
                    //$(this).append($('.loading'));
                }).typeahead({
            source: function(query, process){
                return $.get('{/literal}{site_url('/code/search')}{literal}', {query: query}, function(data){
                    //alert(data);
                    return process(data.result.options);
                    });
            }
        });
        // This actually records the vote
        $('.ratings_stars').bind('click', function() {
            var star = this;
            var widget = $(this).parent();
            
            var clicked_data = {
                clicked_on : $(star).attr('class'),
                value: $(star).attr('id'),
                id : $(star).parent().attr('id')
            };
            $.post(
            '{/literal}{site_url('/code/vote/')}{literal}',
                clicked_data,
                function(INFO) {
                    widget.data( 'fsr', INFO.result);
                    set_votes(widget);
                },
                'json'
            ); 
        });
            {/literal}
            {block name=script}{/block}
            {literal}
                });
//                  .ajaxStart(function(){$('#loading').show();})
//                  .ajaxStop(function(){$('#loading').delay(5000).hide();})
//                  .ajaxSuccess(function(event,xhr,option){
//                                //$('#loading').delay(5000).hide();
//                                var ct = xhr.getResponseHeader("content-type") || "";
//                                if(ct.indexOf('json')> -1){
//                                    var e = JSON.parse(xhr.responseText);
//                                    if(e != undefined && e.result !=undefined){
//                                        $('#notify-content').text(e.message);
//                                        $('.alert-message').addClass('success');
//                                        $('#notify').fadeIn().fadeOut(1500);
//                                    }
//                                 }
//                            }
//);
            {/literal}
        
        </script>
    </body>
</html>