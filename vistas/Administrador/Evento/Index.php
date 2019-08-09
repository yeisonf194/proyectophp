<?php
session_start();
if(!isset($_SESSION["rol"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../../Shared/Login.php");
}else{
require 'Header.php';
require '../../../Config/Conexion.php';
?>
<div class="container">
        <section class="row d-flex justify-content-center">
                <article class="col">
                    <br><h1 class="text-center mt-5">Eventos</h1><br><br>
                    <div>
                        <table style="background-color: rgba(0,0,0,0.1); border-radius:20px">
                            <thead>
                                <tr>
                                    <th style="padding: 20px; width: 200px; text-align: center">Nombre</th>
                                    <th style="padding: 20px; width: 200px; text-align: center">Categoria</th>
                                    <th style="padding: 20px; width: 200px; text-align: center">Condicion</th>
                                    <th style="padding: 20px; width: 300px; text-align: center">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $consulta="SELECT * FROM tipoevento";
                            $resultado=mysqli_query($conexion,$consulta);
                            while($mostrar=mysqli_fetch_array($resultado)){
                            ?>
                                    <tr>
                                        <td style="padding: 10px; text-align: center"><?php echo $mostrar['nombre'] ?></td>
                                        <td style="padding: 10px; text-align: center"><?php echo $mostrar['categoria'] ?></td>
                                        <td style="padding: 10px; text-align: center"><?php echo $mostrar['condicion'] ?></td>
                                        <td style="padding: 10px; text-align: center">
                                            <a href="editaEmpresa.htm?idempresa=${dato.idempresa}" class="text-primary mr-3">Editar</a>
                                            <a href="editaEmpresa.htm?idempresa=${dato.idempresa}" class="text-primary mr-3">Detalles</a>
                                        </td>
                                    </tr>
                            <?php
                            }
                            ?>      
                            </tbody>
                        </table><br><br>
                        <a href="Agregar.php" class="btn btn-primary">Agregar Evento</a><br><br>
                    </div>
                </article>
            </section> 
   </div>
<?php
require '../../Footer.php';
}
?>