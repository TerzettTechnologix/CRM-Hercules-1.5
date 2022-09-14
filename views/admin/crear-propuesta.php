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
  <link rel="icon" type="image/png" href="/build/img/logo-terzett.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Proyectos | Terzett Technologix
  </title>
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
        System Hercules
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
            <a href="/Retro">
              <i class="now-ui-icons design_palette"></i>
              <p>Ayuda</p>
            </a>
          </li>
          <li>
            <a href="/logout">
              <i class="now-ui-icons objects_key-25"></i>
              <p>Cerrar sesión</p>
            </a>
          </li>
          <li class="active-pro">
            <a href="https://policy.terzett.tech/privacy-es" target="_blank">
              <i class="now-ui-icons ui-1_lock-circle-open"></i>
              <p>Aviso de privacidad</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
            <nav class="navbar navbar-expand-lg bg-primary navbar-absolute navbar-transparent">
            <div class="container-fluid">
            <div class="navbar-wrapper">
            <div class="navbar-toggle">
            <button type="button" class="navbar-toggler">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
            </button>
            </div>
            <a class="navbar-brand" href="#pablo">Admnistración de proyectos</a>
            </div>
            
            <div class="navbar-collapse justify-content-end collapse show" id="navigation" style="">

            

            <ul class="navbar-nav">
            <li class="nav-item dropdown">
            <p>
            <span class="d-lg-none d-md-block">Some Actions</span>
            </p>
            </a>
            
            </li>
            </ul>
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
          <div class="card-header d-flex bd-highlight">
              <h4 class="card-title p-2 flex-grow-1 bd-highlight">Creacion de Propuestas</h4>
            </div>
            <div class="container">
              <table class="table table-dark m-1">
                  <thead>
                      <tr>
                        <th scope="col">Datos para llenado de propuesta</th>
                        <th scope="col">Columna a llenar por el vendedor</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                      <th  class="info" scope="row">Vendedor
                        <i class="now-ui-icons ui-1_zoom-bold prueba"></i>
                         <div id="vendedorTabla">
                         <table>
                            <thead>
                              <tr>
                                <th>Informacion sobre Vendedor</th>
                              </tr>
                            </thead>
                              <tbody class="text-black">
                                    <td class="text-white">Automaticamente al seleccionar usuario se indicarán los datos del vendedor así como se actualizará la 
                                      propuesta con las letras ya asignadas</td>
                              </tbody>
                          </table>
                         </div>
                      </th>
                        <td id="creador" class="text-center"><?php echo $usuario?></td>
                      </tr>
                      <tr>
                        <th class="ventaHover" scope="row">Numero de venta
                        <i class="now-ui-icons ui-1_zoom-bold prueba"></i>
                         <div id="numeroVentaTabla">
                         <table>
                            <thead>
                              <tr>
                                <th>Informacion sobre el numero de Venta</th>
                              </tr>
                            </thead>
                              <tbody class="text-black">
                                    <td class="text-white">Coloque el numero de venta que se le asignara a esta propuesta</td>
                              </tbody>
                          </table>
                         </div>
                        </th>
                        <td >
                          <div class="form-outline" style="width: 22rem;">
                            <input min="0" max="10000" type="number" id="idVenta" class="form-control" />
                          </div>
                        </td>
                        <td></td>
                      </tr>
                        <tr>
                        <th class="hoverAlgoritmo" scope="row">Algoritmo de cálculo
                        <i class="now-ui-icons ui-1_zoom-bold prueba"></i>
                         <div id="algoritmoTabla">
                         <table>
                            <thead>
                              <tr>
                                <th>Informacion sobre Algoritmo Calculo</th>
                              </tr>
                            </thead>
                              <tbody class="text-black">
                                    <td class="text-white">El cálculo será modificado dependiendo de: 1) Si es una venta normal 2) Si es de manufactura 
                                      3) Si es urgencia de ventas o 4) Si es urgencia de manufactura</td>
                              </tbody>
                          </table>
                         </div>
                        </th>
                        <td>
                        <select id="algoritmo" class="form-select" aria-label="Seleccione una opcion">
                          <option selected disabled>Seleccione una opcionde venta </option>
                          <option value="1">Ventas</option>
                          <option value="2">Manofactura</option>
                          <option value="3">Urgencia Venta</option>
                          <option value="4">Urgencia Manofactura</option>
                        </select>
                        </td>
                      </tr>
                      <tr>
                        <th class="hoverCliente" scope="row">Cliente
                        <i class="now-ui-icons ui-1_zoom-bold prueba"></i>
                         <div id="clienteTabla">
                         <table>
                            <thead>
                              <tr>
                                <th>Informacion sobre Cliente</th>
                              </tr>
                            </thead>
                              <tbody class="text-black">
                                    <td class="text-white">Seleccione el cliente y automaticamente se modificarán los datos: número de proveedor, 
                                      porcentaje por crédito otorgado, coste de envío y la lista de clientes</td>
                              </tbody>
                          </table>
                         </div>
                         </th>
                        <td>
                          <select id="cliente" class="form-select" aria-label="Seleccione una opcion">
                            <option selected disabled>Seleccione una opcionde venta </option>
                            <option value="1">Becton Dickinson</option>
                            <option value="2">Tritec LLC</option>
                            <option value="3">Cerealto Siro</option>
                            <option value="4">DHL</option>
                            <option value="5">ATD Sensores</option>
                            <option value="6">British American Tobacco</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">ID Proveedor</th>
                        <td id="idProvedor"></td>
                        
                      </tr>
                      <tr>
                        <th class="solicitadoHover" scope="row">Solicitado por
                        <i class="now-ui-icons ui-1_zoom-bold prueba"></i>
                         <div id="solicitadoTabla">
                         <table>
                            <thead>
                              <tr>
                                <th>Informacion sobre persona que solicita</th>
                              </tr>
                            </thead>
                              <tbody class="text-black">
                                    <td class="text-white">Seleccionar del menu desplegable el usuario</td>
                              </tbody>
                          </table>
                         </div>
                        </th> 
                        <td>
                        <select id="nombreSolicitado" class="form-select" aria-label="Seleccione una opcion">
                            <option selected disabled>Seleccione el usuario cliente </option>
                            
                          </select>
                        </td>
                        
                      </tr>
                      <tr>
                        <th scope="row">Fecha</th>
                        <td id="Fecha" class="text-center"><?php echo date("d-M-Y") ?></td>
                        <td></td>
                      </tr>
                      <tr>
                        <th class="PesoHover" scope="row">Mexican Peso
                        <i class="now-ui-icons ui-1_zoom-bold prueba"></i>
                         <div id="PesoTabla">
                         <table>
                            <thead>
                              <tr>
                                <th>Informacion sobre el valor del peso</th>
                              </tr>
                            </thead>
                              <tbody class="text-black">
                                    <td class="text-white">El valor del peso se obtiene cada que se ejecuta esta seccion del sistema
                                      gracias a una API
                                    </td>
                              </tbody>
                          </table>
                         </div>
                        </th>
                        <td id="valorPeso"></td>
                        
                      </tr>
                      <th class="dolarHover" scope="row">Valor dólar empleado (MXN+7%)
                      <i class="now-ui-icons ui-1_zoom-bold prueba"></i>
                         <div id="dolarTabla">
                         <table>
                            <thead>
                              <tr>
                                <th>Informacion sobre el valor dolar empleado</th>
                              </tr>
                            </thead>
                              <tbody class="text-black">
                                    <td class="text-white">Porcentaje de riesgo por variaciones comerciales no previstas
                                    </td>
                              </tbody>
                          </table>
                         </div>
                      </th>
                        <td id="valorDolarPeso"></td>
                      </tr>
                        <tr>
                        <th class="hoverAdquisicion" scope="row">Tipo de adquisición
                        <i class="now-ui-icons ui-1_zoom-bold prueba"></i>
                         <div id="adquisicionTabla">
                         <table>
                            <thead>
                              <tr>
                                <th>Informacion sobre el tipo de adquision</th>
                              </tr>
                            </thead>
                              <tbody class="text-black">
                                    <td class="text-white">Seleccionar del menu desplegable 1) Si hay en stock, 2) SALVO PREVIA VENTA, 3) A tiempo de entrega
                                    </td>
                              </tbody>
                          </table>
                         </div>
                        </th>
                        <td>
                        <select id="tipoAdquisicion" class="form-select" aria-label="Seleccione una opcion">
                            <option selected disabled>Seleccione una opcionde adquisición</option>
                            <option value="1">Salvo previa venta</option>
                            <option value="2">Stock</option>
                            <option value="3">A tiempo de entrega</option>
                          </select>
                        </td>
                        
                      </tr>
                      <tr>
                        <th scope="row">Días de crédito</th>
                        <td id="credito"></td>
                        
                      </tr>
                      <tr>
                        <th class="aduanaHover" scope="row">Coste aduanal
                        <i class="now-ui-icons ui-1_zoom-bold prueba"></i>
                         <div id="aduanaTabla">
                         <table>
                            <thead>
                              <tr>
                                <th>Informacion sobre el Coste Adanual</th>
                              </tr>
                            </thead>
                              <tbody class="text-black">
                                    <td class="text-white">Indicar si el precio incurre en un coste aduanal de ser así este se agregará en cada uno de los ítems
                                    </td>
                              </tbody>
                          </table>
                         </div>
                        </th>
                        <td id="costoAdanual">
                          <div class="form-outline" style="width: 22rem;">
                            <input min="0" max="20" type="number"  class="form-control" />
                          </div>
                        </td>
                        
                      </tr>
                      <tr>
                        <th class="costeTransporteHover" scope="row">Tipo de transporte IDA+ VUELTA
                        <i class="now-ui-icons ui-1_zoom-bold prueba"></i>
                         <div id="costeTransporteTabla">
                         <table>
                            <thead>
                              <tr>
                                <th>Informacion sobre coste de tranposte IDA y VUELTA</th>
                              </tr>
                            </thead>
                              <tbody class="text-black">
                                    <td class="text-white">Esta es la tasa de precio indicada para un auto utilitario considerando gasolina y desgaste del automóvil. 
                                      En el caso conocido de DHL y Cerealto incluye Peaje. Este valor no será tomado en cuenta si se realizará un flete
                                    </td>
                              </tbody>
                          </table>
                         </div>
                        </th>
                        <td id="transporte"></td>
                       
                      </tr>
                      <tr>
                        <th scope="row">Porcentaje de crédito</th>
                        <td id="porcentajeCredito"></td>
                        
                      </tr>
                      <tr>
                        <th scope="row">Coste aduana por ítem</th>
                        <td id="costoAdanualItem">
                          <div class="form-outline" style="width: 22rem;">
                            <input min="0" max="20" type="number" class="form-control" />
                          </div>
                        </td>
                       
                      </tr>
                      <tr>
                        <th scope="row">Cantidad de ítems</th>
                        <td id="cantidadItems">
                          <div class="form-outline" style="width: 22rem;">
                            <input min="0" max="20" type="number" id="numeroItems" class="form-control" />
                          </div>
                        </td>
                       
                      </tr>
                      <tr>
                        <th class="itemTransporteHover" scope="row">Coste de transporte por ítem
                        <i class="now-ui-icons ui-1_zoom-bold prueba"></i>
                         <div id="itemTransporteTabla">
                         <table>
                            <thead>
                              <tr>
                                <th>Informacion sobre coste de transporte por ítem</th>
                              </tr>
                            </thead>
                              <tbody class="text-black">
                                    <td class="text-white">Este valor depende de si es o no considerado un flete (si se usa utilitario marcar con 0 el coste del flete)
                                    </td>
                              </tbody>
                          </table>
                         </div>
                        </th>
                        <td id="costoItem"></td>
                        
                      </tr>
                      <tr>
                        <th scope="row">Gasto Operativo</th>
                        <td id="gasOpe"></td>
                       
                      </tr>
                      <tr>
                        <th scope="row">Utilidad vendedor</th>
                        <td id="utiVen"></td>
                        
                      </tr>
                      <tr>
                        <th scope="row">Coste empresa</th>
                        <td id="cosEmp"></td>
                       
                      </tr>
                      <tr>
                        <th scope="row">Margen negociación</th>
                        <td id="marNeg"></td>
                        
                      </tr>
                      <tr>
                        <th scope="row">SUMA de porcentajes PROPUESTA</th>
                        <td id="suma"></td>
                        
                      </tr>
                      <tr>
                        <th class="fleteHover" scope="row">Coste Flete
                        <i class="now-ui-icons ui-1_zoom-bold prueba"></i>
                         <div id="fleteTabla">
                         <table>
                            <thead>
                              <tr>
                                <th>Informacion sobre Costo de Flete</th>
                              </tr>
                            </thead>
                              <tbody class="text-black">
                                    <td class="text-white">Solo llena en caso de que se requiera transportar las cosas con auto distinto al utilitario (debe cotizarse el servicio)
                                    </td>
                              </tbody>
                          </table>
                         </div>
                        </th>
                        <td>
                          <div class="form-outline" style="width: 22rem;">
                            <input min="0" max="500000" type="number" id="costoFlete" class="form-control" />
                          </div>
                        </td>
                        
                      </tr>
                      <tr>
                        <th class="validezPropuestaHover" scope="row">Validez de la propuesta (días hábiles)
                        <i class="now-ui-icons ui-1_zoom-bold prueba"></i>
                         <div id="validezProuestaTabla">
                         <table>
                            <thead>
                              <tr>
                                <th>Informacion de validez de la propuesta</th>
                              </tr>
                            </thead>
                              <tbody class="text-black">
                                    <td class="text-white">Tener cuidado de considerar un margen de +3 días hábiles para ventas, +4 para manufactura (por revisión de control de calidad)
                                    </td>
                              </tbody>
                          </table>
                         </div>
                        </th>
                        <td>
                          <div class="form-outline" style="width: 22rem;">
                            <input min="0" max="100" type="number" id="diasHabiles" class="form-control" />
                          </div>
                        </td>
                        
                      </tr>
                      <tr>
                        <th scope="row">Tiempo de entrega máximo</th>
                        <td>
                          <div class="form-outline" style="width: 22rem;">
                            <input min="0" max="10000" type="number" id="numeroMaximo" class="form-control" />
                          </div>
                        </td>
                       
                      </tr>
                  </tbody>
              </table>
            </div>
            <button href="#" class="btn btn-primary text-white" id="btnSalvar">Salvar resultados</a>
          </div>
        </div>
      
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
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
    <script>
$('.eliminar').submit(function(e){
        e.preventDefault();
        swal({
        title: '¿Deseas eliminar?',
        text: "¡Esta acción no se puede revertir!",
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