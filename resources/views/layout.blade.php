<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="<?= gmdate('D, d M Y H:i:s').' GMT' ?>">

    <title>Education - @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="css/app.css" rel="stylesheet"> -->
    <style>
    {!! file_get_contents(public_path('css/layout.css')) !!}
    </style>
  </head>

  <body>
    <div class="container">
        @yield('contents')
    </div>
    <!--
    ==================================================
    Placed at the end of the document so the pages load faster
    -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="{{url('js/sidemenu.js')}}" type="text/javascript"></script>
    </script>
  </body>
</html>
