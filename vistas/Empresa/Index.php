<?php
session_start();
if(!isset($_SESSION["tipo"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:Login.php");
}else{
require 'Header.php'; 
require '../../Config/Conexion.php';
?>
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pedidos</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                        <?php $idempresa=$_SESSION["idempresa"];
                        $idempresa=$_SESSION["idempresa"];
                        switch($idempresa){
                            case '4':
                                $consulta="SELECT COUNT(p.idfotografia) as conteo FROM fotografia s, pedido p, empresa e WHERE p.idfotografia=s.idfotografia AND s.idempresa=e.idempresa AND s.idempresa=$idempresa";
                                $resul=$conexion->query($consulta);
                                $resultado=$resul->fetch_assoc();
                                $conteo=$resultado["conteo"];
                            break;
                            case '5':
                                $consulta="SELECT COUNT(p.idsalon) as conteo FROM salon s, pedido p, empresa e WHERE p.idsalon=s.idsalon AND s.idempresa=e.idempresa AND s.idempresa=$idempresa";
                                $resul=$conexion->query($consulta);
                                $resultado=$resul->fetch_assoc();
                                $conteo=$resultado["conteo"];
                            break;
                            case '6':
                                $consulta="SELECT COUNT(p.idanimacion) as conteo FROM animacion s, pedido p, empresa e WHERE p.idanimacion=s.idanimacion AND s.idempresa=e.idempresa AND s.idempresa=$idempresa";
                                $resul=$conexion->query($consulta);
                                $resultado=$resul->fetch_assoc();
                                $conteo=$resultado["conteo"];
                            break;
                            default:
                                $consulta="SELECT COUNT(idproducto) as conteo FROM servicio WHERE idempresa=$idempresa";
                                $resul=$conexion->query($consulta);
                                $resultado=$resul->fetch_assoc();
                                $conteo=$resultado["conteo"];
                            break;
                        }
                        ?> 
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Tiene <?php echo $conteo ?> pedidos</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                    <?php if($conteo>0)
                    {
                    ?>
                    <a data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-arrow-circle-right text-info h1"></i></a>
                    <?php
                    } ?>
                      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="row my-3 mx-4 p-3">
                              <div class="col-12"><h1 class="text-center">Pedidos</h1></div><hr>
                              <?php
                              $consulta=1;
                              switch($idempresa){
                                case '4':
                                  $empresa='fotografia';
                                  $servicio='idfotografia';
                                  $precio='preciofotografia';
                                  $consulta=1;
                                break;
                                case '5':
                                  $empresa='salon';
                                  $servicio='idsalon';
                                  $precio='preciosalon';
                                  $consulta=1;
                                break;
                                case '6':
                                  $empresa='animacion';
                                  $servicio='idanimacion';
                                  $precio='precioanimacion';
                                  $consulta=1;
                                break;
                                default:
                                $empresa='servicio';
                                $servicio='idservicio';
                                $consulta=2;
                                break;
                              }
                              if($consulta==1){
                                $resultado = mysqli_query($conexion, "SELECT	  u.nombre, u.apellido, t.nombre as evento,e.idevento, p.$precio as precio, e.cantidadpersonas,f.imagen, t.categoria, e.fechareserva, e.fechaentregahora, f.nombre as servicio 
                                                                      FROM	    usuario u, evento e, tipoevento t, pedido p, $empresa f, empresa em 
                                                                      WHERE	    e.idusuario=u.idusuario AND e.idtipoevento=t.idtipoevento AND p.idevento=e.idevento AND p.$servicio=f.$servicio AND f.idempresa=em.idempresa AND em.idempresa=$idempresa");
                              }else{
                                $resultado = mysqli_query($conexion, "SELECT	  u.nombre, u.apellido, t.nombre as evento, t.categoria, e.cantidadpersonas, e.fechareserva, e.idevento as idevento, e.fechaentregahora, s.precio as precio, pro.nombre as servicio, pro.imagen
                                                                      FROM	    usuario u, evento e, tipoevento t, pedido p, servicio s, empresa em, producto pro
                                                                      WHERE	    e.idusuario=u.idusuario AND e.idtipoevento=t.idtipoevento AND p.idevento=e.idevento AND p.idpedido=s.idpedido AND s.idempresa=em.idempresa AND em.idempresa=pro.idempresa AND pro.idproducto=s.idproducto AND em.idempresa=$idempresa ORDER BY e.fechaentregahora asc");
                              }
                              while($mostrar=mysqli_fetch_array($resultado)){
                              ?>
                              <div id="accordianId" role="tablist" aria-multiselectable="true" style="width:100%">
                                <div class="card mb-5">
                                  <div class="card-header" role="tab" id="section1HeaderId">
                                    <div class="row">
                                      <div class="col-sm-12 col-lg-10 mt-5">
                                        <h6><?php echo $mostrar['nombre'].' '.$mostrar['apellido'] ?></h6>
                                        <p>Ha contratado el servicio <b><?php echo $mostrar['servicio']?></b> para el evento tipo <?php echo $mostrar['evento'].' '.$mostrar['categoria'] ?></p>
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
                                        <div class="col-md-4">Producto:</div>
                                        <div class="col-md-8"><img src="../../productos/<?php echo $mostrar['imagen']?>" width="70%" alt=""><hr></div>
                                      </div>
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
                                        <div class="col-md-8"><h6>$<?php echo number_format($mostrar['precio'], 0, ',', '.') ?></h6><hr></div>
                                      </div>
                                    </div>
                                  </div>
                                  <p class="text-right"><span class="text-muted mr-3"><?php echo $mostrar['fechareserva']?></p>
                                </div>  
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
              </div>
            </div>


<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Proximo Pedido</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                        <?php
                        ini_set('date.time','America/Bogota');
                        $fechaactual = date('Y-m-d', time());
                        $idempresa=$_SESSION["idempresa"];
                        switch($idempresa){
                            case '4':
                              $resul=$conexion->query("SELECT MIN(e.fechaentregahora) as fechaactual FROM evento e, pedido p,$empresa s, empresa em WHERE p.idevento=e.idevento AND p.$servicio=s.$servicio AND s.idempresa=em.idempresa AND em.idempresa=$idempresa ORDER BY fechaentregahora asc");
                              $key=$resul->fetch_assoc();
                              $proximo=$key["fechaactual"];
                            break;
                            case '5':
                              $resul=$conexion->query("SELECT MIN(e.fechaentregahora) as fechaactual FROM evento e, pedido p,$empresa s, empresa em WHERE p.idevento=e.idevento AND p.$servicio=s.$servicio AND s.idempresa=em.idempresa AND em.idempresa=$idempresa ORDER BY fechaentregahora asc");
                              $key=$resul->fetch_assoc();
                              $proximo=$key["fechaactual"];
                            break;
                            case '6':
                              $resul=$conexion->query("SELECT MIN(e.fechaentregahora) as fechaactual FROM evento e, pedido p,$empresa s, empresa em WHERE p.idevento=e.idevento AND p.$servicio=s.$servicio AND s.idempresa=em.idempresa AND em.idempresa=$idempresa ORDER BY fechaentregahora asc");
                              $key=$resul->fetch_assoc();
                              $proximo=$key["fechaactual"];
                            break;
                            default:
                              $resul=$conexion->query("SELECT MIN(e.fechaentregahora) as fechaactual FROM evento e, pedido p, servicio s, empresa em WHERE p.idevento=e.idevento AND p.idpedido=s.idpedido AND s.idempresa=em.idempresa AND em.idempresa=$idempresa  ORDER BY fechaentregahora asc");
                              $key=$resul->fetch_assoc();
                              $proximo=$key["fechaactual"];
                            break;
                        }
                        $resta=$conexion->query("SELECT TIMESTAMPDIFF(day, '$fechaactual', '$proximo') as fecha");
                            $consul=$resta->fetch_assoc();
                            $restado=$consul["fecha"];
                        if($conteo<0){
                        ?> 
                          <div class="mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $restado ?> dias para proxima entrega</div>
                        <?php
                        }else{
                          ?>
                          <div class="mb-0 mr-3 font-weight-bold text-gray-800">No tiene pedidos</div>
                          <?php
                        }
                        ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                    <?php if($conteo>0)
                    {
                    ?>
                    <a data-toggle="modal" data-target="#proximos"><i class="fas fa-arrow-circle-right text-danger h1"></i></a>
                    <?php
                    } ?>
                      <div class="modal fade" id="proximos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="row my-3 mx-4 p-3">
                              <div class="col-12"><h1 class="text-center">Pedidos</h1></div><hr>
                              <?php
                              if($consulta==1){
                                $resultado = mysqli_query($conexion, "SELECT	  u.nombre, u.apellido, t.nombre as evento,e.idevento, p.$precio as precio, e.cantidadpersonas,f.imagen, t.categoria, e.fechareserva, e.fechaentregahora, f.nombre as servicio 
                                                                      FROM	    usuario u, evento e, tipoevento t, pedido p, $empresa f, empresa em 
                                                                      WHERE	    e.idusuario=u.idusuario AND e.idtipoevento=t.idtipoevento AND p.idevento=e.idevento AND e.fechaentregahora='$proximo' AND p.$servicio=f.$servicio AND f.idempresa=em.idempresa AND em.idempresa=$idempresa ORDER BY e.fechaentregahora asc");
                              }else{
                                $resultado = mysqli_query($conexion, "SELECT	  u.nombre, u.apellido, t.nombre as evento, t.categoria, e.cantidadpersonas, e.fechareserva, e.idevento as idevento, e.fechaentregahora, e.precio, pro.nombre as servicio, pro.imagen
                                FROM	    usuario u, evento e, tipoevento t, pedido p, servicio s, empresa em, producto pro
                                WHERE	    e.idusuario=u.idusuario AND e.idtipoevento=t.idtipoevento AND p.idevento=e.idevento AND e.fechaentregahora='$proximo' AND p.idpedido=s.idpedido AND s.idempresa=em.idempresa AND em.idempresa=pro.idempresa AND pro.idproducto=s.idproducto AND em.idempresa=$idempresa ORDER BY e.fechaentregahora asc");
                              }
                              while($mostrar=mysqli_fetch_array($resultado)){
                              ?>
                              <div id="accordianId" role="tablist" aria-multiselectable="true" style="width:100%">
                                <div class="card mb-5">
                                  <div class="card-header" role="tab" id="section1HeaderId">
                                    <div class="row">
                                      <div class="col-sm-12 col-lg-10 mt-5">
                                        <h6><?php echo $mostrar['nombre'].' '.$mostrar['apellido'] ?></h6>
                                        <p>Ha contratado el servicio <b><?php echo $mostrar['servicio']?></b> para el dia <b class="text-danger"><?php echo $mostrar['fechaentregahora']?></b></p>
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
                                        <div class="col-md-4">Producto:</div>
                                        <div class="col-md-8"><img src="../../productos/<?php echo $mostrar['imagen']?>" width="70%" alt=""><hr></div>
                                      </div>
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
                                        <div class="col-md-8"><h6>$<?php echo number_format($mostrar['precio'], 0, ',', '.') ?></h6><hr></div>
                                      </div>
                                    </div>
                                  </div>
                                  <p class="text-right"><span class="text-muted mr-3"><?php echo $mostrar['fechareserva']?></p>
                                </div>  
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
              </div>
            </div>


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Ventas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                      switch($idempresa){
                        case '4':
                          $resta=$conexion->query("SELECT SUM(preciofotografia) as total FROM pedido");
                          $consul=$resta->fetch_assoc();
                          $total=$consul["total"];
                        break;
                        case '5':
                          $resta=$conexion->query("SELECT SUM(preciosalon) as total FROM pedido");
                          $consul=$resta->fetch_assoc();
                          $total=$consul["fecha"];
                        break;
                        case '6':
                          $resta=$conexion->query("SELECT SUM(precioanimacion) as total FROM pedido");
                          $consul=$resta->fetch_assoc();
                          $total=$consul["fecha"];
                        break;
                        default:
                          $resta=$conexion->query("SELECT SUM(se.precio) as total FROM servicio se, empresa em WHERE em.idempresa=se.idempresa AND se.idempresa=$idempresa");
                          $consul=$resta->fetch_assoc();
                          $total=$consul["total"];
                        break;
                    }
                    echo '$'.number_format($total, 0, ',', '.') ;
                      ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          


        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Content Row -->

          <div class="row">

          

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
                          $noticiasparticulares = mysqli_query($conexion, "SELECT * FROM noticias WHERE idempresa=$idempresa AND condicion=1 AND destino='empresa'");
                        while($mostrar=mysqli_fetch_array($noticiasparticulares)){
                          ?>
                          <div class="col-12 p-4 border-left-danger mb-3 shadow h-100">
                          <p><?php echo $mostrar['noticia']?></p>
                          </div>
                          <?php
                        }
                        $noticiasgenerales = mysqli_query($conexion, "SELECT * FROM noticias WHERE condicion=0 AND destino='empresa'");
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
<?php
}
require '../Shared/Footer.php'; 
?>
