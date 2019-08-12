<?php
session_start();
if(!isset($_SESSION["tipo"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../Empresa/Login.php");
}else{
require 'Header.php';
require '../../Config/Conexion.php';
?>
<div class="container">
    <section class="row justify-content-center main mt-5">
        <article class="col-12">
            <?php $idempresa=$_SESSION["idempresa"];
            $consulta="SELECT * FROM servicio WHERE idempresa='$idempresa'";
            $resultado=mysqli_query($conexion,$consulta);
            $count=0;
            while($mostrar=mysqli_fetch_array($resultado)){
                $count++;
            }
            ?> 
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">Tiene <?php echo $count ?> pedidos</h2>
            </div>      
            </article>
            <article class="col-12">
                    <div>
                        <table style="background-color: rgba(255,255,255,0.1); border-radius:20px">
                            <thead>
                                <tr>
                                    <th style="padding: 20px; width: 200px; text-align: center">Nombre</th>
                                    <th style="padding: 20px; width: 200px; text-align: center">Evento</th>
                                    <th style="padding: 20px; width: 200px; text-align: center">Fecha</th>
                                    <th style="padding: 20px; width: 300px; text-align: center">Usuario</th>
                                    <th style="padding: 20px; width: 300px; text-align: center">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $idempresa=$_SESSION["idempresa"];
                            if($idempresa==2 || $idempresa==4){
                                $consulta="SELECT * FROM servicio WHERE idempresa='$idempresa'";
                                $resultado=mysqli_query($conexion,$consulta);
                            }else{
                                $consulta="SELECT * FROM fotografia";
                                $resultado=mysqli_query($conexion,$consulta);
                            }
                            while($mostrar=mysqli_fetch_array($resultado)){
                            ?>
                                    <tr>
                                        <td style="padding: 10px; text-align: center"><?php echo $mostrar['nombre'] ?></td>
                                        <td style="padding: 10px; text-align: center">0</td>
                                        <td style="padding: 10px; text-align: center">0</td>
                                        <td style="padding: 10px; text-align: center">0</td>
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
                    </div>
                </article>
          </section>
      </div>
<?php
require '../Shared/Footer.php';
}
?>