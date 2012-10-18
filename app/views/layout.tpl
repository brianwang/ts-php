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
        <link rel="stylesheet" href="{assert_url('/css/Style.css')}">
        <script src="{assert_url('/js/jquery1.7.js')}" type="text/javascript"></script>
        <script src="{assert_url('/js/jquery.form.js')}" type="text/javascript"></script>
        <script src="{assert_url('/js/jquery.tmpl.js')}" type="text/javascript"></script>

        {block name=css}{/block}
    </head>
    <body>
        <div class="container">
            {* The header file with the main logo and stuff  *}
            {include file='header.tpl'}
            {block name=body}{/block}
            {include file='footer.tpl'}
        </div>
        <script>{block name=script}{/block}</script>
    </body>
</html>