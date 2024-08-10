<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Dashboard</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" href="{{ asset('img/icons/entradadoc.png') }}" type="image/x-icon"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}">

    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap.css">

    <link href="{{asset('css/radiobutton.css')}}" rel="stylesheet">

    <style>
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
    </style>
</head>
<body>

    <?php $usuario = session('usuario_logueado'); ?>

    <div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{ url('dashboard') }}">
                    <span class="align-middle">AdminKit</span>
                </a>

				<ul class="sidebar-nav">

                    <li class="sidebar-item">
						<a class="sidebar-link" href="#">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Usuario</span>
                        </a>
					</li>

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
                                <a class="sidebar-link sub-pag" href="{{ url('sucursal') }}">
                                    <i class="align-middle" data-feather="home"></i> Sucursal
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('stock') }}">
                                    <i class="align-middle" data-feather="list"></i> Stock
                                </a>
                            </li>
							<li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="{{ url('movimiento_stock') }}">
                                    <i class="align-middle" data-feather="truck"></i> Movimiento
                                </a>
                            </li>
						</ul>
					</li>



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
                                <a class="sidebar-link sub-pag" href="#">
                                    <i class="align-middle" data-feather="users"></i> Cliente
                                </a>
                            </li>
							<li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="#">
                                    <i class="align-middle" data-feather="grid"></i> POS
                                </a>
                            </li>
						</ul>
					</li>

                    <li class="sidebar-header">
						Egresos
					</li>

                    <li class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-up.html">
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
                                <a class="sidebar-link sub-pag" href="#">
                                    <i class="align-middle" data-feather="users"></i> Proveedor
                                </a>
                            </li>
							<li class="sidebar-item">
                                <a class="sidebar-link sub-pag" href="#">
                                    <i class="align-middle" data-feather="shopping-bag"></i> Orden Compra
                                </a>
                            </li>
						</ul>
					</li>





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
                            <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded-3 me-2" />
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
								<a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Perfil</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ url('cerrar-sesion') }}">Cerrar Sesion</a>
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

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
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

            $('#tab').DataTable({
                responsive: true,
                lengthMenu: [5, 10, 50, 100],
                pageLength: 10,
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
                },
                layout: {
                    bottomEnd: {
                        paging: {
                            firstLast: false
                        }
                    }
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>

