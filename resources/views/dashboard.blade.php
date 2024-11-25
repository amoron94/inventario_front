<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Panel Principal</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" href="{{ asset('img/photos/logo_gestock_b.png') }}" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}">

    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap.css">
    <link href="{{asset('css/stilosDataTable.css')}}" rel="stylesheet">

    <link href="{{asset('css/radiobutton.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

        .sidebar-link .feather-chevron-down,
        .sidebar-link .feather-chevron-up {
            transition: transform 0.3s;
        }

        .sidebar-link.collapsed .feather-chevron-up {
            display: none;
        }

        .sidebar-link:not(.collapsed) .feather-chevron-down {
            display: none;
        }

        .sidebar-link:not(.collapsed) .feather-chevron-up {
            display: inline;
        }

        .txt-flecha{
            color: #9a9a9b;
        }

        .txt-flecha:hover{
            color: #d1d1d1;
        }

        a.sidebar-link.sub-pag {
            padding-left: 50px;
        }



        .logo-menu{
            background: #222E3C;
            padding: 14px 0px;
            font-family: auto;
        }

        .logo-container {
            display: flex;           /* Activa Flexbox */
            align-items: center;     /* Centra verticalmente */
            justify-content: center; /* Centra horizontalmente */
            gap: 10px;               /* Espacio entre la imagen y el texto */
        }

        .logo_ges{
            width: 50px;
            height: 50px;
        }

        .logo-titulo{
            color: #4CAF50;
            font-size: 30px;
            font-family: 'Poppins', sans-serif !important;
        }

        @media (max-width: 768px) {

            .logo-menu{
                background: #222E3C;
                padding: 15px 0px;
                font-family: auto;
            }

            .logo_ges{
                width: 40px;
                height: 40px;
            }

            .logo-titulo{
                color: #4CAF50;
                font-size: 25px;
                font-family: 'Poppins', sans-serif !important;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <?php $usuario = session('usuario_logueado'); ?>

    <div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand logo-menu" href="{{ url('dashboard') }}">
                    <div class="logo-container">
                        <img src="{{asset('img/photos/logo_gestock_b.png')}}" class="logo_ges">
                        <span class="logo-titulo"><b> ESTOCK</b></span>
                    </div>
                </a>

				<ul class="sidebar-nav" style="margin-top: 20px">


                    <li class="sidebar-item">
						<a data-bs-target="#productos" data-bs-toggle="collapse" class="sidebar-link collapsed flecha" aria-expanded="false">
							<i class="align-middle" data-feather="paperclip"></i> <span class="align-middle txt-flecha">Parametros</span>
                            <svg class="feather feather-chevron-down align-middle sidebar-badge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                            <svg class="feather feather-chevron-up align-middle sidebar-badge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15"></polyline>
                            </svg>
						</a>
						<ul id="productos" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
							<li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('u_medida') }}">
                                    <i class="align-middle" data-feather="filter"></i> U. Medida
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('categoria') }}">
                                    <i class="align-middle" data-feather="folder"></i> Categoria
                                </a>
                            </li>
						</ul>
					</li>



                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{ url('producto') }}">
                            <i class="align-middle" data-feather="package"></i> <span class="align-middle">Productos</span>
                        </a>
					</li>

                    <li class="sidebar-item">
						<a data-bs-target="#inventario" data-bs-toggle="collapse" class="sidebar-link collapsed flecha" aria-expanded="false">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle txt-flecha">Inventario</span>
                            <svg class="feather feather-chevron-down align-middle sidebar-badge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                            <svg class="feather feather-chevron-up align-middle sidebar-badge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15"></polyline>
                            </svg>
						</a>
						<ul id="inventario" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
                            <li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('stock') }}">
                                    <i class="align-middle" data-feather="list"></i> Stock
                                </a>
                            </li>
                            @if($usuario['data']['tipo'] != 'CAJERO')

                            @if ($usuario['data']['sucursales'] == 'SI')
							<li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('movimiento_stock') }}">
                                    <i class="align-middle" data-feather="truck"></i> Movimiento
                                </a>
                            </li>
                            @endif
                            @endif
                            <li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('lote') }}">
                                    <i class="align-middle" data-feather="database"></i> Lotes de Productos
                                </a>
                            </li>
						</ul>
					</li>

                    @if($usuario['data']['tipo'] != 'CAJERO')
                    <li class="sidebar-item">
						<a data-bs-target="#produccion" data-bs-toggle="collapse" class="sidebar-link collapsed flecha" aria-expanded="false">
							<i class="align-middle" data-feather="layers"></i> <span class="align-middle txt-flecha">Produccion</span>
                            <svg class="feather feather-chevron-down align-middle sidebar-badge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                            <svg class="feather feather-chevron-up align-middle sidebar-badge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15"></polyline>
                            </svg>
						</a>
						<ul id="produccion" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
							<li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('produccion') }}">
                                    <i class="align-middle" data-feather="list"></i> Recetas
                                </a>
                            </li>
							<li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('combo') }}">
                                    <i class="align-middle" data-feather="list"></i> Combos
                                </a>
                            </li>
						</ul>
					</li>

                    @endif

                    <li class="sidebar-header">
						Ingresos
					</li>



                    <li class="sidebar-item">
						<a data-bs-target="#ventas" data-bs-toggle="collapse" class="sidebar-link collapsed flecha" aria-expanded="false">
							<i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle txt-flecha">Ventas</span>
                            <svg class="feather feather-chevron-down align-middle sidebar-badge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                            <svg class="feather feather-chevron-up align-middle sidebar-badge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15"></polyline>
                            </svg>
						</a>
						<ul id="ventas" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
							<li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('cliente') }}">
                                    <i class="align-middle" data-feather="users"></i> Cliente
                                </a>
                            </li>
							<li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('pos') }}" target="_blank">
                                    <i class="align-middle" data-feather="grid"></i> POS
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('venta') }}">
                                    <i class="align-middle" data-feather="inbox"></i> Ventas
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('cobro') }}">
                                    <i class="align-middle" data-feather="inbox"></i> Cobros Pendientes
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('caja') }}">
                                    <i class="align-middle" data-feather="codepen"></i> Cajas
                                </a>
                            </li>
						</ul>

					</li>

                    @if($usuario['data']['tipo'] != 'CAJERO')
                    <li class="sidebar-header">
						Egresos
					</li>

                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{ url('servicios') }}">
                            <i class="align-middle" data-feather="tag"></i> <span class="align-middle">Servicios</span>
                        </a>
					</li>

                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{ url('gastos') }}">
                            <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Gastos</span>
                        </a>
					</li>

                    <li class="sidebar-item">
						<a data-bs-target="#compras" data-bs-toggle="collapse" class="sidebar-link collapsed flecha" aria-expanded="false">
							<i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle txt-flecha">Compras</span>
                            <svg class="feather feather-chevron-down align-middle sidebar-badge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                            <svg class="feather feather-chevron-up align-middle sidebar-badge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15"></polyline>
                            </svg>
						</a>
						<ul id="compras" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
							<li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('proveedor') }}">
                                    <i class="align-middle" data-feather="users"></i> Proveedor
                                </a>
                            </li>
							<li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('compras') }}">
                                    <i class="align-middle" data-feather="shopping-bag"></i> Orden Compra
                                </a>
                            </li>
						</ul>
					</li>

                    <li class="sidebar-item">
						<a data-bs-target="#reporte" data-bs-toggle="collapse" class="sidebar-link collapsed flecha" aria-expanded="false">
							<i class="align-middle" data-feather="calendar"></i> <span class="align-middle txt-flecha">Reportes</span>
                            <svg class="feather feather-chevron-down align-middle sidebar-badge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                            <svg class="feather feather-chevron-up align-middle sidebar-badge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15"></polyline>
                            </svg>
						</a>
						<ul id="reporte" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
							<li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('#') }}">
                                    <i class="align-middle" data-feather="shopping-bag"></i> Ingresos
                                </a>
                            </li>
							<li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('#') }}">
                                    <i class="align-middle" data-feather="shopping-cart"></i> Egresos
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('#') }}">
                                    <i class="align-middle" data-feather="sliders"></i> Inventario
                                </a>
                            </li>
						</ul>
					</li>
                    @endif


				</ul>
			</div>
		</nav>

        <div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg p-2 px-4">
				<a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

				<div class="navbar-collapse collapse ">
					<ul class="navbar-nav navbar-align">
                        <li class="nav-item align-content-center">
                            <img src="{{ asset('img/usuario/' . $usuario['data']['img']) }}" class="avatar img-fluid rounded-3 me-2">
                        </li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" data-bs-toggle="dropdown">

                                <small class="badge bg-danger rounded-3 fw-semibold" style="font-size: 9px;">{{$usuario['data']['tipo']}}</small>
                                <br>
                                <span class="text-dark" style="font-size: 12px;"><b>{{ $usuario['data']['nombre'] }} {{ $usuario['data']['apellido_p'] }}</b></span>

                            </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="{{ url('perfil') }}"><i class="align-middle me-1" data-feather="user"></i> Perfil</a>
                                @if($usuario['data']['tipo'] != 'CAJERO')
                                <a class="dropdown-item" href="{{ url('usuario') }}"><i class="align-middle me-1" data-feather="users"></i> Usuarios</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('empresa') }}"><i class="align-middle me-1" data-feather="home"></i> Empresa</a>
                                <a class="dropdown-item" href="{{ url('sucursal') }}"><i class="align-middle me-1" data-feather="git-merge"></i> Sucursal</a>
                                @endif
                                <div class="dropdown-divider"></div>
								<a class="dropdown-item text-danger" href="{{ url('cerrar-sesion') }}"><i class="align-middle me-1 text-danger" data-feather="power"></i> Cerrar Sesion</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

                    <div class="row">
						<div class="col-12">
							<div class="card">
								@yield('contenido')
							</div>
						</div>
					</div>

                    @if(View::hasSection('card'))
                        @yield('card')
                    @endif
				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="#" target="_blank"><strong>DigitalDev</strong></a> &copy; 2024
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#" target="_blank">Soporte</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
    </div>


