<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POS - Venta</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" href="{{ asset('img/photos/logo_digitaldev.jpg') }}" type="image/x-icon"/>

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

        body {
            background: #d8e4d9;
            font-family: 'Poppins', sans-serif !important;
        }

        .product-card {
            background-color: #ffffffc9;
            border: 1px solid #ffffff;
            padding: 10px;
            border-radius: 8px;
            margin: 10px 0px;
            color: #000;
            font-weight: bold;
            transition: transform 0.3s ease;
            font-size: 11px;
            font-family: 'Poppins', sans-serif !important;
        }

        .product-card:hover {
            border: 1px solid #168500;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-card:focus {
            border: 1px solid #168500;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .precio{
            color: #168500;
            font-weight: bold;
            font-size: 15px;
            font-family: 'Poppins', sans-serif !important;
        }

        .preciored{
            color: #bb0303;
            font-weight: bold;
            font-size: 15px;
            font-family: 'Poppins', sans-serif !important;
        }

        .product{
            background: #d8e4d9;
        }

        .subcat{
            font-size: 15px;
            color: #168500;
            font-family: 'Poppins', sans-serif !important;
        }

        .category-section {
            overflow-y: hidden;
            transition: overflow-y 0.3s ease;

            background: #fff;
            border-radius: 20px 20px 0px 0px;
        }

        .category-section:hover {
            overflow-y: auto;
        }

        .card{
            margin-bottom: 10px !important;
        }

        .card.category-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            background: #f9f9f9;

        }

        .card.category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            padding: 10px;
            background-color: #CCE9D5;
        }

        .title {
            color: #000;
            font-weight: bold;
            font-size: 12px;
            font-family: 'Poppins', sans-serif !important;
        }

        .icon-verde {
            font-size: 12px;
            background-color: #168500;
            font-weight: bold;
            color: #fff;
            padding: 8px 15px;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif !important;
        }

        .cont-cart{
            background: #d8e4d9;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .cart{
            background: #fff;
            border-radius: 10px;
            padding: 10px;
        }

        .cart-prod{
            background: #d8e4d942;
            border-radius: 10px;
            padding: 10px;
        }

        .cant-prod{
            color: #000;
            font-weight: bold;
            font-family: 'Poppins', sans-serif !important;
        }

        .buscar{
            margin-top: 10px;
            border: 1px solid #22c402;
            box-sizing: border-box;
            border-radius: 4px;
            background: #ffffff
        }

        .buscar:focus{
            border-color: #168500;
            outline: none;
        }

        .buscar:hover{
            border-color: #168500;
            outline: none;
        }

        .input-cantidad{
            border: 1px solid #ebf5ec;
            box-sizing: border-box;
            border-radius: 4px;
            background: #ebf5ec
        }

        .input-cantidad:focus{
            border-color: #168500;
            outline: none;
        }


        .input-cantidad:hover{
            border-color: #168500;
            outline: none;
        }

        .btn-orden{
            background: #168500;
            color: #fff;
            font-family: 'Poppins', sans-serif !important;
        }

        .btn-orden:hover{
            color: #fff;
            font-family: 'Poppins', sans-serif !important;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-cliente{
            background: #168500;
            color: #fff;
        }

        .btn-cliente:hover{
            background: #1a9b01;
            color: #fff;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .totalprod{
            background: #ffffffd7;
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #168500;
            box-sizing: border-box;
        }

        .marleft{
            margin-left: 80px;
        }

        .metodopago{
            background: #ffffffd7;
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #b90000;
            box-sizing: border-box;
        }


        @media print {
            body * {
                visibility: hidden;
            }
            #recibo, #recibo * {
                visibility: visible;
            }
            #recibo {
                position: absolute;
                left: 0;
                top: 0;
                width: 58mm; /* Ajusta el ancho según tu impresora térmica */
            }
        }

    </style>
