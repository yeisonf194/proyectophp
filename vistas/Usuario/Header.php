<?php
require '../../Config/Conexion.php';
?>
<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>EventosGuatoc</title>
      <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <link href="../../css/agency.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <link rel="icon" type="image/png" href="../../img/icon.png"/>
    </head>
  <body id="page-top">

    <!-- Barra lateral -->
    <div id="wrapper">
      <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Index.php">
          <div class="sidebar-brand-icon">
            <img src="../../img/iwhite.png" alt="EventosGuatoc" width="35px">
          </div>  
          <div class="sidebar-brand-text mx-3"></div>
        </a>
        <hr class="sidebar-divider my-0">
        <hr class="sidebar-divider">
        <div class="sidebar-heading"></div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-newspaper"></i>
          <span>Noticias</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-file-invoice"></i>
          <span>Pagos</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>
    

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#modelId">
        <i class="far fa-calendar-alt"></i>
          <span>Eventos</span></a>
      </li>
          <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Eventos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <?php
          $idusuario=$_SESSION['idusuario'];
          $consulta=mysqli_query($conexion,"SELECT e.idevento as idevento FROM evento e, usuario u WHERE u.idusuario=$idusuario AND u.idusuario=e.idusuario");
          // if(empty($consulta)){
          if(empty($_SESSION['eventos'])){
          ?>
            
          <?php
          }else{
            foreach($_SESSION['evento'] as $indice=>$producto){
              $evento=$producto['tipoevento'];
              $entrega=$producto['fechaentrega'];
              $asistentes=$producto['asistentes'];
              $categoria=$producto['categoria'];
              $tipoevento=$producto['idtipoevento'];
          }
          ?>
          <div class="modal-body text-center">
            <h5 class="text-center ">Evento <?php 
            $consulta = mysqli_query($conexion, "SELECT * FROM tipoevento WHERE idtipoevento=$tipoevento");
            while($mostrar=mysqli_fetch_array($consulta)){
              echo $mostrar['nombre'].' '.$mostrar['categoria'];
            ?></h5>
            <p class="text-secondary"><img src="../../img/loading3.gif" width="20%" alt=""> En proceso <a href="Contratar.php?pagina=contratar" class="btn btn-secondary ml-5"><i class="fas fa-arrow-right"></i></a></p>
            <hr>
          </div>
          <?php
            }
          }
          $idusuario=$_SESSION['idusuario'];
          $consulta=mysqli_query($conexion,"SELECT e.idevento as idevento FROM evento e, usuario u WHERE u.idusuario=$idusuario AND u.idusuario=e.idusuario");
          if(!$consulta){
            ?>
            <div class="modal-body text-center">
            <h5 class="text-center">Aun no tienes Eventos</h5><br>
          </div>
            <?php
          }else{
            $consulta=mysqli_query($conexion,"SELECT t.nombre as nombre, t.categoria as categoria FROM evento e, usuario u, tipoevento t WHERE u.idusuario=$idusuario AND u.idusuario=e.idusuario AND e.idtipoevento=t.idtipoevento");
            while($mostrar=mysqli_fetch_array($consulta)){
            ?>
            <p class="text-center text-muted">Contratados</p>
            <h6 class="text-center">Evento <?php echo $mostrar['nombre'].' '.$mostrar['categoria']?></h6>
             
            <?php
            }
          }
          ?>
          <div class="row justify-content-center">
          <div class="col-3 text-center mt-3">
              <a data-toggle="modal" data-target="#agregarevento" class="btn btn-primary text-white">Nuevo</a>
            </div>
          <div class="col-3 modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
          </div>
          
        </div>
      </div>
    </div>


    <!-- Modal Agregar Evento -->
    <div class="portfolio-modal modal fade" id="agregarevento" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- Project Details Go Here -->
                <h2 class="text-uppercase">Agregar Evento</h2>
                <p class="item-intro text-muted">No hay que dejar nada al azar.</p>
                <img class="img-fluid d-block mx-auto" src="img/portfolio/05-full.jpg" alt="">
                <p>Necesitamos saber que tipo de evento deseas realizar, por favor indicanos el numero de asistentes y la fecha para la cual deseas la realizacion de tu evento.</p>
                <form  method="POST" action="../../Modelos/Usuario.php?op=agregarEvento" style="background-color: rgba(0,0,0,0.1); border-radius:20px; padding: 40px; width:100%">
                <div class="row">
                  <div class="col-sm-12 col-lg-6">
                      <p>
                      <label for="name" class="text-white"><h5 class="text-secondary">Que tipo de evento deseas</h5></label>
                      <select name="tipoevento" style="border-radius:5px; color:#424141; width: 100%" required>
                      <?php
                        $consulta=mysqli_query($conexion, "SELECT DISTINCT nombre FROM tipoevento WHERE condicion=1");
                        while($mostrar=mysqli_fetch_array($consulta)){
                      ?>
                      <option value="<?php echo $mostrar['nombre'] ?>"><?php echo $mostrar['nombre']?></option>
                      <?php
                        }
                      ?>
                      </select>
                      </p>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                      <p>
                      <label for="fechaentrega"><h5 class="text-secondary">Fecha de realizacion</h5></label>
                      <input type="date" name="fechaentrega" style="border-radius:5px; color:#424141; width: 100%" required>
                      </p>
                    </div>
                    <div class="col-sm-12 col-lg-12">
                      <p>
                      <label for="asistentes"><h5 class="text-secondary">Numero de invitados</h5></label>
                      <input type="text" name="asistentes" style="border-radius:5px; color:#424141; width: 100%" required>
                      </p><br>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Siguiente</button></p>
                </form><br>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>




      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-table"></i>
          <span>Perfil</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>

    









    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 text-gray-600 small"><?php echo $_SESSION["Nombre"]?></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../../Modelos/Registrar.php?op=salir" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar Sesion
                </a>
              </div>
            </li>

          </ul>

        </nav>
        
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          

          <!-- Content Row -->
          <div class="row">
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Realmente deseas abandonar EventosGuatoc?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">Confirma si deseas cerrar tu sesion</div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                      <a class="btn btn-primary" href="../../Modelos/Registrar.php?op=salir">Cerrar Sesion</a>
                    </div>
                  </div>
                </div>
              </div>

            </div>
