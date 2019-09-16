<?php
session_start();
if(!isset($_SESSION["rol"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../../Shared/Login.php");
}else{
require '../Shared/Header.php';
require '../../../Config/Conexion.php';
?>
<div class="container">
                <article class="col">
                    <h1 class="text-center">Empresas</h1><br><br>
                    <div>
                        <table style="background-color: rgba(255,255,255,0.1); border-radius:20px">
                            <thead>
                                <tr>
                                    <th class="lg-display-none" style="padding: 20px; width: 200px; text-align: center">Nombre</th>
                                    <th class="lg-display-none" style="padding: 20px; width: 200px; text-align: center">Nit</th>
                                    <th class="lg-display-none" style="padding: 20px; width: 200px; text-align: center">Telefono</th>
                                    <th class="lg-display-none" style="padding: 20px; width: 300px; text-align: center">Correo</th>
                                    <th class="lg-display-none" style="padding: 20px; width: 300px; text-align: center">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $consulta="SELECT * FROM empresa";
                            $resultado=mysqli_query($conexion,$consulta);
                            while($mostrar=mysqli_fetch_array($resultado)){
                            ?>
                                    <tr>
                                        <td class="table-responsive-md" style="padding: 10px; text-align: center"><?php echo $mostrar['nombre'] ?></td>
                                        <td class="table-responsive-md" style="padding: 10px; text-align: center"><?php echo $mostrar['nit'] ?></td>
                                        <td class="table-responsive-md" style="padding: 10px; text-align: center"><?php echo $mostrar['telefono'] ?></td>
                                        <td class="table-responsive-md" style="padding: 10px; text-align: center"><?php echo $mostrar['correo'] ?></td>
                                        <td class="table-responsive-md" style="padding: 10px; text-align: center">
                                            <a href="editaEmpresa.htm?idempresa=${dato.idempresa}" class="text-primary mr-3">Editar</a>
                                            <a data-toggle="modal" href="#portfolioModal1?id=<?php echo $mostrar['idempresa']; ?>" class="text-primary mr-3">Detalles</a>
                                        </td>
                                    </tr>
                            <?php
                            }
                            ?>      
                            </tbody>
                        </table><br><br>
                        <a href="AgregaEmpresa.php" class="btn btn-primary">Agregar Empresa</a><br><br>
                    </div>
                </article>
   </div>


   <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-dark">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
              <?php 
                    $idEmpresa=$_REQUEST['id'];
                    $consulta="SELECT * FROM empresa WHERE idempresa='$idEmpresa'";
                    $resultado=mysqli_query($conexion,$consulta);
                    while($mostrar=mysqli_fetch_array($resultado)){
                ?>
                <h2><?php echo $mostrar['nombre'] ?></h2>
                <tr>
                    <td style="padding: 10px; text-align: center"><?php echo $mostrar['nombre'] ?></td>
                        <td style="padding: 10px; text-align: center"><?php echo $mostrar['nit'] ?></td>
                        <td style="padding: 10px; text-align: center"><?php echo $mostrar['telefono'] ?></td>
                        <td style="padding: 10px; text-align: center"><?php echo $mostrar['correo'] ?></td>
                        <td style="padding: 10px; text-align: center">
                                            <a href="editaEmpresa.htm?idempresa=${dato.idempresa}" class="text-primary mr-3">Editar</a>
                                            <a data-toggle="modal" href="#portfolioModal1?id=<?php echo $mostrar['idempresa']; ?>" class="text-primary mr-3">Detalles</a>
                                        </td>
                                    </tr>
                            <?php
                            }
                            ?> 
                
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                  <i class="fas fa-times"></i>
                  Close Project</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
require '../Shared/Footer.php';
}
?>