<?php
session_start();
if(!isset($_SESSION["rol"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../Shared/Login.php");
}else{
require 'Header.php'; 
require '../../Config/Conexion.php';
ini_set('date.time','America/Bogota');
$fechaactual = date('Y-m-d', time());                        
$idusuario=$_SESSION["idusuario"];
$rol=$_SESSION['rol'];
$consulta=0;
$resul=$conexion->query("SELECT COUNT(idevento) as conteo, MIN(fechaentregahora) as fechaactual FROM evento ORDER BY fechaentregahora asc");
$key=$resul->fetch_assoc();
$proximo=$key["fechaactual"];
$conteo=$key["conteo"];
$consulta=1;
$resta=$conexion->query("SELECT TIMESTAMPDIFF(day, '$fechaactual', '$proximo') as fecha");
$consul=$resta->fetch_assoc();
$restado=$consul["fecha"];
?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Proximos 
                      </div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                        <?php
                        if($conteo<1){
                          ?>
                            <div class="mb-0 mr-3 font-weight-bold text-gray-800">No hay eventos</div>
                            </div>
                      </div>

                          <?php
                        }else{
                        ?> 
                          <div class="mb-0 mr-3 font-weight-bold text-gray-800"><?php echo 
                            ini_set('date.time','America/Bogota');
                            $fechaactual = date('Y-m-d', time());
                            $resul=$conexion->query("SELECT MIN(e.fechaentregahora) as fechaactual FROM evento e, usuario u WHERE u.idusuario=e.idusuario AND fechaentregahora>='$fechaactual' ORDER BY fechaentregahora asc");
                            $key=$resul->fetch_assoc();
                            $proximo=$key["fechaactual"];
                            $iniciando=$conexion->query("SELECT COUNT(e.idevento) as conteo FROM evento e, usuario u WHERE u.idusuario=e.idusuario");
                            $contador=$iniciando->fetch_assoc();
                            $conteo=$contador["conteo"];
                            $resta=$conexion->query("SELECT TIMESTAMPDIFF(day, '$fechaactual', '$proximo') as fecha");
                            $consul=$resta->fetch_assoc();
                            $restado=$consul["fecha"];
                            echo $restado;
                          ?> dias para proxima entrega</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                    <a data-toggle="modal" data-target="#proximos"><i class="fas fa-arrow-circle-right text-danger h1"></i></a>
                    <?php
                    } ?>
                      <div class="modal fade" id="proximos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="row my-3 mx-4 p-3">
                              <div class="col-12"><h1 class="text-center">Pedidos</h1></div><hr>
                              <?php
                                $resultado = mysqli_query($conexion, "SELECT	  u.nombre, u.apellido, t.nombre as evento,e.idevento, p.$precio as precio, e.cantidadpersonas,f.imagen, t.categoria, e.fechareserva, e.fechaentregahora, f.nombre as servicio 
                                                                      FROM	    usuario u, evento e, tipoevento t, pedido p, $empresa f, empresa em 
                                                                      WHERE	    e.idusuario=u.idusuario AND e.idtipoevento=t.idtipoevento AND p.idevento=e.idevento AND e.fechaentregahora='$proximo' AND p.$servicio=f.$servicio AND f.idempresa=em.idempresa AND em.idempresa=$idempresa ORDER BY e.fechaentregahora asc");
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
                                        <div class="col-md-8"><h6><?php echo $mostrar['precio']?></h6><hr></div>
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
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pedidos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Tiene <?php echo $conteo?> pedidos</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tareas</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tareas Pendientes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>





        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Content Row -->

          <div class="row">

          <!-- Area de informacion -->
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Panel</h6>
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
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>


          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>

              <!-- Color System -->
              <div class="row">
                <div class="col-lg-6 mb-4">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      Primary
                      <div class="text-white-50 small">#4e73df</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                      Success
                      <div class="text-white-50 small">#1cc88a</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-info text-white shadow">
                    <div class="card-body">
                      Info
                      <div class="text-white-50 small">#36b9cc</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                      Warning
                      <div class="text-white-50 small">#f6c23e</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                      Danger
                      <div class="text-white-50 small">#e74a3b</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-secondary text-white shadow">
                    <div class="card-body">
                      Secondary
                      <div class="text-white-50 small">#858796</div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
                  </div>
                  <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
                  <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
                </div>
              </div>

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                  <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
                  <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
                </div>
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
