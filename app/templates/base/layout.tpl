<!DOCTYPE html>
<html dir="@{$template_direction}">
    <head>
        <title>@if(CONTROLLER == 'index') @{$str_title} @else @{SITE_NAME} - @{$str_title} @endif</title>
        <meta charset="UTF-8"/>
        <meta content='width=device-width, initial-scale=1.0, user-scalable=no' name='viewport'/>

        <script src="@{JS_PATH}jquery.min.js"></script>

        <script src="@{JS_PATH}scrollbar.js"></script>
        <script src="@{JS_PATH}scroller.js"></script>
        <link rel="stylesheet" href="@{CSS_PATH}scrollbar.@{$template_direction}.css">
        <script src="@{JS_PATH}smoothscroll.js"></script>

        <script src="@{JS_PATH}main.js"></script>

        <link rel="stylesheet" href="@{CSS_PATH}layout.css">
        <link rel="stylesheet" href="@{CSS_PATH}style.@{$template_direction}.css">
        <link rel="stylesheet" href="@{ASSETS_PATH}fonts/MaterialIcons/googleicons.css">
        <link rel="stylesheet" href="@{ASSETS_PATH}fonts/FontAwesome/fontawesome.min.css">
        <link rel='stylesheet' href='@{ASSETS_PATH}fonts/Roboto/Roboto.css'>
        <link rel='stylesheet' href='@{ASSETS_PATH}fonts/NeoSansArabic/NeoSansArabic.css'>
    </head>
    <body>
        @{$body}
    </body>

    <script src="@{JS_PATH}footer.js"></script>
</html>