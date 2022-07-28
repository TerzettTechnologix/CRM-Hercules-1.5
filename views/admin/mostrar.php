<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/build/img/apple-icon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="/build/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/build/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="/build/demo/demo.css" rel="stylesheet" />
  <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="red">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <img src="/build/img/System_Hercules.png" alt="">
        </a>
        <a style="font-family: 'Righteous', cursive;" class="simple-text logo-normal">
        CRM Hercules
        </a> 
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
        <li>
            <a href="/admin/usuario">
              <i class="now-ui-icons users_single-02"></i>
              <p>Cuenta</p>
            </a>
          </li>
          <li>
            <a href="/admin/usuarios">
              <i class="now-ui-icons business_badge"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <li class="active ">
            <a href="/admin/proyectos">
              <i class="now-ui-icons education_atom"></i>
              <p>Proyectos</p>
            </a>
          </li>
          <li>
            <a href="/logout">
              <i class="now-ui-icons objects_key-25"></i>
              <p>Cerrar sesión</p>
            </a>
          </li>
          <li class="active-pro">
            <a href="/Retro">
              <i class="now-ui-icons objects_support-17"></i>
              <p>Soporte Técnico</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Administración de proyectos</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header d-flex bd-highlight">
            <h4 class="card-title p-2 flex-grow-1 bd-highlight">Comentarios y archivos de la tarea: <?php echo $tarea->nombre?> </h4>
              <!-- <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              Agregar comentarios/archivos.
            </a> -->
            </div>
          <!-- <?php
              include_once __DIR__."/../templates/alertas.php";
          ?>
          <?php 
            $mensaje = mostrarNotificacion( intval( $resultado) );
            if($mensaje) { ?>
              <p class="alert alert-success text-white font-weight-bold text-center text-uppercase"><?php echo s($mensaje); ?></p>
            <?php } 
          ?> -->
              <!-- <form method="POST" action="/admin/proyectos/tablon/comentarios?url=<?php echo $tarea->url?>" enctype="multipart/form-data">
            <div class="container">
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                <div class="mb-3">
                        <label for="contenido">Agregar comentario</label>
                    <textarea class="form-control" id="contenido" rows="3" placeholder="¿Qué esta pasando?" name="contenido"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
            </div>
        </form> -->
          <?php if(empty($comentarios)) {?>
            <p class="text-center">No hay comentarios aun</p>
          <?php } ?>
          <?php foreach($comentarios as $comentario) {?>
            
            <div class="card text-center container">
                <div class="card-body">
                  <h5 class="card-title">Envio un comentario: <br></h5><?php echo $comentario->nombre; ?><br>
                  <h5 class="card-title">Mensaje: <br></h5><?php echo $comentario->contenido; ?>
                  <p class="mt-3 h5">Archivos :</p>
                  <?php if(!($comentario->imagen==="")){?>
                    <a href="/imagenes/<?php  echo $comentario->imagen;?>" class="btn btn-primary">Imagen</a>
                  <?php } ?>
                  <?php if(!($comentario->archivo==="")){?>
                    <a href="/archivos/<?php  echo $comentario->archivo;?>" class="btn btn-primary">Documento</a>
                  <?php }?>
                  <div class="card-footer text-muted">
                    <strong>Fecha de envio:<br></strong> <?php echo ($comentario->fecha); ?>
                  </div>
                  <form method="POST" action="/admin/proyectos/comentarios/eliminar?url=<?php echo $comentario->id?>">
                    <button href="/admin/proyectos/comentarios/eliminar?url=<?php echo $comentario->id?>" rel="tooltip" title="Eliminar Comentario" class="btn btn-danger" >Eliminar Comentario</button>
                  </form>
              </div>
            </div>
              <?php } ?>
            </div>
            <a href="/admin/proyectos/tablon?url=<?php echo $url ?>" type="submit" class="btn btn-primary">Volver</a>
          </div>
        </div>
      
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
            <li>
                <a href="https://policy.terzett.tech/privacy-es">
                  Política de privacidad
                </a>
              </li>
              <li>
                <a href="https://policy.terzett.tech/quality-es">
                  Política de calidad
                </a>
              </li>
              <li>
                <a href="https://policy.terzett.tech/security-es">
                  Política de seguridad
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Terzett Technologix. Todos los derechos reservados.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="/build/js/core/jquery.min.js"></script>
  <script src="/build/js/core/popper.min.js"></script>
  <script src="/build/js/core/bootstrap.min.js"></script>
  <script src="/build/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="/build/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="/build/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="/build/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="/build/demo/demo.js"></script>
  <script src="/build/js/grupos.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>

  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
</body>


</html>