<?php
session_start();
if(!isset($_SESSION["rol"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../Shared/Login.php");
}else{
require 'Header.php';
require '../../Config/Conexion.php';
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center my-5">Noticias</h1>
            <?php
            switch($_GET['pagina']){
                case 'cliente':
                ?>
                <div class="row">
                <div class="col">
                    <table style="background-color: rgba(0,0,0,0.1); border-radius:20px; width:100%;">
                        <tr>
                            <th style="padding: 20px; width: 400px; text-align: center">Noticia</th>
                            <th style="padding: 20px; width: 100px; text-align: center">Estado</th>
                            <th style="padding: 20px; width: 200px; text-align: center">Opciones</th>
                        </tr>
                        <?php
                            $consulta="SELECT * FROM noticias WHERE destino='cliente'";
                            $resultado=mysqli_query($conexion,$consulta);
                            while($mostrar=mysqli_fetch_array($resultado)){
                        ?>
                        <tr>
                            <td style="padding: 15px" class="text-center"><?php echo $mostrar['noticia']?></td>
                            <td style="padding: 15px" class="text-center"><?php if($mostrar['condicion']==1){echo 'Particular';}else{echo 'General';}?></td>
                            <td style="padding: 15px" class="text-center"><button type="button" class="btn" data-toggle="modal" data-target="#info<?php echo $mostrar['idnoticias']?>"><i class="fas fa-info"></i></button>
                                    <button type="button" class="btn" data-toggle="modal" data-target="#edit<?php echo $mostrar['idnoticias']?>"><i class="fas fa-pen"></i></button>
                                    <button type="button" class="btn" data-toggle="modal" data-target="#delete<?php echo $mostrar['idnoticias']?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <!-- Modal  Info -->
                        <div id="info<?php echo $mostrar['idnoticias']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="my-modal-title">Noticia</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><?php echo $mostrar['noticia']?></p>
                                        <?php
                                        if($mostrar['condicion']==0){
                                        ?>
                                        <div class="alert alert-warning text-center" role="alert">
                                            <strong>Publico</strong>
                                        </div>
                                        <?php
                                        }else{
                                            $usuario=$mostrar['idusuario'];
                                            $consulta=mysqli_query($conexion,"SELECT nombre, apellido FROM usuario WHERE idusuario=$usuario");
                                            while($usuario=mysqli_fetch_array($consulta)){
                                        ?>
                                        <div class="alert alert-danger text-center" role="alert">
                                            <strong>Privado <?php  echo $usuario['nombre'].' '.$usuario['apellido']?></strong>
                                        </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        Footer
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit -->
                        <div id="edit<?php echo $mostrar['idnoticias']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="my-modal-title">Editar Noticias</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="../../Modelos/Admin.php?op=editarNoticiacliente">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p>
                                                        <label for="name">Noticia</label>
                                                        <textarea name="noticia" placeholder="<?php echo $mostrar['noticia']?>" value="<?php echo $mostrar['noticia']?>" style="border-radius:5px; color:#424141; width: 100%" required></textarea>
                                                    </p><br>
                                                </div>
                                                <div class="col-6 pr-5">
                                                    <p>
                                                        <label>Condicion</label>
                                                        <select name="condicion" style="border-radius:5px; color:#424141; width: 100%">
                                                        <?php
                                                        if($mostrar['condicion']==0){
                                                        ?>
                                                            <option value="0" selected="select">Publico</option>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <option value="1" selected="select">Privado</option>
                                                        <?php
                                                        }
                                                        ?>  
                                                        </select>
                                                    </p><br>
                                                </div>
                                                <div class="col-6 pr-5">
                                                    <p>
                                                        <label>Usuario</label>
                                                        <select name="cliente" style="border-radius:5px; color:#424141; width: 100%">
                                                        <option value="" selected="select"></option>
                                                        <?php
                                                        $usuarios=mysqli_query($conexion,"SELECT * FROM usuario WHERE rol='cliente'");
                                                        while($listado=mysqli_fetch_array($usuarios)){
                                                        ?>
                                                            <option value="<?php echo $listado['idusuario']?>"><?php echo $listado['nombre'].' '.$listado['apellido']?></option>
                                                        <?php
                                                        }
                                                        ?>  
                                                        </select>
                                                    </p><br>
                                                </div>
                                                <input type="hidden" name="idnoticia" value="<?php echo $mostrar['idnoticias']?>">
                                                <div class="col-6 text-center">
                                                    <p><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button></p>
                                                </div>
                                                <div class="col-6 text-center">
                                                    <button type="submit" class="btn btn-danger">Editar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal  Delete -->
                        <div id="delete<?php echo $mostrar['idnoticias']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger" id="my-modal-title">Eliminar</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estas seguro de Eliminar esta noticia?</p>
                                        <p><?php echo $mostrar['noticia']?></p>
                                        <?php
                                        if($mostrar['condicion']==0){
                                        ?>
                                        <div class="alert alert-warning text-center" role="alert">
                                            <strong>Publico</strong>
                                        </div>
                                        <?php
                                        }else{
                                            $usuario=$mostrar['idusuario'];
                                            $consulta=mysqli_query($conexion,"SELECT nombre, apellido FROM usuario WHERE idusuario=$usuario");
                                            while($usuario=mysqli_fetch_array($consulta)){
                                        ?>
                                        <div class="alert alert-danger text-center" role="alert">
                                            <strong>Privado <?php  echo $usuario['nombre'].' '.$usuario['apellido']?></strong>
                                        </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <form action="../../Modelos/Admin.php?op=eliminarnoticiacliente" method="POST">
                                        <div class="row">
                                            <input type="hidden" name="idnoticia" value="<?php echo $mostrar['idnoticias']?>">
                                            <div class="col-6 text-center">
                                                <p><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button></p>
                                            </div>
                                            <div class="col-6 text-center">
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-5 mb-5">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">Nuevo</button>
                <!-- Agregar Producto -->
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Nueva Noticia</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-12 p-5">
                                    <form method="POST" action="../../Modelos/Admin.php?op=agregarNoticiacliente">
                                        <div class="row">
                                            <div class="col-12">
                                                <p>
                                                    <label for="name">Noticia</label>
                                                    <textarea name="noticia" style="border-radius:5px; color:#424141; width: 100%" required></textarea>
                                                </p><br>
                                            </div>
                                            <div class="col-6 pr-5">
                                                <p>
                                                    <label>Condicion</label>
                                                    <select name="condicion" style="border-radius:5px; color:#424141; width: 100%">
                                                        <option value="0" selected="select">Publico</option>
                                                        <option value="1">Privado</option>
                                                    </select>
                                                </p><br>
                                            </div>
                                            <div class="col-6 pr-5">
                                                <p>
                                                    <label>Cliente</label>
                                                    <select name="cliente" style="border-radius:5px; color:#424141; width: 100%">
                                                        <option value="" select></option>
                                                    <?php
                                                        $consulta="SELECT * FROM usuario WHERE rol='cliente'";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        while($mostrar=mysqli_fetch_array($resultado)){
                                                    ?>
                                                        <option value="<?php echo $mostrar['idusuario']?>"><?php echo $mostrar['nombre'].' '.$mostrar['apellido']?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                    </select>
                                                </p><br>
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
                <?php
                break;
                case 'empresa':
                ?>
                <div class="row">
                <div class="col">
                    <table style="background-color: rgba(0,0,0,0.1); border-radius:20px; width:100%;">
                        <tr>
                            <th style="padding: 20px; width: 400px; text-align: center">Noticia</th>
                            <th style="padding: 20px; width: 100px; text-align: center">Estado</th>
                            <th style="padding: 20px; width: 200px; text-align: center">Opciones</th>
                        </tr>
                        <?php
                            $consulta="SELECT * FROM noticias WHERE destino='empresa'";
                            $resultado=mysqli_query($conexion,$consulta);
                            while($mostrar=mysqli_fetch_array($resultado)){
                        ?>
                        <tr>
                            <td style="padding: 15px" class="text-center"><?php echo $mostrar['noticia']?></td>
                            <td style="padding: 15px" class="text-center"><?php if($mostrar['condicion']==1){echo 'Particular';}else{echo 'General';}?></td>
                            <td style="padding: 15px" class="text-center"><button type="button" class="btn" data-toggle="modal" data-target="#info<?php echo $mostrar['idnoticias']?>"><i class="fas fa-info"></i></button>
                                    <button type="button" class="btn" data-toggle="modal" data-target="#edit<?php echo $mostrar['idnoticias']?>"><i class="fas fa-pen"></i></button>
                                    <button type="button" class="btn" data-toggle="modal" data-target="#delete<?php echo $mostrar['idnoticias']?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <!-- Modal  Info -->
                        <div id="info<?php echo $mostrar['idnoticias']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="my-modal-title">Noticia</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><?php echo $mostrar['noticia']?></p>
                                        <?php
                                        if($mostrar['condicion']==0){
                                        ?>
                                        <div class="alert alert-warning text-center" role="alert">
                                            <strong>Publico</strong>
                                        </div>
                                        <?php
                                        }else{
                                            $empresa=$mostrar['idempresa'];
                                            $consulta=mysqli_query($conexion,"SELECT nombre FROM empresa WHERE idempresa=$empresa");
                                            while($usuario=mysqli_fetch_array($consulta)){
                                        ?>
                                        <div class="alert alert-danger text-center" role="alert">
                                            <strong>Privado <?php  echo $usuario['nombre']?></strong>
                                        </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        Footer
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit -->
                        <div id="edit<?php echo $mostrar['idnoticias']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="my-modal-title">Editar Noticias</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="../../Modelos/Admin.php?op=editarNoticiaempresa">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p>
                                                        <label for="name">Noticia</label>
                                                        <textarea name="noticia" placeholder="<?php echo $mostrar['noticia']?>" value="<?php echo $mostrar['noticia']?>" style="border-radius:5px; color:#424141; width: 100%" required></textarea>
                                                    </p><br>
                                                </div>
                                                <div class="col-6 pr-5">
                                                    <p>
                                                        <label>Condicion</label>
                                                        <select name="condicion" style="border-radius:5px; color:#424141; width: 100%">
                                                        <?php
                                                        if($mostrar['condicion']==0){
                                                        ?>
                                                            <option value="0" selected="select">Publico</option>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <option value="1" selected="select">Privado</option>
                                                        <?php
                                                        }
                                                        ?>  
                                                        </select>
                                                    </p><br>
                                                </div>
                                                <div class="col-6 pr-5">
                                                    <p>
                                                        <label>Empresa</label>
                                                        <select name="cliente" style="border-radius:5px; color:#424141; width: 100%">
                                                        <option value="" selected="select"></option>
                                                        <?php
                                                        $usuarios=mysqli_query($conexion,"SELECT * FROM empresa");
                                                        while($listado=mysqli_fetch_array($usuarios)){
                                                        ?>
                                                            <option value="<?php echo $listado['idempresa']?>"><?php echo $listado['nombre']?></option>
                                                        <?php
                                                        }
                                                        ?>  
                                                        </select>
                                                    </p><br>
                                                </div>
                                                <input type="hidden" name="idnoticia" value="<?php echo $mostrar['idnoticias']?>">
                                                <div class="col-6 text-center">
                                                    <p><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button></p>
                                                </div>
                                                <div class="col-6 text-center">
                                                    <button type="submit" class="btn btn-danger">Editar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal  Delete -->
                        <div id="delete<?php echo $mostrar['idnoticias']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger" id="my-modal-title">Eliminar</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estas seguro de Eliminar esta noticia?</p>
                                        <p><?php echo $mostrar['noticia']?></p>
                                        <?php
                                        if($mostrar['condicion']==0){
                                        ?>
                                        <div class="alert alert-warning text-center" role="alert">
                                            <strong>Publico</strong>
                                        </div>
                                        <?php
                                        }else{
                                            $empresa=$mostrar['idempresa'];
                                            $consulta=mysqli_query($conexion,"SELECT nombre FROM empresa WHERE idempresa=$empresa");
                                            while($usuario=mysqli_fetch_array($consulta)){
                                        ?>
                                        <div class="alert alert-danger text-center" role="alert">
                                            <strong>Privado <?php  echo $usuario['nombre']?>strong>
                                        </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <form action="../../Modelos/Admin.php?op=eliminarnoticiaempresa" method="POST">
                                        <div class="row">
                                            <input type="hidden" name="idnoticia" value="<?php echo $mostrar['idnoticias']?>">
                                            <div class="col-6 text-center">
                                                <p><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button></p>
                                            </div>
                                            <div class="col-6 text-center">
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-5 mb-5">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">Nuevo</button>
                <!-- Agregar Producto -->
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Nueva Noticia</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-12 p-5">
                                    <form method="POST" action="../../Modelos/Admin.php?op=agregarNoticiaempresa">
                                        <div class="row">
                                            <div class="col-12">
                                                <p>
                                                    <label for="name">Noticia</label>
                                                    <textarea name="noticia" style="border-radius:5px; color:#424141; width: 100%" required></textarea>
                                                </p><br>
                                            </div>
                                            <div class="col-6 pr-5">
                                                <p>
                                                    <label>Condicion</label>
                                                    <select name="condicion" style="border-radius:5px; color:#424141; width: 100%">
                                                        <option value="0" selected="select">Publico</option>
                                                        <option value="1">Privado</option>
                                                    </select>
                                                </p><br>
                                            </div>
                                            <div class="col-6 pr-5">
                                                <p>
                                                    <label>Cliente</label>
                                                    <select name="cliente" style="border-radius:5px; color:#424141; width: 100%">
                                                        <option value="" select></option>
                                                    <?php
                                                        $consulta="SELECT * FROM empresa";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        while($mostrar=mysqli_fetch_array($resultado)){
                                                    ?>
                                                        <option value="<?php echo $mostrar['idempresa']?>"><?php echo $mostrar['nombre']?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                    </select>
                                                </p><br>
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
                <?php
                break;
            }
            ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
<footer class="col-12" style="background-color:#212529">
    <div class="text-center mt-5 mb-5">
      <span class="copyright text-center text-white">Copyright &copy; EventosGuatoc</span>
    </div>
</footer>
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