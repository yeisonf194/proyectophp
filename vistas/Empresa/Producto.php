<?php
session_start();
if(!isset($_SESSION["tipo"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../Empresa/Login.php");
}else{
require 'Header.php';
require '../../Config/Conexion.php';
?>
<div class="container">
    <article class="col">
    <h1 class="text-center"><?php if($_GET['opcion']=='activo'){ echo 'Productos Activos ';}else echo 'Productos Inactivos ' ?></h1><br><br>
        <div class="mb-5">
            <table style="background-color: rgba(255,255,255,0.1); border-radius:20px">
                <thead>
                    <tr>
                        <th style="padding: 20px; width: 200px; text-align: center">Imagen</th>
                        <th style="padding: 20px; width: 150px; text-align: center">Nombre</th>
                        <th style="padding: 20px; width: 300px; text-align: center">Especificaciones</th>
                        <th style="padding: 20px; width: 150px; text-align: center">precio</th>
                        <th style="padding: 20px; width: 300px; text-align: center">Editar</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $idempresa=$_SESSION["idempresa"];
                    $contando=0;
                    $contador=0;
                    if($_GET['opcion']=='activo'){
                        switch($idempresa){
                            case '4':
                                $consulta="SELECT imagen, nombre, especificaciones, precio, idempresa, idfotografia as producto FROM fotografia WHERE condicion=1";
                                $resultado=mysqli_query($conexion,$consulta);
                            break;
                            case '5':
                                $consulta="SELECT imagen, nombre, capacidad as especificaciones, precio, idempresa, idsalon as producto FROM salon WHERE condicion=1";
                                $resultado=mysqli_query($conexion,$consulta);
                            break;
                            case '6':
                                $consulta="SELECT imagen, nombre, especificaciones, precio, idempresa, idanimacion as producto FROM animacion WHERE condicion=1";
                                $resultado=mysqli_query($conexion,$consulta);
                            break;
                            default:
                                $consulta="SELECT imagen, nombre, especificaciones, precio, idempresa, idproducto as producto FROM producto WHERE idempresa=$idempresa AND condicion=1";
                                $resultado=mysqli_query($conexion,$consulta);
                            break;
                        }
                        while($mostrar=mysqli_fetch_array($resultado)){
                            $producto=$mostrar['producto'];
                            $contando++;
                    ?>
                    <!-- Cuerpo de la tabla -->
                    <tr> 
                        <form action="../../Modelos/Empresa.php?op=delete" method="POST">
                        <td style="padding: 10px; text-align: center"><img src="../../productos/<?php echo $mostrar['imagen'] ?>" alt="" width="90%"></td>
                            <td style="padding: 10px; text-align: center"><?php echo $mostrar['nombre'] ?></td>
                            <td style="padding: 10px; text-align: center"><?php echo $mostrar['especificaciones'] ?></td>
                            <td style="padding: 10px; text-align: center"><?php echo $mostrar['precio'] ?></td>
                            <td style="padding: 10px; text-align: center">
                                <button type="button" class="btn" data-toggle="modal" data-target="#info<?php echo $mostrar['idempresa'].$producto?>"><i class="fas fa-info"></i></button>
                                <button type="button" class="btn" data-toggle="modal" data-target="#edit<?php echo $mostrar['idempresa'].$producto?>"><i class="fas fa-pen"></i></button>
                                <button type="submit" class="btn" name="delete" value="<?php echo $producto?>">
                                <?php 
                                    switch($idempresa){
                                        case '4':
                                            $consultando=$conexion->query("SELECT condicion as condicion FROM fotografia WHERE idfotografia='$producto' AND idempresa='$idempresa' ");
                                            $consulta=$consultando->fetch_assoc();
                                            $activador=$consulta["condicion"];
                                        break;
                                        case '5':
                                            $consultando=$conexion->query("SELECT condicion as condicion FROM salon WHERE idsalon='$producto' AND idempresa='$idempresa' ");
                                            $consulta=$consultando->fetch_assoc();
                                            $activador=$consulta["condicion"];
                                        break;
                                        case '6':
                                            $consultando=$conexion->query("SELECT condicion as condicion FROM animacion WHERE idanimacion='$producto' AND idempresa='$idempresa' ");
                                            $consulta=$consultando->fetch_assoc();
                                            $activador=$consulta["condicion"];
                                        break;
                                        default:
                                            $consultando=$conexion->query("SELECT condicion as condicion FROM producto WHERE idproducto='$producto' AND idempresa='$idempresa' ");
                                            $consulta=$consultando->fetch_assoc();
                                            $activador=$consulta["condicion"];
                                        break;
                                    }
                                    if($activador==1){ ?><i class="fas fa-toggle-on text-success"></i><?php }else{ ?><i class="fas fa-toggle-off"></i><?php } ?>
                                </button>
                            </td>
                        </form>
                    </tr>
                    <!-- Modal Info -->
                    <div class="modal fade" id="info<?php echo $mostrar['idempresa'].$producto?>">
                        <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p class="heading lead">Informacion</p>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white-text">×</span></button>
                                </div>
                                <!--Body-->
                                <div class="row modal-body">
                                    <div class="col-12 text-center mb-5"><h3><?php echo $mostrar['nombre'] ?></h3><img src="../../img/friends.jpg" width="70%" alt=""></div>
                                    <div class="col-4 text-center"><hr><h5 class="text-muted">Nombre</h5></div>
                                    <div class="col-8"><hr><p style="font-size:18px"><?php echo $mostrar['nombre'] ?></p></div>
                                    <div class="col-4 text-center"><hr><h5 class="text-muted">Detalles</h5></div>
                                    <div class="col-8"><hr><p style="font-size:18px"><?php echo $mostrar['especificaciones'] ?></p></div>
                                    <div class="col-4 text-center"><hr><h5 class="text-muted">Precio</h5></div>
                                    <div class="col-8"><hr><p style="font-size:18px">$<?php echo $mostrar['precio'] ?></p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal edit -->
                    <div class="modal fade" id="edit<?php echo $mostrar['idempresa'].$producto?>">
                        <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p class="heading lead">Editar</p>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white-text">×</span></button>
                                </div>
                                <!--Body-->
                                <form action="../../Modelos/Empresa.php?op=editar" method="POST">
                                    <div class="row modal-body">
                                        <div class="col-12 text-center mb-5"><h3><?php echo $mostrar['nombre'] ?></h3><img src="../../productos/<?php echo $mostrar['imagen']?>" width="90%" alt=""></div>
                                        <div class="col-4 text-center"><hr><h5 class="text-muted">Nombre</h5></div>
                                        <div class="col-8"><hr><input type="text" value="<?php echo $mostrar['nombre'] ?>" name="nombre" style="border-radius:5px; color:#424141; width: 90%"></div>
                                        <div class="col-4 text-center"><hr><h5 class="text-muted">Detalles</h5></div>
                                        <div class="col-8"><hr><input type="text" value="<?php echo $mostrar['especificaciones'] ?>" name="especificaciones" style="border-radius:5px; color:#424141; width: 90%"></div>
                                        <div class="col-4 text-center"><hr><h5 class="text-muted">Precio</h5></div>
                                        <div class="col-8 mb-5"><hr><input type="text" value="<?php echo $mostrar['precio'] ?>" name="precio" style="border-radius:5px; color:#424141; width: 90%"></div>
                                        <div class="col-8 mb-5"><hr><input type="file" value="<?php echo $mostrar['imagen'] ?>" name="imagen" style="border-radius:5px; color:#424141; width: 90%"></div>
                                        <input type="hidden" name="producto" value="<?php echo openssl_encrypt($mostrar['producto'],COD,KEY) ?>">
                                        <div class="col-12 text-right"><button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cerrar</button><button type="submit" class="btn btn-danger">Guardar</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                        }
                    }else{
                        switch($idempresa){
                            case '4':
                                $consulta="SELECT imagen, nombre, especificaciones, precio, idempresa, idfotografia as producto FROM fotografia WHERE condicion=0";
                                $resultado=mysqli_query($conexion,$consulta);
                            break;
                            case '5':
                                $consulta="SELECT imagen, nombre, capacidad as especificaciones, precio, idempresa, idsalon as producto FROM salon WHERE condicion=0";
                                $resultado=mysqli_query($conexion,$consulta);
                            break;
                            case '6':
                                $consulta="SELECT imagen, nombre, especificaciones, precio, idempresa, idanimacion as producto FROM animacion WHERE condicion=0";
                                $resultado=mysqli_query($conexion,$consulta);
                            break;
                            default:
                                $consulta="SELECT imagen, nombre, especificaciones, precio, idempresa, idproducto as producto FROM producto WHERE idempresa=$idempresa AND condicion=0";
                                $resultado=mysqli_query($conexion,$consulta);
                            break;
                        }
                        while($mostrar=mysqli_fetch_array($resultado)){
                            $producto=$mostrar['producto'];
                            $contando++;
                    ?>
                    <!-- Cuerpo de la tabla -->
                    <tr> 
                        <form action="../../Modelos/Empresa.php?op=delete" method="POST">
                            <td style="padding: 10px; text-align: center"><img src="../../productos/<?php echo $mostrar['imagen'] ?>" width="90%" alt=""></td>
                            <td style="padding: 10px; text-align: center"><?php echo $mostrar['nombre'] ?></td>
                            <td style="padding: 10px; text-align: center"><?php echo $mostrar['especificaciones'] ?></td>
                            <td style="padding: 10px; text-align: center"><?php echo $mostrar['precio'] ?></td>
                            <td style="padding: 10px; text-align: center">
                                <button type="button" class="btn" data-toggle="modal" data-target="#info<?php echo $mostrar['idempresa'].$producto?>"><i class="fas fa-info"></i></button>
                                <button type="button" class="btn" data-toggle="modal" data-target="#edit<?php echo $mostrar['idempresa'].$producto?>"><i class="fas fa-pen"></i></button>
                                <button type="submit" class="btn" name="delete" value="<?php echo $producto?>">
                                <?php 
                                    switch($idempresa){
                                        case '4':
                                            $consultando=$conexion->query("SELECT condicion as condicion FROM fotografia WHERE idfotografia='$producto' AND idempresa='$idempresa' ");
                                            $consulta=$consultando->fetch_assoc();
                                            $activador=$consulta["condicion"];
                                        break;
                                        case '5':
                                            $consultando=$conexion->query("SELECT condicion as condicion FROM salon WHERE idsalon='$producto' AND idempresa='$idempresa' ");
                                            $consulta=$consultando->fetch_assoc();
                                            $activador=$consulta["condicion"];
                                        break;
                                        case '6':
                                            $consultando=$conexion->query("SELECT condicion as condicion FROM animacion WHERE idanimacion='$producto' AND idempresa='$idempresa' ");
                                            $consulta=$consultando->fetch_assoc();
                                            $activador=$consulta["condicion"];
                                        break;
                                        default:
                                            $consultando=$conexion->query("SELECT condicion as condicion FROM producto WHERE idproducto='$producto' AND idempresa='$idempresa' ");
                                            $consulta=$consultando->fetch_assoc();
                                            $activador=$consulta["condicion"];
                                        break;
                                    }
                                    if($activador==1){ ?><i class="fas fa-toggle-on"></i><?php }else{ ?><i class="fas fa-toggle-off"></i><?php } ?>
                                </button>
                            </td>
                        </form>
                    </tr>
                    <!-- Modal Info -->
                    <div class="modal fade" id="info<?php echo $mostrar['idempresa'].$producto?>">
                        <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p class="heading lead">Informacion</p>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white-text">×</span></button>
                                </div>
                                <!--Body-->
                                <div class="row modal-body">
                                    <div class="col-12 text-center mb-5"><h3><?php echo $mostrar['nombre'] ?></h3><img src="../../img/friends.jpg" width="70%" alt=""></div>
                                    <div class="col-4 text-center"><hr><h5 class="text-muted">Nombre</h5></div>
                                    <div class="col-8"><hr><p style="font-size:18px"><?php echo $mostrar['nombre'] ?></p></div>
                                    <div class="col-4 text-center"><hr><h5 class="text-muted">Detalles</h5></div>
                                    <div class="col-8"><hr><p style="font-size:18px"><?php echo $mostrar['especificaciones'] ?></p></div>
                                    <div class="col-4 text-center"><hr><h5 class="text-muted">Precio</h5></div>
                                    <div class="col-8"><hr><p style="font-size:18px">$<?php echo $mostrar['precio'] ?></p></div>
                                </div>  
                            </div>
                        </div>
                    </div>
                <?php
                        }
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
                            <h5 class="modal-title">Agregar Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-12 p-5">
                                <form method="POST" action="../../Modelos/Empresa.php?op=agregaProducto">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>
                                                <label for="name">Nombre del producto</label>
                                                <input type="text" placeholder="Nombre" name="nombre" style="border-radius:5px; color:#424141; width: 100%" required>
                                            </p><br>
                                        </div>
                                        <div class="col-6 pr-5">
                                            <p>
                                                <label for="name">Especificaciones</label><br>
                                                <input type="text" name="especificaciones" style="border-radius:5px; color:#424141; width: 80%" required>
                                            </p><br>
                                        </div>
                                        <div class="col-6 pl-5">
                                            <label for="name">Precio</label>
                                            <input type="text" name="precio" style="border-radius:5px; color:#424141; width: 100%" required>
                                        </div>
                                        <div class="col-12 mb-5">
                                            <label for="name">Imagen</label>
                                            <input type="file" name="imagen" required>
                                        </div>
                                        <div class="col-6 text-center">
                                            <p><button type="submit" class="btn btn-danger">Agregar</button></p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </form><hr>
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