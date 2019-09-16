<?php
session_start();
if(!isset($_SESSION["Nombre"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../Shared/Login.php");
}else{
require 'Header.php'; 
require '../../Config/Conexion.php';
ini_set('date.time','America/Bogota');
$fechaactual = date('Y-m-d', time());                        
$idusuario=$_SESSION["idusuario"];
$rol=$_SESSION['rol'];
$resul=$conexion->query("SELECT MIN(e.fechaentregahora) as fechaactual FROM evento e, usuario u WHERE u.idusuario=e.idusuario AND u.idusuario=$idusuario ORDER BY fechaentregahora asc");
$key=$resul->fetch_assoc();
$proximo=$key["fechaactual"];
$iniciando=$conexion->query("SELECT COUNT(e.idevento) as conteo FROM evento e, usuario u WHERE u.idusuario=e.idusuario AND u.idusuario=$idusuario");
$contador=$iniciando->fetch_assoc();
$conteo=$contador["conteo"];
$resta=$conexion->query("SELECT TIMESTAMPDIFF(day, '$fechaactual', '$proximo') as fecha");
$consul=$resta->fetch_assoc();
$restado=$consul["fecha"];
$pedido=$conexion->query("SELECT u.nombre, u.apellido, e.fechareserva, e.fechaentregahora, p.idpedido, p.idfotografia, p.idsalon as idsalon, p.idanimacion 
                          FROM usuario u, evento e, pedido p 
                          WHERE u.idusuario=e.idusuario AND e.idevento=p.idevento AND u.idusuario=$idusuario AND e.fechaentregahora='$proximo'");
$consultar=$pedido->fetch_assoc();
$fotografia=$consultar["idfotografia"];
$salon=$consultar["idsalon"];
$animacion=$consultar["idanimacion"];
?>
<div class="container-fluid">
<div class="section row mb-3">
  <div class="article col">
    <div class="row">



      <!-- Proximos -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Proximos</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="row">
                      <div class="col-1"><i class="far fa-clock fa-2x text-gray-500"></i></div>
                      <div class="col-9 ml-3 text-center"><?php if($conteo<1){ ?>
                        <div class="mb-0 mr-3 font-weight-bold text-gray-800">Aun no hay Eventos</div>
                        <?php }else{ ?>
                        <div class="mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $restado?> dias para tu evento</div><?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-2">
                <a data-toggle="modal" data-target="#proximos"><i class="fas fa-arrow-circle-right text-danger h1"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pedidos -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pedidos</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="row">
                      <div class="col-1"><i class="fas fa-clipboard-list fa-2x text-gray-500"></i></div>
                      <div class="col-9 ml-3 text-center"><?php if($conteo<1){ ?>
                        <div class="mb-0 mr-3 font-weight-bold text-gray-800">Aun no hay Eventos</div>
                        <?php }else{ ?>
                        <div class="mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $conteo?> pedidos en lista</div><?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-2">
                <a data-toggle="modal" data-target="#pedidos"><i class="fas fa-arrow-circle-right text-success h1"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Saldo -->
      <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Saldo</div>
                      <div class="row">
                      <div class="col-1">
                      <i class="fas fa-dollar-sign fa-2x text-gray-500"></i>
                    </div>
                    <div class="col-10 mb-0 font-weight-bold text-gray-800">Saldo: $<?php
                      $resul=$conexion->query("SELECT e.precio, e.idevento, e.saldo, e.abono FROM evento e, usuario u WHERE u.idusuario=e.idusuario AND u.idusuario=$idusuario AND fechaentregahora='$proximo'");
                      $key=$resul->fetch_assoc();
                      $idevento=$key["idevento"];
                      $total=$key["precio"];
                      $saldo=$key["saldo"];
                      $abono=$key["abono"];
                      echo number_format($saldo, 0, ',', '.') ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

                          
    
    
      <!-- Progreso -->
      <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pagos</div>
                      <div class="row no-gutters align-items-center">
                        <div class="h5 col-auto font-weight-bold mr-3">
                        <?php
                          if($abono==0){
                            echo '0';
                            ?>
                            % 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width:0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                            <?php
                          }else{
                            $porcentaje=($abono*100)/$total;
                            echo number_format($porcentaje, 0);
                            ?>%
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width:<?php echo number_format($porcentaje, 0)?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                            <?php
                          }
                        ?>
                          
                    <div class="col-auto mt-3">
                      <i class="fas fa-percentage fa-2x text-gray-500"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

    </div>

              <!-- Modal proximo -->
            <div class="modal fade" id="proximos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="row my-3 mx-4 p-3">
                    <div class="col-12"><h1 class="text-center">Proximo</h1></div><hr>
                    <?php
                     $resultado=mysqli_query($conexion,"SELECT 		t.nombre as evento, t.categoria, e.idevento, e.idusuario, e.cantidadpersonas, e.fechaentregahora, e.fechareserva, e.precio, e.abono, e.saldo
                                                        FROM 		usuario u, tipoevento t, evento e 
                                                        WHERE 		u.idusuario=e.idusuario AND t.idtipoevento=e.idtipoevento AND u.idusuario=$idusuario AND e.fechaentregahora='$proximo'");
                    while($mostrar=mysqli_fetch_array($resultado)){ ?>
                      <div id="accordianId" role="tablist" aria-multiselectable="true" style="width:100%">
                        <div class="card mb-5">
                          <div class="card-header" role="tab" id="section1HeaderId">
                            <div class="row">
                              <div class="col-sm-12 col-lg-10 mt-5">
                                <h6>Evento: <?php echo $mostrar['evento']?></h6>
                                <p>Has contratado el evento tipo <?php echo $mostrar['evento'].' '.$mostrar['categoria']?></p>
                              </div>
                              <div class="col-sm-12 col-lg-2 text-right">
                                <p class="text-muted">Detalles</p>
                                <p><a class="btn btn-secondary" data-toggle="collapse" data-parent="#accordianId" href="#evento<?php echo $mostrar['idevento']?>" aria-expanded="true" aria-controls="section1ContentId"><i class="fas fa-plus"></i></a></p>
                              </div>
                            </div>
                          </div>
                          <div id="evento<?php echo $mostrar['idevento']?>" class="collapse in" role="tabpanel" aria-labelledby="evento<?php echo $mostrar['idevento']?>">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-4">Fecha Realizacion:</div>
                                <div class="col-md-8"><?php echo $mostrar['fechaentregahora']?><hr></div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">Asistentes:</div>
                                <div class="col-md-8"><?php echo $mostrar['cantidadpersonas']?><hr></div>
                              </div>
                              <div class="row">
                                <div class="col-md-4"><h6>Total:</h6></div>
                                <div class="col-md-8"><h6>$<?php echo number_format($mostrar['precio'], 0, ',', '.')?></h6><hr></div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">Abono:</div>
                                <div class="col-md-8">$<?php echo number_format($mostrar['abono'], 0, ',', '.')?><hr></div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">Saldo:</div>
                                <div class="col-md-8">$<?php echo number_format($mostrar['saldo'], 0, ',', '.')?><hr></div>
                              </div>
                            </div>
                          </div>
                          <p class="text-right"><span class="text-muted mr-3"><?php echo $mostrar['fechareserva']?></p>
                        </div>  
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- Final  Modal -->


              <!-- Modal eventos -->
              <div class="modal fade" id="pedidos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="row my-3 mx-4 p-3">
                    <div class="col-12"><h1 class="text-center">Proximo</h1></div><hr>
                    <?php
                     $resultado=mysqli_query($conexion,"SELECT 	t.nombre as evento, t.categoria, e.idevento, e.idusuario, e.cantidadpersonas, e.fechaentregahora, e.fechareserva, e.precio, e.abono, e.saldo 
                                                        FROM 		usuario u, tipoevento t, evento e 
                                                        WHERE 		u.idusuario=e.idusuario AND t.idtipoevento=e.idtipoevento AND u.idusuario=$idusuario");
                    while($mostrar=mysqli_fetch_array($resultado)){ ?>
                      <div id="accordianId" role="tablist" aria-multiselectable="true" style="width:100%">
                        <div class="card mb-5">
                          <div class="card-header" role="tab" id="section1HeaderId">
                            <div class="row">
                              <div class="col-sm-12 col-lg-10 mt-5">
                                <h6>Evento: <?php echo $mostrar['evento']?></h6>
                                <p>Has contratado el evento tipo <?php echo $mostrar['evento'].' '.$mostrar['categoria']?></p>
                              </div>
                              <div class="col-sm-12 col-lg-2 text-right">
                                <p class="text-muted">Detalles</p>
                                <p><a class="btn btn-secondary" data-toggle="collapse" data-parent="#accordianId" href="#evento<?php echo $mostrar['idevento']?>" aria-expanded="true" aria-controls="section1ContentId"><i class="fas fa-plus"></i></a></p>
                              </div>
                            </div>
                          </div>
                          <div id="evento<?php echo $mostrar['idevento']?>" class="collapse in" role="tabpanel" aria-labelledby="evento<?php echo $mostrar['idevento']?>">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-4">Fecha Realizacion:</div>
                                <div class="col-md-8"><?php echo $mostrar['fechaentregahora']?><hr></div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">Asistentes:</div>
                                <div class="col-md-8"><?php echo $mostrar['cantidadpersonas']?><hr></div>
                              </div>
                              <div class="row">
                                <div class="col-md-4"><h6>Total:</h6></div>
                                <div class="col-md-8"><h6>$<?php echo number_format($mostrar['precio'], 0, ',', '.')?></h6><hr></div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">Abono:</div>
                                <div class="col-md-8">$<?php echo number_format($mostrar['abono'], 0, ',', '.')?><hr></div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">Saldo:</div>
                                <div class="col-md-8">$<?php echo number_format($mostrar['saldo'], 0, ',', '.')?><hr></div>
                              </div>
                              
                            </div>
                          </div>
                          <p class="text-right"><span class="text-muted mr-3"><?php echo $mostrar['fechareserva']?></p>
                        </div>  
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- Final  Modal -->


  </div>
</div>
<div class="section row">
  <div class="article col">
  <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Noticias</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row">
                    
                        <?php
                          $noticiasparticulares = mysqli_query($conexion, "SELECT * 
                                                                            FROM noticias 
                                                                            WHERE idusuario=$idusuario AND condicion=1 AND destino='cliente'
                                                                            ORDER BY idnoticias DESC");
                        while($mostrar=mysqli_fetch_array($noticiasparticulares)){
                          ?>
                          <div class="col-12 p-4 border-left-danger mb-3 shadow h-100">
                          <p><?php echo $mostrar['noticia']?></p>
                          </div>
                          <?php
                        }
                        $noticiasgenerales = mysqli_query($conexion, "SELECT * FROM noticias WHERE condicion=0 AND destino='cliente'");
                        while($mostrar=mysqli_fetch_array($noticiasgenerales)){
                          ?>
                          <div class="col-12 p-4 border-left-warning mb-3 shadow h-100">
                          <p><?php echo $mostrar['noticia']?></p>
                          </div>
                          <?php
                        }
                        ?>
                    
                  </div>
                </div>
              </div>
            </div>
  </div>
</div>

</div> 
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<?php
}
require '../Shared/Footer.php'; 
?>
