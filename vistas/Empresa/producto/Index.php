<?php
session_start();
if(!isset($_SESSION["tipo"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../../Empresa/Login.php");
}else{
require '../Shared/Header.php';
require '../../../Config/Conexion.php';
?>
<div class="container">
<article class="col">
                    <h1 class="text-center">Servicios</h1><br><br>
                    <div>
                        <table style="background-color: rgba(255,255,255,0.1); border-radius:20px">
                            <thead>
                                <tr>
                                    <th style="padding: 20px; width: 200px; text-align: center">Nombre</th>
                                    <th style="padding: 20px; width: 200px; text-align: center">Capacidad</th>
                                    <th style="padding: 20px; width: 200px; text-align: center">precio</th>
                                    <th style="padding: 20px; width: 300px; text-align: center">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $idempresa=$_SESSION["idempresa"];
                            switch($idempresa){
                                case '4':
                                    $consulta="SELECT * FROM fotografia";
                                    $resultado=mysqli_query($conexion,$consulta);
                                break;
                                case '5':
                                    $consulta="SELECT * FROM salon";
                                    $resultado=mysqli_query($conexion,$consulta);
                                break;
                                case '6':
                                    $consulta="SELECT * FROM animacion";
                                    $resultado=mysqli_query($conexion,$consulta);
                                break;
                                default:
                                    $consulta="SELECT * FROM servicio WHERE idempresa=$idempresa";
                                    $resultado=mysqli_query($conexion,$consulta);
                                break;
                            }
                            while($mostrar=mysqli_fetch_array($resultado)){
                            ?>
                                    <tr>
                                        <td style="padding: 10px; text-align: center"><?php echo $mostrar['nombre'] ?></td>
                                        <td style="padding: 10px; text-align: center"><?php echo $mostrar['especificaciones'] ?></td>
                                        <td style="padding: 10px; text-align: center"><?php echo $mostrar['precio'] ?></td>
                                        <td style="padding: 10px; text-align: center">
                                            <a href="editaEmpresa.htm?idempresa=${dato.idempresa}" class="text-primary mr-3">Editar</a>
                                            <a data-toggle="modal" href="#portfolioModal1?id=<?php echo $mostrar['idempresa']; ?>" class="text-primary mr-3">Detalles</a>
                                        </td>
                                    </tr>
                            <?php
                            }
                            ?>      
                            </tbody>
                        </table><br><br>
                        <a href="agregar.php" class="btn btn-primary">Agregar Producto</a><br><br>
                    </div>
                </article>
   </div>
<?php
require '../Shared/Footer.php';
}
?>