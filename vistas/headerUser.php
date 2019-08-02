<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EventosGuatoc</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../public/css/stilos.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="icon" type="image/png" href="../public/img/icon.png"/>
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../public/datatables/buttons.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="../public/datatables/responsive.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
  </head>
  <body style="background-image: url(../public/img/bkg.jpg); background-repeat: no-repeat; box-sizing: border-box; background-size: 100% 100%; background-size: cover;">
  <header class="row mb-5 fixed-top">
          <nav class="fixed-top navbar navbar-expand-lg menu">
                <div class="container">
                        <a class="navbar-brand logo text-white" href="index.php">EventosGuatoc</a>
                        <div class="collapse navbar-collapse" id="collapsibleNavId">
                            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" style="color:#3a3a3a" href="#"> Notificaciones</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link enlaces" href="#servicio">Calendario</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link enlaces" href="tipoevento.php">Ofertas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link enlaces" href="#contacto">Notificaciones</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" style="color:#3a3a3a" href="#">esNotificaciones</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link enlaces" href="registro.php"><span class="hidden-xs"><?php echo $_SESSION["nombre"]?></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link enlaces" href="../ajax/usuario.php?op=salir">Cerrar Sesion</a>
                                </li>
                            </ul>
                        </div>
                </div>
          </nav>
        </header><br>