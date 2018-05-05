<?php require_once 'php/conn.php';?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Download XML</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <style>
            body {
                padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
            }
        </style>
        <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="index.php">MJDownload XML</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a href="javascript::" onclick="load_page('ver_nfe.php');">NFe Armazenadas</a></li>
                            <li><a href="javascript::" onclick="load_page('buscar_nfe.php');">Buscar NFe</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container">
            <div id="pagina_retorno">
                <h1>Download XMl v1.0</h1>
            </div>
            <div class="load" style="display: none;"><img src="img/load.gif" alt=""/></div>
        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="bootstrap/js/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript">
            function load_page(arquivo) {
                if (arquivo) {
                    $.ajax({
                        type: 'POST',
                        data: '',
                        url: arquivo,
                        success: function (data) {
                            $("#pagina_retorno").html(data);
                        }
                    });
                }
            }
            function load_in(){
                $('.load').fadeIn("fast");
            }
            function load_out(){
                $('.load').fadeOut("fast");
            }
        </script>
    </body>
</html>
