<?php
session_start();
if(!isset($_SESSION["rol"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../Shared/Login.php");
}else{
require 'Header.php';
require '../../Config/Conexion.php';
?>
<div class="container">
    <article class="col">
    <br><h1 class="text-center">Eventos</h1><br><br>
        <div>
            
                <table style="background-color: rgba(0,0,0,0.1); border-radius:20px">
                    <thead>
                        <tr>
                            <th style="padding: 20px; width: 200px; text-align: center">Imagen</th>
                            <th style="padding: 20px; width: 200px; text-align: center">Nombre</th>
                            <th style="padding: 20px; width: 200px; text-align: center">Categoria</th>
                            <th style="padding: 20px; width: 300px; text-align: center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $consulta="SELECT * FROM tipoevento";
                        $resultado=mysqli_query($conexion,$consulta);
                        while($mostrar=mysqli_fetch_array($resultado)){
                            $idtipoevento=$mostrar['idtipoevento'];
                    ?>
                        <tr>
                            <form action="../../Modelos/Admin.php?op=condicion" method="POST">
                                <td style="padding: 10px; text-align: center"><img src="../../productos/<?php echo $mostrar['imagen'] ?>" alt="<?php echo $mostrar['nombre']?>" width="50%"></td>
                                <td style="padding: 10px; text-align: center"><?php echo $mostrar['nombre'] ?></td>
                                <td style="padding: 10px; text-align: center"><?php echo $mostrar['categoria'] ?></td>
                                <td style="padding: 10px; text-align: center">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#info<?php echo $mostrar['idtipoevento']?>"><i class="fas fa-info"></i></button>
                                    <button type="button" class="btn" data-toggle="modal" data-target="#edit<?php echo $mostrar['idtipoevento']?>"><i class="fas fa-pen"></i></button>
                                    <button type="submit" class="btn" name="delete" value="<?php echo $idtipoevento?>">
                                    <?php
                                        $consultando=$conexion->query("SELECT condicion as condicion FROM tipoevento WHERE idtipoevento='$idtipoevento'");
                                        $consulta=$consultando->fetch_assoc();
                                        $activador=$consulta["condicion"];
                                        if($activador==1){ ?><i class="fas fa-toggle-on text-success"></i><?php }else{ ?><i class="fas fa-toggle-off"></i><?php } ?>
                                    </button>
                                </td>
                            </form>
                        </tr>
                                    <!-- Modal Info -->
                                    <div class="modal fade" id="info<?php echo $mostrar['idtipoevento']?>">
                                        <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <p class="heading lead">Informacion</p>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white-text">×</span></button>
                                                </div>
                                                <!--Body-->
                                                <div class="row modal-body">
                                                    <div class="col-12 text-center mb-5"><h3><?php echo $mostrar['nombre'] ?></h3><img src="../../img/<?php echo $mostrar['imagen'] ?>" width="70%" alt=""></div>
                                                    <div class="col-4 text-center"><hr><h5 class="text-muted">Nombre</h5></div>
                                                    <div class="col-8"><hr><p style="font-size:18px"><?php echo $mostrar['nombre'] ?></p></div>
                                                    <div class="col-4 text-center"><hr><h5 class="text-muted">Detalles</h5></div>
                                                    <div class="col-8"><hr><p style="font-size:18px"><?php echo $mostrar['categoria'] ?></p></div>
                                                    <div class="col-4 text-center"><hr><h5 class="text-muted">Organizados</h5></div>
                                                    <div class="col-8"><hr><p style="font-size:18px"><?php
                                                        $conteo=0;
                                                        $consultando=$conexion->query("SELECT COUNT(e.idtipoevento) as conteo FROM evento e, tipoevento t WHERE e.idtipoevento=t.idtipoevento AND t.idtipoevento=$idtipoevento");
                                                        $consulta=$consultando->fetch_assoc();
                                                        $conteo=$consulta["conteo"];
                                                        if($conteo==0){ echo '0';}else{ echo $conteo;} ?> eventos</p></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal edit -->
                                    <div class="modal fade" id="edit<?php echo $mostrar['idtipoevento']?>">
                                        <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <p class="heading lead">Editar</p>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white-text">×</span></button>
                                                </div>
                                                <!--Body-->
                                                <form action="../../Modelos/Admin.php?op=editarEvento" method="POST">
                                                    <div class="row modal-body">
                                                        <div class="col-12 text-center mb-5"><h3><?php echo $mostrar['nombre'] ?></h3><img src="../../productos/<?php echo $mostrar['imagen']?>" width="70%" alt=""></div>
                                                        <div class="col-4 text-center"><hr><h5 class="text-muted">Nombre</h5></div>
                                                        <div class="col-8"><hr><input type="text" value="<?php echo $mostrar['nombre'] ?>" name="nombre" style="border-radius:5px; color:#424141; width: 90%"></div>
                                                        <div class="col-4 text-center"><hr><h5 class="text-muted">Detalles</h5></div>
                                                        <div class="col-8"><hr>
                                                            <select name="categoria" style="border-radius:5px; color:#424141; width: 100%">
                                                                <?php
                                                                    if($mostrar['categoria']=='Basico'){
                                                                ?><option value="Basico" selected="select">Basico</option>
                                                                    <option value="Estandar">Estandar</option>
                                                                    <option value="Premium">Premium</option>
                                                                <?php
                                                                    }
                                                                    if($mostrar['categoria']=='Estandar'){
                                                                ?>
                                                                    <option value="Basico">Basico</option>
                                                                    <option value="Estandar" selected="select">Estandar</option>
                                                                    <option value="Premium">Premium</option>
                                                                <?php
                                                                    }
                                                                    if($mostrar['categoria']=='Premium'){
                                                                        ?>
                                                                            <option value="Basico">Basico</option>
                                                                            <option value="Estandar">Estandar</option>
                                                                            <option value="Premium" selected="select">Premium</option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        <div class="col-4 text-center"><hr><h5 class="text-muted">Imagen</h5></div>
                                                        <div class="col-8 mb-5"><hr><input type="file" value="<?php echo $mostrar['imagen'] ?>" name="imagen" style="border-radius:5px; color:#424141; width: 90%"></div>
                                                        <input type="hidden" name="evento" value="<?php echo openssl_encrypt($mostrar['idtipoevento'],COD,KEY) ?>">
                                                        <div class="col-12 text-right"><button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cerrar</button><button type="submit" class="btn btn-danger">Guardar</button></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>      
                            </tbody>
                        </table><br><br>
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">Agregar</button>
                        <!-- Agregar Producto -->
                        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Agregar Evento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body row">
                                        <div class="col-12 p-5">
                                            <form method="POST" action="../../Modelos/Admin.php?op=agregarEvento">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p>
                                                            <label for="name">Nombre del Evento</label>
                                                            <input type="text" placeholder="Nombre" name="nombre" style="border-radius:5px; color:#424141; width: 100%" required>
                                                        </p><br>
                                                    </div>
                                                    <div class="col-6 pr-5">
                                                        <p>
                                                            <label>Categoria</label>
                                                            <select name="tipo" style="border-radius:5px; color:#424141; width: 100%">
                                                                <option value="Basico" selected="select">Basico</option>
                                                                <option value="Estandar">Estandar</option>
                                                                <option value="Premium">Premium</option>
                                                            </select>
                                                        </p><br>
                                                    </div>
                                                    <div class="col-6 pl-5">
                                                        <label for="name">Precio</label>
                                                        <input type="file" name="imagen" style="border-radius:5px; color:#424141; width: 100%" required>
                                                    </div>
                                                    <div class="col-6 text-center">
                                                        <p><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button></p>
                                                    </div>
                                                    <div class="col-6 text-center">
                                                        <button type="submit" class="btn btn-danger">Agregar</button>
                                                    </div>
                                                </div>
                                            </form><hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
   </div>
   <script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/jquery.easing.min.js"></script>
<script src="../../js/jqBootstrapValidation.js"></script>
<script src="../../js/sb-admin-2.min.js"></script>
</body>
</html>
<?php
}
?>