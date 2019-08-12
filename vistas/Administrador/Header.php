<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>EventosGuatoc</title>
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/agency.min.css" rel="stylesheet">
  <link href="../../css/stilos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="../../img/icon.png"/>
</head>
<body id="page-top" style="text-align: center; color: white; background-image: url(../../img/black.png); background-repeat: no-repeat; background-attachment: scroll; background-position: center center; background-size: cover">
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" style="background: -webkit-linear-gradient(top,  rgba(0,0,0,255) 30%,rgba(0,0,0,0) 100%)">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="../Index.php">EventosGuatoc</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="Empresa/Index.php">Empresas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="Evento/Index.php">Eventos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger mr-5" href="Servicio/Index.php">Servicios</a>
          </li>
          <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="../Usuario/Registro.php"><span class="hidden-xs"><?php echo $_SESSION["rol"]?></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="../../Modelos/Registrar.php?op=salir">Cerrar Sesion</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>