</head>
<body>

    @if($cajas['success'])

    <input type="text" name="monto" value="{{ $cajas['data']['monto'] }}" hidden>
    <input type="text" name="sucursal" value="{{ $cajas['data']['cod_sucursal'] }}" hidden>
    <input type="text" name="caja" value="{{ $cajas['data']['codigo'] }}" hidden>
    <input type="text" name="responsable" value="{{ $cajas['data']['cod_usuario'] }}" hidden>

    <div class="container-fluid vh-100 d-flex flex-column">

        <div class="row flex-grow-1">

            <!-- Product Section -->
            <div class="col-lg-9 col-md-12 h-100 d-flex flex-column product">
                <div class="container-fluid p-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <input type="text" id="buscarProducto" name="buscar" class="form-control buscar" placeholder="Buscar Productos..." style="flex-grow: 1; margin-right: 10px;">
                        <button data-bs-toggle="modal" data-bs-target="#cerrarCaja" class="btn btn-danger" style="margin-top: 10px;">
                            <i class="text-linght" data-feather="log-out"></i> Cerrar Caja
                        </button>

                        <!--Modal Cerrar Caja-->
                        <div class="modal fade" id="cerrarCaja" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h3 class="modal-title fs-5 text-white">Cerrar/Arqueo de Caja</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12 col-xs-12">
                                                        <div class="table-responsive">
                                                            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                                                                <thead class="bg-primary" style="font-size: 12px;">
                                                                    <tr class="text-white">
                                                                        <th hidden>Codigo</th>
                                                                        <th>Denominacion (Bs.)</th>
                                                                        <th>Cantidad</th>
                                                                        <th>Subtotal (Bs.)</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody style="font-size: 11px;">
                                                                    @foreach($billetes['data'] as $billete)
                                                                    <tr>
                                                                        <td hidden>{{ $billete['codigo']}}</td>
                                                                        <td>{{ $billete['descripcion']}}</td>
                                                                        <td>
                                                                            <input type="number" class="form-control form-control-sm cantidad-input" min="0" data-denominacion="{{ $billete['descripcion'] }}" value="0" required>
                                                                        </td>
                                                                        <td class="subtotal">0</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot style="font-size: 12px; background: #a2c0eb">
                                                                    <tr>
                                                                        <td colspan="2" class="text-end text-dark"><span style="font-size: 15px"><b>Total a Cancelar</b></span></td>
                                                                        <td id="totalContado" class="text-dark"><span style="font-size: 15px"><b>0.00</b></span></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Cantidad en Tarjetas (Bs.)</label>
                                                            <input type="number" name="tarjeta" class="form-control form-control-sm" min="0" value="0" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Cantidad en Qr (Bs.)</label>
                                                            <input type="number" name="qr" class="form-control form-control-sm" min="0" value="0" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Observaciones</label>
                                                            <textarea name="observacion" class="form-control form-control-sm" rows="2" placeholder="Ingrese sus observaciones aquí"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                            <button id="ArqueoCaja" class="btn btn-danger btn-sm">Cerrar Caja</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <span class="subcat mt-3"><b>Productos</b></span>

                <div class="p-2">
                    <!-- Sección de productos que ocupa el 75% de la altura -->
                    <div class="row flex-grow-1 sect-prod" style="overflow-y: auto; height: 330px;">

                        @foreach ($productos['data'] as $producto)
                        <!-- Repite este bloque para cada producto -->
                        <div class="col-sm-6 col-md-4 col-lg-2">
                            <div class="product-card">
                                <img src="{{ asset('img/productos/' . $producto['img']) }}" alt="img-p" class="img-fluid rounded-3 mb-2">
                                <span>{{ $producto['producto'] }}</span><br>
                                <span class="precio">{{ $producto['precio'] }} Bs.</span>
                                <input type="text" name="cod_prod" value="{{ $producto['cod_prod'] }}" hidden>
                            </div>
                        </div>
                        <!-- Fin del bloque de producto -->
                        @endforeach
                    </div>
                </div>


                <!-- Sección de categorías que ocupa el 25% de la altura con scroll -->
                <div class="row pt-3 px-3 category-section flex-grow-1 " style="height: 180px;">
                    <span class="subcat"><b>Seleccionar Categoria</b></span>
                    @foreach ($categorias['data'] as $categoria)
                    <div class="col-sm-6 col-md-4 col-lg-3 pt-1" style="padding: 0px 5px;">
                        <div class="card category-card" onclick="filtrarProductos({{ json_encode($categoria['productos']) }})">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span class="title">{{ $categoria['descripcion'] }}</span>
                                <span class="icon-verde">{{ $categoria['total_p'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>

            <div class="col-lg-3 col-md-12 cont-cart">
                <div class=" d-flex flex-column h-100 cart">
                    <div class="p-1 bg-primary text-white text-center">
                        {{ $cajas['data']['sucursal'] }}
                    </div>
                    <div class="p-1 flex-grow-1">

                        <div class="d-flex align-items-center justify-content-between">

                            <select name="clienteAg" class="selectpicker show-tick form-control form-control-sm" data-live-search="true" required>
                                <option value="1" selected>S/N</option>
                                @foreach ($clientes['data'] as $cliente)
                                <option value="{{ $cliente['codigo'] }}">{{ $cliente['nombre'] }}</option>
                                @endforeach
                            </select>

                            <button data-bs-toggle="modal" data-bs-target="#nuevoCliente" class="btn btn-sm btn-cliente">
                                <i class="text-linght" data-feather="user-plus"></i>
                            </button>

                            <!--Modal Nuevo-->
                            <div class="modal fade" id="nuevoCliente" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-success">
                                            <h3 class="modal-title fs-5 text-white" id="exampleModalLabel">Agregar Cliente</h3>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-8 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Nombre</label>
                                                            <input type="text" name="nombreC" class="form-control form-control-sm" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Telefono</label>
                                                            <input type="number" name="telefonoC" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                            <button id="AgregarNuevoCliente" class="btn btn-success btn-sm">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 mt-2 cart-prod" style="overflow-y: auto; height: 230px">

                        </div>
                        <div class="col-lg-12 col-md-12 mt-2 totalprod" style="height: 85px">
                            <span class="ml-3"><b>Total a pagar: </b></span>
                            <span id="totalPagar" class="ml-5 preciored"><b>0.00 Bs.</b></span><br>

                            <span class="ml-3"><b>Monto Pagado: </b></span>
                            <input type="number" id="montoPagado" class="input-cantidad" step="0.01" min="1" style="width: 60px; margin-left: 35px;"><br>

                            <span class="ml-3 precio"><b id="labelCambio">Cambio:</b></span>
                            <span id="montoCambio" class="precio" style="margin-left: 80px;"><b>0.00 Bs.</b></span>
                        </div>

                        <div class="col-lg-12 col-md-12 mt-1 p-1 metodopago" style="height: 125px">
                            <small><b>Metodo de Pago:</b></small>
                                <center>
                                    <div class="radio-img">
                                            <input type="radio" id="efectivo" name="tipo" value="1" checked required>
                                            <label for="efectivo">
                                                <img src="{{asset('img/icons/dinero.png')}}" alt="Option 1" class="img-pos">
                                            </label>
                                            <span class="badge bg-success rounded-3 fw-semibold pt-1" style="font-size: 9px;">Efectivo</span>
                                    </div>
                                    <div class="radio-img">
                                            <input type="radio" id="tarjeta" name="tipo" value="2">
                                            <label for="tarjeta">
                                                <img src="{{asset('img/icons/tarjeta.png')}}" alt="Option 2" class="img-pos">
                                            </label>
                                            <span class="badge bg-success rounded-3 fw-semibold pt-1" style="font-size: 9px;">Tarjeta</span>
                                    </div>
                                    <div class="radio-img">
                                        <input type="radio" id="qr" name="tipo" value="3">
                                        <label for="qr">
                                            <img src="{{asset('img/icons/qr.png')}}" alt="Option 3" class="img-pos">
                                        </label>
                                        <span class="badge bg-success rounded-3 fw-semibold pt-1" style="font-size: 9px;">QR</span>
                                    </div>
                                </center>

                        </div>
                    </div>

                    <div class="p-1">
                        <button id="realizarOrdenBtn" class="btn btn-block btn-orden">Realizar Orden</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="recibo" style="display: none; width: 58mm;">

        <center>
            <img src="{{asset('img/empresa/' . $empresas['data']['img']) }}" alt="Empresa" class="img-pos"><br><br>
            <h4>{{ $empresas['data']['nombre'] }}</h4>
            <span><b>Direccion: {{ $empresas['data']['direccion'] }}</b></span><br>
            <span><b>Teléfono: {{ $empresas['data']['telefono'] }}</b></span><br>
        </center>
        <br>
        <span>Fecha: <b><span id="fechaRecibo"></span> </b></span><br>
        <span>Nombre: <b><span id="nombreRecibo"></span> </b></span><br>
        <br>
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                <thead class="bg-secondary" style="font-size: 9px;">
                    <tr class="text-dark">
                        <th>Producto</th>
                        <th>Cant.</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="recibo-detalle" style="font-size: 8px;">
                    <!-- Aquí se llenarán los detalles de la venta -->
                </tbody>
            </table>
        </div>
        <span>Total: <b><span id="recibo-total"></span> Bs.</b></span><br>
        <span>Monto Pagado: <b><span id="recibo-pagado"></span> Bs.</b></span><br>
        <span>Cambio: <b><span id="recibo-vuelto"></span> Bs.</b></span>
        <hr>
        <center>
            <span><b>{{ $empresas['data']['slogan'] }}</b></span><br><br>
            <span><b>Lo Atendio: {{ $cajas['data']['usuario'] }}</b></span><br>
            <span><b>Gracias por su compra!</b></span>
        </center>
    </div>

    @else

    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-xs-12">
                </div>
                <div class="col-lg-4 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="container-fluid p-0">
                                <center><h3 class="d-inline align-middle">Aperturar caja</h3></center>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('guardar_caja') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Sucursal</label>
                                        <select name="sucursal" class="selectpicker show-tickker form-control form-control-sm" data-live-search="true" required>
                                            <option value="" disabled selected>Seleccionar...</option>
                                            @foreach ($sucursales['data'] as $sucursal)
                                            <option value="{{ $sucursal['codigo'] }}">{{ $sucursal['nombre'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">
                                    <label for="form-label">Monto Bs.</label>
                                    <input type="number" name="monto" class="form-control form-control-sm" step="0.01" min="0" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success btn-sm">Aperturar Caja</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12">
                </div>
            </div>
        </div>
    </main>

    @endif


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
        });
    </script>

    <script>

        $('#AgregarNuevoCliente').on('click', function (e) {
            e.preventDefault(); // Evita el comportamiento por defecto del botón

            // Obtener los valores de los campos del formulario
            let nombreC = $('input[name="nombreC"]').val();
            let telefonoC = $('input[name="telefonoC"]').val();

            // Validación rápida (opcional)
            if (nombreC === '') {
                Swal.fire({
                    icon: "error",
                    title: "El Nombre es obligatorio",
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            }

            // Enviar la solicitud AJAX
            $.ajax({
                url: 'http://localhost/inv_backend/controlador/ingreso/nuevo_cliente_pos.php', // URL a la que se enviará la solicitud
                type: 'POST',
                data: JSON.stringify({
                    _token: '{{ csrf_token() }}', // Añadir el token CSRF si estás en Laravel
                    nombre: nombreC,
                    telefono: telefonoC
                }),
                success: function (response) {
                    // Manejar la respuesta del servidor aquí
                    if (response.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Cliente agregado exitosamente.",
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {

                            $('#nuevoCliente').modal('hide'); // Cerrar el modal

                        });

                        // Crear una nueva opción y marcarla como seleccionada
                        let newOption = new Option(response.data.nombre, response.data.codigo, false, true); // El cuarto parámetro true establece la opción como seleccionada
                        let selectCliente = $('select[name="clienteAg"]');
                        selectCliente.append(newOption);

                        // Refrescar el selectpicker para que se vea el nuevo cliente (si estás utilizando selectpicker)
                        if ($('.selectpicker').length) {
                            $('.selectpicker').selectpicker('refresh');
                        }

                        // Seleccionar la nueva opción usando selectpicker
                        selectCliente.selectpicker('val', response.data.codigo);


                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Hubo un problema al agregar el cliente.",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                },
                error: function (xhr, status, error) {
                    // Manejar errores aquí
                    console.error('Error al enviar la solicitud AJAX:', error);
                    Swal.fire({
                        icon: "error",
                        title: "Error en la solicitud.",
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        });

        let todosLosProductos = @json($productos['data']); // Aquí guardas todos los productos

        function filtrarProductos(productos) {
            let seccionProductos = document.querySelector('.sect-prod');
            seccionProductos.innerHTML = '';

            productos.forEach(producto => {
                let productoHTML = `
                    <div class="col-sm-6 col-md-4 col-lg-2">
                        <div class="product-card">
                            <img src="{{ asset('img/productos/${producto.img}') }}" alt="img-p" class="img-fluid rounded-3 mb-2">
                            <span>${producto.producto}</span><br>
                            <span class="precio">${producto.precio} Bs.</span>
                            <input type="text" name="cod_prod" value="${producto.cod_prod}" hidden>
                        </div>
                    </div>
                `;
                seccionProductos.innerHTML += productoHTML;
            });

            // Reasignar los eventos a los productos filtrados
            asignarEventosAProductos();
        }

        document.getElementById('buscarProducto').addEventListener('input', function() {
            let query = this.value.toLowerCase();
            filtrarProductosPorNombre(query);
        });

        function filtrarProductosPorNombre(query) {
            let productosFiltrados = todosLosProductos.filter(function(producto) {
                return producto.producto.toLowerCase().includes(query);
            });
            filtrarProductos(productosFiltrados);
        }

        function filtrarProductosPorCategoria(productos) {
            todosLosProductos = productos;  // Actualiza los productos filtrados por categoría
            filtrarProductos(todosLosProductos);
        }

        function asignarEventosAProductos() {
            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('click', function() {
                    const imgSrc = this.querySelector('img').getAttribute('src');
                    const nombreProducto = this.querySelector('span').textContent;
                    const precioProducto = parseFloat(this.querySelector('.precio').textContent.replace(' Bs.', ''));
                    const codProd = this.querySelector('input[name="cod_prod"]').value;

                    // Llamar a la función para agregar el producto al carrito
                    agregarProductoAlCarrito(codProd, imgSrc, nombreProducto, precioProducto);
                });
            });
        }

        // Función para agregar o actualizar un producto en el carrito
        function agregarProductoAlCarrito(codProd, imgSrc, nombreProducto, precioProducto) {
            let productoEnCarrito = document.querySelector(`.cart-prod .producto[data-nombre="${nombreProducto}"]`);
            if (productoEnCarrito) {
                let inputCantidad = productoEnCarrito.querySelector('.input-cantidad');
                let nuevaCantidad = parseInt(inputCantidad.value) + 1;
                inputCantidad.value = nuevaCantidad;

                let precioTotal = nuevaCantidad * precioProducto;
                productoEnCarrito.querySelector('.precio').textContent = precioTotal.toFixed(2);
            } else {
                let productoHTML = `
                    <div class="card p-2 producto" data-nombre="${nombreProducto}">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="text" name="cod_prod" value="${codProd}" hidden>
                                <img src="${imgSrc}" alt="prodc" class="img-fluid rounded-3" width="40" height="40">
                                <div class="ms-1">
                                    <span><b>${nombreProducto}</b></span><br>
                                    <input type="number" class="input-cantidad" value="1" min="1" style="width: 40px;">
                                    <span class="precio">${precioProducto.toFixed(2)}</span> Bs.
                                </div>
                            </div>
                            <span>
                                <a class="eliminarProducto">
                                    <i class="align-middle text-danger" data-feather="trash-2"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                `;
                document.querySelector('.cart-prod').insertAdjacentHTML('beforeend', productoHTML);

                let nuevoProducto = document.querySelector(`.cart-prod .producto[data-nombre="${nombreProducto}"]`);
                let inputCantidad = nuevoProducto.querySelector('.input-cantidad');
                inputCantidad.addEventListener('input', function() {
                    let cantidad = parseInt(this.value);
                    if (cantidad < 1) {
                        this.value = 1;
                        cantidad = 1;
                    }
                    let precioTotal = cantidad * precioProducto;
                    this.closest('.producto').querySelector('.precio').textContent = precioTotal.toFixed(2);
                    actualizarTotalCarrito();  // Actualizar total cuando cambia la cantidad
                });

                nuevoProducto.querySelector('.eliminarProducto').addEventListener('click', function() {
                    nuevoProducto.remove();
                    actualizarTotalCarrito();  // Actualizar total cuando se elimina un producto
                });
            }

            actualizarTotalCarrito();  // Actualizar total cuando se agrega un nuevo producto
            feather.replace();
        }

        // Asignar evento click a cada tarjeta de producto
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', function() {
                const imgSrc = this.querySelector('img').getAttribute('src');
                const nombreProducto = this.querySelector('span').textContent;
                const precioProducto = parseFloat(this.querySelector('.precio').textContent.replace(' Bs.', ''));
                const codProd = this.querySelector('input[name="cod_prod"]').value;

                // Llamar a la función para agregar el producto al carrito
                agregarProductoAlCarrito(codProd, imgSrc, nombreProducto, precioProducto);
            });
        });

        function actualizarTotalCarrito() {
            let total = 0;
            document.querySelectorAll('.cart-prod .producto').forEach(function(producto) {
                let precioProducto = parseFloat(producto.querySelector('.precio').textContent);
                total += precioProducto;
            });

            // Solo actualiza el total a pagar
            document.getElementById('totalPagar').textContent = total.toFixed(2) + ' Bs.';

            // Calcula el cambio en función del monto pagado
            calcularCambio(total);
        }

        function calcularCambio(total) {
            let montoPagado = parseFloat(document.getElementById('montoPagado').value);
            let cambio = 0;
            let mensaje = '';
            let color = '';

            if (!isNaN(montoPagado)) {
                if (montoPagado >= total) {
                    cambio = montoPagado - total;
                    mensaje = 'Cambio: ';
                    color = 'precio'; // Verde para cambio
                    document.getElementById('labelCambio').textContent = mensaje;
                } else {
                    cambio = total - montoPagado;
                    mensaje = 'Faltante: ';
                    color = 'preciored'; // Rojo para faltante
                    document.getElementById('labelCambio').textContent = mensaje;
                }

                document.getElementById('montoCambio').textContent = cambio.toFixed(2) + ' Bs.';
                document.getElementById('montoCambio').className = 'marleft ' + color;
                document.getElementById('labelCambio').className = color;
            } else {
                document.getElementById('montoCambio').textContent = '';
                document.getElementById('montoCambio').className = 'marleft';
                document.getElementById('labelCambio').textContent = 'Cambio:';

            }
        }

        // Escucha el evento de cambio en el input de monto pagado para recalcular el cambio
        document.getElementById('montoPagado').addEventListener('input', function() {
            let total = parseFloat(document.querySelector('.totalprod .preciored').textContent);
            calcularCambio(total);
        });


        function generarRecibo(carrito, totalVenta, montoPagado) {
            let reciboDetalle = document.getElementById('recibo-detalle');
            reciboDetalle.innerHTML = ''; // Limpiar contenido previo

            carrito.forEach(function(producto) {
                let row = document.createElement('tr');
                row.innerHTML = `
                    <td>${producto.producto}</td>
                    <td>${producto.cantidad}</td>
                    <td>${producto.precio.toFixed(2)}</td>
                    <td>${(producto.cantidad * producto.precio).toFixed(2)}</td>
                `;
                reciboDetalle.appendChild(row);
            });

            // Set total, pagado y vuelto
            document.getElementById('recibo-total').textContent = totalVenta.toFixed(2);
            document.getElementById('recibo-pagado').textContent = montoPagado.toFixed(2);
            document.getElementById('recibo-vuelto').textContent = (montoPagado - totalVenta).toFixed(2);

            // Obtener la fecha actual
            let fechaActual = new Date();
            let fechaFormateada = fechaActual.toLocaleDateString('es-ES', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
            document.getElementById('fechaRecibo').textContent = fechaFormateada;

            // Obtener el nombre del cliente seleccionado
            let selectCliente = document.querySelector('select[name="clienteAg"]');
            let clienteSeleccionado = selectCliente.options[selectCliente.selectedIndex].text;
            document.getElementById('nombreRecibo').textContent = clienteSeleccionado;
        }


        //Realizar Orden
        document.getElementById('realizarOrdenBtn').addEventListener('click', function() {

            // Obtener datos del carrito
            let carrito = [];
            document.querySelectorAll('.cart-prod .producto').forEach(function(producto) {
                let codProd = producto.querySelector('input[name="cod_prod"]').value;
                let nombreProducto = producto.querySelector('span').textContent;
                let cantidad = parseInt(producto.querySelector('.input-cantidad').value);
                let precioProducto = parseFloat(producto.querySelector('.precio').textContent.replace(' Bs.', '').trim());

                if (codProd && cantidad > 0 && precioProducto) {
                    carrito.push({ cod_prod: codProd, cantidad: cantidad, precio: precioProducto, producto: nombreProducto });
                }
            });

            // Obtener otros datos
            let monto = $('input[name="monto"]').val();
            let cliente = $('select[name="clienteAg"]').val();
            let sucursal = $('input[name="sucursal"]').val();
            let caja = $('input[name="caja"]').val();
            let responsable = $('input[name="responsable"]').val();
            let montoPagado = parseFloat($('#montoPagado').val());
            let tipo = $('input[name="tipo"]:checked').val();
            let totalPagar = parseFloat($('#totalPagar').text().replace(' Bs.', '').trim());

            // Validaciones
            if (carrito.length === 0) {
                Swal.fire({
                    icon: "error",
                    title: "El carrito está vacío.",
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            }
            if (isNaN(montoPagado) || montoPagado < totalPagar) {
                Swal.fire({
                    icon: "error",
                    title: "Monto pagado es insuficiente.",
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            }

            Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Estás a punto de procesar y terminar la Orden. ¿Deseas continuar?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, Realizar Orden',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Enviar petición AJAX
                        $.ajax({
                            url: 'http://localhost/inv_backend/controlador/ingreso/agregar_venta.php', // Cambia esta URL a la de tu endpoint
                            type: 'POST',
                            data: JSON.stringify({
                                _token: '{{ csrf_token() }}', // Añadir el token CSRF si estás en Laravel
                                productos: carrito,
                                cliente: cliente,
                                sucursal: sucursal,
                                caja: caja,
                                totalVenta: totalPagar,
                                montoPagado: montoPagado,
                                tipo: tipo
                            }),
                            contentType: 'application/json; charset=utf-8',
                            dataType: 'json',
                            success: function (response) {
                                // Manejar la respuesta aquí
                                if(response.success){

                                    // Generar el contenido del recibo
                                    generarRecibo(carrito, totalPagar, montoPagado);

                                    // Mostrar el recibo y enviar a impresión
                                    document.getElementById('recibo').style.display = 'block';

                                    Swal.fire({
                                        icon: "success",
                                        title: "Orden realizada con éxito.",
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(() => {
                                        window.print(); // Imprimir el recibo

                                        // Ocultar el recibo después de la impresión
                                        document.getElementById('recibo').style.display = 'none';

                                        // Recargar la página después de mostrar el mensaje de éxito
                                        window.location.href = "{{ url('pos') }}";
                                    });
                                }else{
                                    Swal.fire({
                                        icon: "error",
                                        title: "Hubo un error al realizar la orden.",
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                }

                            },
                            error: function (response) {
                                // Manejar el error aquí
                                Swal.fire({
                                    icon: "error",
                                    title: "Error en la solicitud.",
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        });
                }
            });
        });
    </script>

    <script>
        function actualizarTotal() {
            let total = 0;

            // Recorre todas las filas para sumar los subtotales
            document.querySelectorAll('.subtotal').forEach(function(subtotalTd) {
                let subtotal = parseFloat(subtotalTd.textContent) || 0;
                total += subtotal;
            });

            // Actualiza el total en el tfoot
            document.getElementById('totalContado').innerHTML = '<b style="font-size: 15px">' + total.toFixed(2) + '</b>';
        }

        document.querySelectorAll('.cantidad-input').forEach(function(input) {
            input.addEventListener('input', function() {
                // Obtener la denominación y la cantidad ingresada
                let denominacion = parseFloat(this.getAttribute('data-denominacion'));
                let cantidad = parseFloat(this.value);

                // Calcular el subtotal
                let subtotal = denominacion * cantidad;

                // Actualizar el campo de subtotal
                let subtotalTd = this.closest('tr').querySelector('.subtotal');
                subtotalTd.textContent = subtotal.toFixed(2);

                // Actualizar el total
                actualizarTotal();
            });
        });

        document.getElementById('ArqueoCaja').addEventListener('click', function() {
                event.preventDefault(); // Evita el envío normal del formulario

                // Capturar los valores de los inputs ocultos
                const monto = document.querySelector('input[name="monto"]').value;
                const caja = document.querySelector('input[name="caja"]').value;

                // Capturar los datos de la tabla
                const tabla = document.querySelectorAll('#tab tbody tr');
                const billetes = [];

                tabla.forEach(row => {
                    const denominacion = row.querySelector('td:nth-child(2)').innerText;
                    const cantidad = row.querySelector('input.cantidad-input').value;
                    const subtotal = row.querySelector('.subtotal').innerText;

                    billetes.push({
                        denominacion: denominacion,
                        cantidad: cantidad,
                        subtotal: subtotal
                    });
                });

                // Capturar el total de contado
                const totalContado = document.querySelector('#totalContado').innerText;

                // Capturar los valores de las tarjetas y QR
                const totalTarjeta = document.querySelector('input[name="tarjeta"]').value;
                const totalQr = document.querySelector('input[name="qr"]').value;

                // Capturar la observación
                const observacion = document.querySelector('textarea[name="observacion"]').value;

                // Crear el cuerpo de la solicitud
                const datos = {
                    _token: '{{ csrf_token() }}',
                    monto: monto,
                    caja: caja,
                    billetes: billetes,
                    total_contado: totalContado,
                    total_tarjeta: totalTarjeta,
                    total_qr: totalQr,
                    observacion: observacion
                };

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Estás a punto de realizar el cierre y arqueo de caja. ¿Deseas continuar?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, cerrar caja',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        // Realizar la petición fetch
                        $.ajax({
                            url:'http://localhost/inv_backend/controlador/ingreso/cierre_caja.php',
                            method: 'POST',
                            data: JSON.stringify(datos),
                            contentType: 'application/json; charset=utf-8',
                            dataType: 'json',
                            success: function (response) {
                                // Manejar la respuesta aquí
                                if(response.success){
                                    Swal.fire({
                                        icon: "success",
                                        title: "Caja Cerrada y Arqueo Realizado con Exito.",
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(() => {
                                        // Recargar la página después de mostrar el mensaje de éxito
                                        window.location.href = "{{ url('dashboard') }}";
                                    });
                                }else{
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error al cerrar la caja",
                                        text: result.message,
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                }
                            },
                            error: function (response) {
                                // Manejar el error aquí
                                Swal.fire({
                                    icon: "error",
                                    title: "Error en la solicitud",
                                    text: "Ocurrió un error al enviar los datos",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        });
                    }
                });
            });

    </script>
</body>
</html>
