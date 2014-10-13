<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Лабораторная работа по БД №2</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/navbar.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/jquery.ui.timepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui-1.10.0.custom.min.css" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <noscript>
    <div class="wrap-noscript">
        <div class="noscript">
            <p>
                В вашем браузере отключен javascript!<br/>
                Включите javascript, иначе приложение работать не будет!
            </p>
        </div>
    </div>
    </noscript>
    <div class="container">

      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <!--
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Лабораторная работа №2</a>
          </div> -->
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a id="flight" class="menu" href="#">Рейсы</a></li>
              <li><a id="passenger" class="menu" href="#">Пассажиры</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Редактирование <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a id="flight_edit" class="menu" href="#">Рейсы</a></li>
                  <li><a id="passenger_edit" class="menu" href="#">Пассажиры</a></li>
                  <li><a id="ticket_edit" class="menu" href="#">Билеты</a></li>
                  <!--
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>-->
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <!--
              <li><a href="./">Default</a></li>
              <li><a href="../navbar-static-top/">Static top</a></li> -->
              <li><a href="modules/lab1.php">SQL</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>

      <!-- Main component for a primary marketing message or call to action -->
      <div id="data" class="jumbotron">
        
        <img class="preload" src="img/725.gif"/>
        
      </div>

    </div> <!-- /container -->

    
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="js/jquery.ui.widget.min.js"></script>
    <script type="text/javascript" src="js/jquery.ui.tabs.min.js"></script>
    <script type="text/javascript" src="js/jquery.ui.position.min.js"></script>
    <script type="text/javascript" src="js/jquery.ui.timepicker.js"></script>
    <script type="text/javascript" src="js/jquery-ui.1.10.4.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>