<!-- Modal de Bootstrap -->
<div class="modal fade" id="stockMinimoModal" tabindex="-1" aria-labelledby="stockMinimoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-danger">
                <h3 class="modal-title fs-5 text-white" id="exampleModalLabel">Productos con Stock Mínimo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí se mostrará la tabla con los productos -->
                @if(session('productos'))
                    {!! session('productos') !!} <!-- Imprime la tabla de productos -->
                @endif
            </div>
        </div>
    </div>
</div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/bootstrap-select.js')}}"></script>

    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var currentUrl = window.location.href;
            var sidebarItems = document.querySelectorAll(".sidebar-item a");

            sidebarItems.forEach(function(item) {
                if (item.href === currentUrl) {
                    item.parentElement.classList.add("active");

                    // Encuentra el contenedor del menú padre y expándelo
                    var parentCollapse = item.closest('.collapse');
                    if (parentCollapse) {
                        parentCollapse.classList.add('show');
                        var parentLink = parentCollapse.previousElementSibling;
                        if (parentLink) {
                            parentLink.classList.remove('collapsed');
                            parentLink.setAttribute('aria-expanded', 'true');
                        }
                    }
                }
            });
        });

        $(document).ready(function() {
            @if(session('productos'))
                $('#stockMinimoModal').modal('show'); // Muestra el modal si hay productos con stock mínimo
            @endif

            @if(session('success'))
                Swal.fire({
                    icon: "success",
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif

            let orderDirection = $('#tab').data('order-direction') || 'asc';

            $('#tab').DataTable({
                responsive: true,
                lengthMenu: [5, 10, 50, 100],
                pageLength: 10,
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
                },
                "order": [[0, orderDirection]], // Ordena por la primera columna (índice 0) en orden descendente
                "columnDefs": [
                    {
                        "targets": 'order', // Apunta a la clase 'order' para definir el orden
                        "orderable": true   // Asegura que la columna es ordenable
                    }
                ],
                layout: {
                    bottomEnd: {
                        paging: {
                            firstLast: false
                        }
                    }
                }
            });

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>


    @stack('scripts')
</body>
</html>

