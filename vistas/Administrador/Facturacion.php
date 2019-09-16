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
            <h1 class="text-center my-5">Facturacion</h1>
            <div class="row">
                <div class="col-12 text-center">
                <?php
                switch($_GET['pagina']){
                    case 'buscar':
                ?>
                <p class="text-center">Ingresa el codigo del Evento</p>
                <form method="POST" action="../../Modelos/Admin.php?op=buscarFactura" class="d-sm-inline-block form-inline navbar-search" style="border-radius: 10px; width:50%">
                        <div class="input-group">
                        <input type="text" name="codigo" class="form-control bg-light border-500 small" placeholder="Buscar Factura..." required>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                        </div>
                    </form>
                <?php
                    break;
                    case 'sinresultados':
                ?>
                <p class="text-center">Ingresa el codigo del Evento</p>
                <form method="POST" action="../../Modelos/Admin.php?op=buscarFactura" class="d-sm-inline-block form-inline navbar-search" style="border-radius: 10px; width:50%">
                        <div class="input-group">
                        <input type="text" name="codigo" class="form-control bg-light border-500 small" placeholder="Buscar Factura..." required>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                        </div>
                    </form>
                    <h4 class="text-center mt-5 text-danger">No se han encontrado resultados</h4>
                <?php
                    break;
                    case 'mostrar':
                    $idevento=$_SESSION['idevento'];
                    $resultado = mysqli_query($conexion, "SELECT u.nombre, u.apellido, u.idusuario, e.cantidadpersonas, t.nombre as evento, e.idevento, e.fechaentregahora, e.precio, e.abono, e.saldo FROM usuario u, evento e, tipoevento t WHERE u.idusuario=e.idusuario AND e.idtipoevento=t.idtipoevento AND e.idevento=$idevento");
                    while($mostrar=mysqli_fetch_array($resultado)){
                ?>
                <div style="border:solid 1px #ccc; border-radius:15px; padding: 20px">
                    <h3 class="text-center">Evento <?php echo $mostrar['evento']?></h3><br><br>
                    <div class="row">
                        <div class="col-4"><span>Nombre: </span><span class="ml-3"><?php echo $mostrar['nombre'].' '.$mostrar['apellido']?></span></div>
                        <div class="col-4"><span>Fecha del Evento: </span><span class="ml-3"><?php echo $mostrar['fechaentregahora']?></span></div>
                        <div class="col-4"><span>Nombre: </span><span class="ml-3"><?php echo $mostrar['nombre']?></span></div><br><br>
                    </div>
                    <div class="row" style="background-color: rgba(0,0,0,0.2); border-radius:15px">
                        <div class="col">
                        <table>
                            <tr>
                                <th style="width:45%; padding:20px;"><b>Total</b></th>
                                <th style="width:45%; padding:20px;">Abono</th>
                                <th style="width:45%; padding:20px;">Saldo</th>
                            </tr>
                            <tr>
                                <td>$<?php echo number_format($mostrar['precio'], 0, ',', '.')?></td>
                                <td>$<?php echo number_format($mostrar['abono'], 0, ',', '.')?></td>
                                <td>$<?php echo number_format($mostrar['saldo'], 0, ',', '.')?></td>
                            </tr>
                        </table>
                        </div>
                    </div>
                    <div class="row m-5">
                    <div class="col-6">
                        <form action="../../Modelos/Admin.php?op=cancelarfacturacion" method="POST"><button type="submit" class="btn btn-danger btn-lg">Cancelar</button></form>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">Pago</button>
                    </div>
                    </div>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Abono de Evento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <form action="../../Modelos/Admin.php?op=abono" method="POST">
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                            <h4 class="text-center"><?php echo $mostrar['evento']?></h4>
                                            </div>
                                            <div class="col-12">
                                                <label for="pago">Valor del abono </label>
                                                <input type="text" placeholder="Abono" name="pago" style="border-radius:5px; color:#424141; width: 50%" required>
                                                <input type="hidden" value="<?php echo $mostrar['idevento']?>" name="idevento">
                                                <input type="hidden" value="<?php echo $mostrar['idusuario']?>" name="idusuario">
                                            </div>
                                        </div>
                                        <div class="col-12 mt-5">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    break;
                }
                ?>
                    
                </div>
            </div>
        </div>
    </div>
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