<?php
require 'Header.php';
require '../Config/Conexion.php';
?>
 <section class="page-section" id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Servicios</h2>
          <h3 class="section-subheading text-muted">La calidad de nuestros servicios es nuestra mejor publicidad</h3>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-utensils fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Restaurante</h4>
          <p class="text-muted">El placer de los banquetes debe medirse no por la abundancia de los manjares, sino por la reunión de los amigos y por su conversación</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-wine-glass-alt fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Licor</h4>
          <p class="text-muted">Un buen vino es como una buena película: dura un instante y te deja en la boca un sabor a gloria; es nuevo en cada sorbo y, como ocurre con las películas, nace y renace en cada saboreador.</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-map-marker-alt fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Salon</h4>
          <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
        </div>
        <div class="col-md-6 mt-5">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-camera fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Fotografia</h4>
          <p class="text-muted">Las mejores imágenes son aquellas que retienen su fuerza e impacto a través de los años, a pesar del número de veces que son vistas.</p>
        </div>
        <div class="col-md-6 mt-5">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-music fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Animacion</h4>
          <p class="text-muted">Deberíamos considerar día perdido aquél en el que no hayamos bailado.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Portfolio Grid -->
  <section class="bg-light page-section" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Portafolio</h2>
          <h3 class="section-subheading text-muted">Nuestro Portafolio de Eventos</h3>
        </div>
      </div>
      <div class="row justify-content-center">
      <?php
      $consulta=mysqli_query($conexion,"SELECT nombre, idtipoevento, imagen FROM tipoevento WHERE categoria='Basico'");
      while($mostrar=mysqli_fetch_array($consulta)){
      ?>
        <div class="col-md-4 col-sm-6 portfolio-item">
          <a class="portfolio-link" data-toggle="modal" href="#modal<?php echo $mostrar['idtipoevento']?>">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img src="../productos/<?php echo $mostrar['imagen']?>" height="220px" width="100%" alt="">
          </a>
          <div class="portfolio-caption">
            <h4><?php echo $mostrar['nombre']?></h4>
          </div>
        </div>
        <?php
      }
    ?>
      </div>
    </div>
  </section>
  <?php
      $consulta=mysqli_query($conexion,"SELECT * FROM tipoevento WHERE categoria='Basico'");
      while($mostrar=mysqli_fetch_array($consulta)){
        $nombre=$mostrar['nombre'];
        $resul=$conexion->query("SELECT COUNT(e.idtipoevento)as conteo, t.categoria FROM evento e, tipoevento t WHERE t.nombre='$nombre' AND t.idtipoevento=e.idtipoevento");
            $key=$resul->fetch_assoc();
            $conteo=$key["conteo"];
            $categoria=$key["categoria"];
      ?>

         <!-- Modal 1 -->
    <div class="portfolio-modal modal fade" id="modal<?php echo $mostrar['idtipoevento']?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <h2 class="text-uppercase"><?php echo $mostrar['nombre']?></h2>
        <div class="close-modal" data-dismiss="modal">
        
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 m-auto">
              <div class="modal-body">
                <!-- Project Details Go Here -->
                
                <img class="mx-auto" src="../productos/<?php echo $mostrar['imagen']?>" width="100%" alt="">
                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                <ul class="list-inline">
                  <?php
                  if($conteo!=0){
                    ?>
                      <li>Organizados: <?php echo $conteo?></li>
                      <li>Categoria: <?php echo $categoria?></li>
                    <?php
                  }
                  ?>
                </ul>
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                  <i class="fas fa-times"></i> Cerrar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
        <?php
      }
    ?>

   



  <!-- About -->
  <section class="page-section" id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Categorias</h2>
          <h3 class="section-subheading text-muted">En EventosGuatoc tenemos diferentes categorias de precios para que puedas elegir la que mas te convenga</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <ul class="timeline">
            <li>
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="../img/bronce.png" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4 class="subheading">Basico</h4>
                </div>
                <div class="timeline-body">
                  <p class="text-muted">Si lo que buscas es calidad a un menor precio, aqui podras encontrar los paquetes mas economicos que no podras conseguir en ningun otro lugar</p>
                </div>
              </div>
            </li>
            <li class="timeline-inverted">
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="../img/silver.png" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4 class="subheading">Estandar</h4>
                </div>
                <div class="timeline-body">
                  <p class="text-muted">Si quieres un evento memorable para ti y tus invitados; con calidad y buen servicio y que a la vez su costo no sea tan elevado, aqui lo podras encontrar</p>
                </div>
              </div>
            </li>
            <li>
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="../img/gold.png" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4 class="subheading">Premium</h4>
                </div>
                <div class="timeline-body">
                  <p class="text-muted">Si deseas un evento a un nivel superior: vanguardista y de calidad, con los mejores servicios y paquetes para el usuario.Aqui encontraras la mas alta calidad para tu evento</p>
                </div>
              </div>
            </li>
            <li class="timeline-inverted">
              <div class="timeline-image">
                <h4>Queremos ser
                  <br>parte de
                  <br>tu historia!</h4>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Team -->
  <section class="bg-light page-section" id="team">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Nuestras increible equipo de Empresas</h2>
          <h3 class="section-subheading text-muted">Contamos con las empresas mas reconocidas a nivel regional</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="img/team/1.jpg" alt="">
            <h4>Restaurante Bar Son Arrieros</h4>
            <p class="text-muted">Lead Designer</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="img/team/2.jpg" alt="">
            <h4>Larry Parker</h4>
            <p class="text-muted">Lead Marketer</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="img/team/3.jpg" alt="">
            <h4>Diana Pertersen</h4>
            <p class="text-muted">Lead Developer</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 mx-auto text-center">
          <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Clients -->
  <section class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6">
          <a href="#">
            <img class="img-fluid d-block mx-auto" src="img/logos/envato.jpg" alt="">
          </a>
        </div>
        <div class="col-md-3 col-sm-6">
          <a href="#">
            <img class="img-fluid d-block mx-auto" src="img/logos/designmodo.jpg" alt="">
          </a>
        </div>
        <div class="col-md-3 col-sm-6">
          <a href="#">
            <img class="img-fluid d-block mx-auto" src="img/logos/themeforest.jpg" alt="">
          </a>
        </div>
        <div class="col-md-3 col-sm-6">
          <a href="#">
            <img class="img-fluid d-block mx-auto" src="img/logos/creative-market.jpg" alt="">
          </a>
        </div>
      </div>
    </div>
  </section>
<?php
    require 'Footer.php';
?>