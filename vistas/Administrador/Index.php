<?php
session_start();
if(!isset($_SESSION["rol"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../Shared/Login.php");
}else{
require 'Header.php';
?>
<div class="container">
          <section class="row main mt-5">
                <article class="row">
                    <h1>Bienvenido Administrador</h1>
              </article>
              <article class="row d-flex">
                  <div class="col text-center"><img class="fondo img-fluid" src="../../img/background.png" alt=""></div>
              </article>
          </section>
          <section class="info">
                <article class="row">
                        <div class="col-12"><br><br><br><br>
                            <p class="display-4 text-center">Sobre nosotros</p>
                            <p class="text-center">Trabajamos para que tu evento sea una experiencia unica, con los mas altos estandares de calidad y profesionalismo Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, consectetur nobis. Tenetur a omnis, voluptates minima tempore facere in dignissimos ipsum error voluptatibus, iusto deserunt consequatur impedit, dolores eius tempora?</p>
                        </div><br><br>
                        <div class="col-12"><img style="width: 90%; height: 500px; margin-left: 60px" src="../../img/collage.jpg" alt=""></div>
                </article>
              <article class="row">
                    <div class="col align-center">
                            <br><br><br><br><br><p class="display-4 text-center" id="servicio">Nuestros servicios</p>
                            <p class="text-center">Te ofrecemos una amplia variedad de servicios para tu evento, prestados por empresas regionales y reconocidas en todo el Valle de Tenza. Con un amplio recorrido en el mercado y la suficiente experiencia para poder garantizarte que tu evento se realize con los mas altos estandares de calidad</p><br>
                            <div class="row d-flex justify-content-center">
                                <ul class="services">
                                    <div class="col col-xs-12 col-sm-6 col-md-4 col-lg-2 text-center" style="float: left"><li class="mx-1"><a href=""><button class="boton"><i class="fas fa-utensils text-center"></i></button></a></li></div>
                                    <div class="col col-xs-12 col-sm-6 col-md-4 col-lg-2 text-center" style="float: left"><li class="mx-1"><a href=""><button class="boton"><i class="fas fa-music text-center"></i></button></a></li></div>
                                    <div class="col col-xs-12 col-sm-6 col-md-4 col-lg-2 text-center" style="float: left"><li class="mx-1"><a href=""><button class="boton"><i class="fas fa-camera text-center"></i></button></a></li></div>
                                    <div class="col col-xs-12 col-sm-6 col-md-4 col-lg-2 text-center" style="float: left"><li class="mx-1"><a href=""><button class="boton"><i class="fas fa-map-marker-alt text-center"></i></button></a></li></div>
                                    <div class="col col-xs-12 col-sm-6 col-md-4 col-lg-2 text-center" style="float: left"><li class="mx-1"><a href=""><button class="boton"><i class="fab fa-black-tie"></i></button></a></li></div>
                                    <div class="col col-xs-12 col-sm-6 col-md-4 col-lg-2 text-center" style="float: left"><li class="mx-1"><a href=""><button class="boton"><i class="fas fa-wine-glass-alt text-center"></i></button></a></li></div>
                                  </ul><br><br>
                            </div>
                      </div>
              </article>
          </section>
      </div>
<?php
require '../Footer.php';
}
?>