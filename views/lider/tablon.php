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
            <a href="/lider/usuario">
              <i class="now-ui-icons business_badge"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <li class="active ">
            <a href="/lider/proyectos">
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
            <a href="/AyudaLider">
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
            <a class="navbar-brand" href="#pablo"><?php echo $tablon->nombre; ?></a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <strong>Líder de proyecto:</strong>  <?php echo $tablon->lider; ?>
            </div>
            
            <div class="row justify-content-center">
        <p class="col-2">
             
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseGrupos" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="now-ui-icons ui-1_simple-add"></i> Crear nuevo grupo de tareas
            </a>
        </p>
        <p class="col-2">
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseTareas" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="now-ui-icons ui-1_simple-add"></i>Agregar tareas a grupos
            </a>
        </p>
        </div>
        
        <?php
              include_once __DIR__."/../templates/alertas.php";
          ?>
          <?php 
            $mensaje = mostrarNotificacion( intval( $resultado) );
            if($mensaje) { ?>
              <p class="alert alert-success text-white font-weight-bold text-center text-uppercase"><?php echo s($mensaje); ?></p>
            <?php } 
          ?>
        <form method="POST" action="/lider/proyectos/grupo?url=<?php echo $tablon->url?>">
          <div class="container">
              <div class="collapse" id="collapseGrupos">
                  <div class="card card-body">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del grupo:</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre del grupo" name="nombre">
              </div>
              <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
              </div>
          </div>
        </form>
        
        <form method="POST" action="/lider/proyectos/tarea?url=<?php echo $tablon->url?>">
          <div class="container">
          <div class="container">
              <div class="collapse" id="collapseTareas">
                  <div class="card card-body">
              <div class="mb-3">
              <label for="nombre" class="form-label">Nombre de la tarea:</label>
              <input type="text" class="form-control" id="nombre" placeholder="Nombre de la tarea" name="nombre">
              </div>
              <label for="exampleFormControlInput1" class="form-label">Para el grupo:</label>
              <select class="form-select" aria-label="Default select example" name="grupo">
                  <option selected="true" disabled="disabled">Selecciona el grupo al que le quieres agregar la tarea</option>
                  <?php foreach($grupos as $grupo) {?>
                    <option value="<?php echo $grupo->id?>"><?php echo $grupo->nombre; ?></option>
                  <?php }?>
                </select>
                <br>
              <label for="exampleFormControlInput1" class="form-label">Asignada para:</label>
              <div class="container-lg col-md-2 ">
              <?php foreach($usuarios as $usuario) {?>
                <ul class=" list-group-horizontal"> 
                <li class="list-group-item"><input class="form-check-input " type="checkbox" value="<?php echo $usuario->id;?>" id="usuario" name='CheckBox[]'>
              <label class="form-check-label" for="usuario"><?php echo $usuario->nombre; ?></label> </li> 
               </ul> 
              <?php }?>
              </div>
              </div>
              <button type="submit" class="btn btn-primary ">Guardar</button>
            </form>  
            </div>
            </div>
        </div>
        <div class="container">
        <?php foreach($grupos as $grupo){ ?>         
          
          <table class="table">
              <thead>
                <tr>
                  <th class="text-primary" scope="col"><?php echo $grupo->nombre ?></th>
                  <th scope="col"><strong>Asignación</strong></th>
                  <th scope="col"><strong>Estado</strong></th>
                  <th scope="col"><strong>Fecha de creación</strong></th>
                  <th scope="col"><strong>Acciones</strong></th>
                  <th scope="col">
                    <form method="POST" action="/lider/proyectos/grupo/eliminar?id=<?php echo $grupo->id?>" class="eliminar">
                      <button href="/lider/proyectos/grupo/eliminar?id=<?php echo $grupo->id?>" rel="tooltip" title="Eliminar Grupo" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" >
                          <i class="now-ui-icons ui-1_simple-remove"></i>
                      </button>
                    </form>
                  </th>
                </tr>
              </thead>
              <tbody> 
                <?php foreach($tareas as $tarea) { ?>
                  <tr>
                      <?php if($tarea->IdGrupo==$grupo->id) { ?>
                      <th scope="row"><?php echo $tarea->nombre ?></th>  
                        <td>
                          <?php foreach($usuarioTareas as $usuarioTarea) { ?>
                            
                            <?php if($tarea->id==$usuarioTarea->IdTarea) echo $usuarioTarea->nombre . '<br>'  ?>
                            
                            <?php } ?>
  
                        </td>
                      <?php if($tarea->estado=='0') $tarea->estado="Nueva" ?>
                      <?php if($tarea->estado=='1') $tarea->estado="Estancada" ?>
                      <?php if($tarea->estado=='2') $tarea->estado="En proceso" ?>
                      <?php if($tarea->estado=='3') $tarea->estado="Lista" ?>
                      <td><?php echo $tarea->estado ?></td>
                      
                      <td class="text-center"><?php echo $tarea->fecha ?></td> 
                      <td>
                      <div class="d-flex align-items-center">
                      <a href="/lider/proyectos/tablon/tareas-actualizar?url=<?php echo $tarea->url?>" rel="tooltip" title="Actualizar información" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret">
                            <i class="now-ui-icons design-2_ruler-pencil"></i>
                        </a>
                        <form method="POST" action="/lider/proyectos/tablon/eliminar?url=<?php echo $tarea->url?>">
                          <button href="/lider/proyectos/tablon/eliminar?url=<?php echo $tarea->url?>" rel="tooltip" title="Eliminar tarea" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" >
                              <i class="now-ui-icons ui-1_simple-remove"></i>
                          </button>
                        </form>
                        
                        <a href="/lider/proyectos/tablon/comentarios?url=<?php echo $tarea->url?>" rel="tooltip" title="Agregar comentarios-complementos" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" >
                            <i class="now-ui-icons ui-1_simple-add"></i>
                          </a>
                        <a href="/lider/proyectos/tablon/contenido?url=<?php echo $tarea->url?>" rel="tooltip" title="Visualizar complementos" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret">
                            <i class="now-ui-icons design_bullet-list-67"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
              </tbody>
            </table>
            <div class="progress">
              <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?php echo ($grupo->nuevas/$grupo->total) *100  ?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"><?php echo "Nuevas" ." ". round(($grupo->nuevas/$grupo->total),2)  *100 ." " ."%" ?></div>
              <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: <?php echo ($grupo->proceso/$grupo->total) *100  ?>%"  aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"><?php echo "Proceso" ." ". round(($grupo->proceso/$grupo->total),2) *100 ." " ."%" ?></div>
              <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?php echo ($grupo->estancadas/$grupo->total) *100  ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><?php echo "Estancadas" ." ". round(($grupo->estancadas/$grupo->total),2) *100 ." " ."%" ?></div>
              <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo ($grupo->listas/$grupo->total) *100  ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><?php echo "Listas" ." ". round(($grupo->listas/$grupo->total),2) *100 ." " ."%" ?></div>
            </div>
        <?php } ?>
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
  <script src="/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="/build/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="/build/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="/build/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="/build/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
    <script>
$('.eliminar').submit(function(e){
        e.preventDefault();
        swal({
        title: '¿Deseas eliminar?',
        text: "¡Esta acción no se puede revertir! Se eliminaran todas las tareas con sus comentarios y archivos",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si,eliminar',
        cancelButtonText: 'Cancelar'
        }).then((result) => {
            swal(
            'Datos Eliminados!',
            'eliminación correcta',
            'success'
            )
            this.submit();
        
        })
    });    
</script>
</body>

</html>