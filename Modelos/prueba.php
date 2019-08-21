<?php
include '../Config/Conexion.php';
                    $precio="SELECT SUM(precio) as total FROM servicio";
                    $resul=$conexion->query($precio);
                    $rango=$resul->fetch_assoc();
                    $total=$rango["total"];
                    echo $total;
                    
                  ?>