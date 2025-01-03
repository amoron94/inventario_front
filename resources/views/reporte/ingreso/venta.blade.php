@extends('dashboard')
@section('contenido')
    <?php $usuario = session('usuario_logueado'); ?>

    <input type="text" name="cod_empresa" value="{{ $usuario['data']['cod_empresa'] }}" hidden>

    <div class="card-header">
        <div class="container-fluid p-0">
            <label for="form-label" class="mr-3"><b>Rango de Fechas:</b></label>
            <input name="daterange" class="form-control d-inline align-middle fec">
        </div>
        <div class="row mt-3">
            <div class="col d-flex align-items-center">
                <label for="form-label" class="mr-3"><b>Seleccione su reporte:</b></label>
                <select name="buscar" class="form-select mr-5 sel">
                    <option value="1">Detalle Ventas</option>
                    <option value="2">Ventas Eliminadas</option>
                    <option value="3">Producto mas Vendidos</option>
                    <option value="4">Ventas por Productos</option>
                    <option value="7">Ventas por Categoria de Productos</option>
                    <option value="5">Ventas por Sucursal</option>
                    <option value="9">Ventas por Usuario (Cajero)</option>
                    <option value="6">Cuadre de Cajas</option>
                    <option value="8">Clientes Eliminados</option>
                </select>
                <button id="buscar" class="btn btn-success btn-color">Buscar</button>
            </div>
        </div>

        <div class="row mt-4 filtros">
            <div class="col d-flex align-items-center">
                <div class="form-group mr-5">
                    <label for="form-label"><b>Sucursal</b></label>
                    <select name="sucursal" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todas las sucursales</option>
                        @foreach ($sucursales['data'] as $sucursal)
                        <option value="{{ $sucursal['codigo'] }}">{{ $sucursal['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-5">
                    <label for="form-label"><b>Cliente</b></label>
                    <select name="cliente" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todos los clientes</option>
                        @foreach ($clientes['data'] as $cliente)
                        <option value="{{ $cliente['codigo'] }}">{{ $cliente['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-5">
                    <label for="form-label"><b>Metodo de Pago</b></label>
                    <select name="pago" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todos los Metodos</option>
                        <option value="1" >Efectivo</option>
                        <option value="2" >Tarjeta</option>
                        <option value="3" >Qr</option>
                    </select>
                </div>
                <div class="form-group mr-5">
                    <label for="form-label"><b>Productos</b></label>
                    <select name="producto" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todos los Productos</option>
                        @foreach ($productos['data'] as $productos)
                        <option value="{{ $productos['codigo'] }}">{{ $productos['descripcion'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-5">
                    <label for="form-label"><b>Categorias</b></label>
                    <select name="categoria" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todas los Caterias</option>
                        @foreach ($categorias['data'] as $categorias)
                        <option value="{{ $categorias['codigo'] }}">{{ $categorias['descripcion'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-5">
                    <label for="form-label"><b>Usuarios</b></label>
                    <select name="usuario" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todas los Usuarios</option>
                        @foreach ($usuarios['data'] as $usuarios)
                        <option value="{{ $usuarios['codigo'] }}">{{ $usuarios['nombre'] }} {{ $usuarios['apellido_p'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div id="tablaResultados">
        </div>
    </div>

@push('scripts')
    <script>

        $(document).ready(function () {
            $('select[name="producto"]').closest('.form-group').hide();
            $('select[name="categoria"]').closest('.form-group').hide();
            $('select[name="usuario"]').closest('.form-group').hide();
            // Capturar el evento de cambio en el select "buscar"
            $('select[name="buscar"]').on('change', function () {
                let selectedValue = $(this).val();

                // Ocultar o mostrar los campos según el valor seleccionado
                switch (selectedValue) {
                    case '1':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="cliente"]').closest('.form-group').show();
                        $('select[name="pago"]').closest('.form-group').show();
                        $('select[name="producto"]').closest('.form-group').hide();
                        $('select[name="categoria"]').closest('.form-group').hide();
                        $('select[name="usuario"]').closest('.form-group').hide();
                        break;
                    case '2':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="cliente"]').closest('.form-group').show();
                        $('select[name="pago"]').closest('.form-group').show();
                        $('select[name="producto"]').closest('.form-group').hide();
                        $('select[name="categoria"]').closest('.form-group').hide();
                        $('select[name="usuario"]').closest('.form-group').hide();
                        break;
                    case '3':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="cliente"]').closest('.form-group').hide();
                        $('select[name="pago"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').hide();
                        $('select[name="categoria"]').closest('.form-group').hide();
                        $('select[name="usuario"]').closest('.form-group').hide();
                        break;
                    case '4':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="cliente"]').closest('.form-group').hide();
                        $('select[name="pago"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').show();
                        $('select[name="categoria"]').closest('.form-group').hide();
                        $('select[name="usuario"]').closest('.form-group').hide();
                        break;
                    case '5':
                        $('select[name="sucursal"]').closest('.form-group').hide();
                        $('select[name="cliente"]').closest('.form-group').hide();
                        $('select[name="pago"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').hide();
                        $('select[name="categoria"]').closest('.form-group').hide();
                        $('select[name="usuario"]').closest('.form-group').hide();
                        break;
                    case '6':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="cliente"]').closest('.form-group').hide();
                        $('select[name="pago"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').hide();
                        $('select[name="categoria"]').closest('.form-group').hide();
                        $('select[name="usuario"]').closest('.form-group').hide();
                        break;
                    case '7':
                        $('select[name="cliente"]').closest('.form-group').hide();
                        $('select[name="pago"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').hide();
                        $('select[name="categoria"]').closest('.form-group').show();
                        $('select[name="usuario"]').closest('.form-group').hide();
                        break;
                    case '8':
                        $('select[name="sucursal"]').closest('.form-group').hide();
                        $('select[name="cliente"]').closest('.form-group').hide();
                        $('select[name="pago"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').hide();
                        $('select[name="categoria"]').closest('.form-group').hide();
                        $('select[name="usuario"]').closest('.form-group').hide();
                        break;
                    case '9':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="cliente"]').closest('.form-group').hide();
                        $('select[name="pago"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').hide();
                        $('select[name="categoria"]').closest('.form-group').hide();
                        $('select[name="usuario"]').closest('.form-group').show();
                        break;
                }


            });
        });


        // Obtener el año actual y la fecha actual
        let inicio = moment().year() + '-01-01'; // Fecha inicial predeterminada: 1 de enero del año actual
        let fin = moment().format('YYYY-MM-DD'); // Fecha final predeterminada: Fecha actual

        $('input[name="daterange"]').daterangepicker({
            opens: 'center',
            startDate: moment(inicio, 'YYYY-MM-DD'), // Usa la fecha inicial predeterminada
            endDate: moment(fin, 'YYYY-MM-DD'), // Usa la fecha final predeterminada
            locale: {
                format: 'DD/MM/YYYY',  // Formato de fecha
                separator: " - ",  // Separador entre las fechas en el rango
                applyLabel: "Aplicar",  // Texto del botón de aplicar
                cancelLabel: "Cancelar",  // Texto del botón de cancelar
                fromLabel: "Desde",  // Texto "Desde" en el panel
                toLabel: "Hasta",  // Texto "Hasta" en el panel
                customRangeLabel: "Personalizado",  // Texto para el rango personalizado
                weekLabel: "Sem",  // Etiqueta para las semanas
                daysOfWeek: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],  // Días de la semana
                monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],  // Meses
                firstDay: 1  // Establecer Lunes como el primer día de la semana
            }
        }, function(start, end, label) {
            inicio = start.format('YYYY-MM-DD');
            fin = end.format('YYYY-MM-DD');
            console.log("Fechas seleccionadas: " + inicio + " a " + fin);
        });


        // Pasar la URL base desde Blade a JavaScript
        let baseUrl = "{{ $baseUrl }}";

        document.getElementById('buscar').addEventListener('click', function() {

            let buscar = $('select[name="buscar"]').val();

            let cod_empresa = $('input[name="cod_empresa"]').val();
            let sucursal = $('select[name="sucursal"]').val();
            let cliente = $('select[name="cliente"]').val();
            let tipo_pago = $('select[name="pago"]').val();
            let producto = $('select[name="producto"]').val();
            let categoria = $('select[name="categoria"]').val();
            let usuario = $('select[name="usuario"]').val();
            let activo = 1;

            switch (buscar) {
                case '1':
                    ventas(baseUrl, inicio, fin, cod_empresa, sucursal, cliente, tipo_pago, activo);
                    break;
                case '2':
                    activo = 0;
                    ventas(baseUrl, inicio, fin, cod_empresa, sucursal, cliente, tipo_pago, activo);
                    break;
                case '3':
                    producto = '';
                    producto_vendido(baseUrl, inicio, fin, cod_empresa, sucursal, producto);
                    break;
                case '4':
                    producto_vendido(baseUrl, inicio, fin, cod_empresa, sucursal, producto);
                    break;
                case '5':
                    ventas_sucursal(baseUrl, inicio, fin, cod_empresa);
                    break;
                case '6':
                    cierre_caja(baseUrl, inicio, fin, cod_empresa, sucursal);
                    break;
                case '7':
                    categoria_vendido(baseUrl, inicio, fin, cod_empresa, sucursal, categoria);
                    break;
                case '8':
                    cliente_eliminado(baseUrl, inicio, fin, cod_empresa);
                    break;
                case '9':
                    ventas_usuario(baseUrl, inicio, fin, cod_empresa, sucursal, usuario);
                    break;
                default:
                    console.warn("Opción no válida");
                    break;
            }

        });

    </script>


    <script>
        //Detale de venta
        function ventas(baseUrl, inicio, fin, cod_empresa, sucursal, cliente, tipo_pago, activo){
            // Enviar los datos mediante AJAX
            fetch(`${baseUrl}reporte/ventas.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir token CSRF para seguridad
                },
                body: JSON.stringify({
                    inicio: inicio,
                    fin: fin,
                    sucursal: sucursal,
                    cliente: cliente,
                    tipo_pago: tipo_pago,
                    empresa: cod_empresa,
                    activo: activo
                })
            })
            .then(response => response.json())
            .then(data => {
                // Manejar la respuesta del servidor
                if (data.success) {

                    // Referencia al contenedor de la tabla
                    const tablaResultados = document.getElementById('tablaResultados');
                    let totalVenta = data.total ? data.total : 0;
                    // Crear estructura HTML para la tabla
                    let tablaHTML = `

                    <button class="btn btn-sm btn-danger mb-3"
                        id="btnDescargarPDF" data-inicio="${inicio}" data-fin="${fin}" data-sucursal="${sucursal}"
                        data-cliente="${cliente}" data-tipo-pago="${tipo_pago}" data-activo="${activo}" data-empresa="${cod_empresa}">
                        Descargar Pdf</button>

                    <button class="btn btn-sm btn-success mb-3"
                        onclick="descargarExcelVentas('${baseUrl}', '${inicio}', '${fin}', '${sucursal}', '${cliente}', '${tipo_pago}', '${activo}', '${cod_empresa}')">
                        Descargar Excel</button>

                    <div class="table-responsive">
                        <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                            <thead class="bg-colorbase" style="font-size: 12px;">
                                <tr class="text-white">
                                    <th rowspan="2" style="align-content: center;"><center>NRO</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>CLIENTE</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>SUCURSAL</center></th>
                                    <th colspan="1" style="align-content: center;"><center>TOTAL</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>METODO DE PAGO</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>VENDEDOR</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>FECHA</center></th>
                                </tr>
                                <tr class="text-white">
                                    <th style="align-content: center;"><center>Ventas = ${totalVenta} Bs.</center></th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 11px;">
                    `;

                    // Recorrer las ventas y crear filas dinámicamente
                    data.ventas.forEach(venta => {
                    tablaHTML += `
                    <tr>
                        <td><center>${venta.nro}</center></td>
                        <td>${venta.cliente}</td>
                        <td>${venta.sucursal}</td>
                        <td><center>${venta.total_venta}</center></td>
                        <td>${venta.tipo_pago}</td>
                        <td>${venta.vendedor}</td>
                        <td>${venta.fecha}</td>
                    </tr>
                    `;
                    });

                    // Cerrar la tabla
                    tablaHTML += `
                            </tbody>
                        </table>
                    </div>
                    `;

                    // Inyectar la tabla en el contenedor
                    tablaResultados.innerHTML = tablaHTML;

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error al consultar el reporte',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la conexion con la BD',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        }

        // Nueva función para descargar Excel
        function descargarExcelVentas(baseUrl, inicio, fin, sucursal, cliente, tipo_pago, activo, cod_empresa) {
            const url = `${baseUrl}reporte/excel_ventas.php?inicio=${inicio}&fin=${fin}&sucursal=${sucursal}&cliente=${cliente}&tipo_pago=${tipo_pago}&activo=${activo}&empresa=${cod_empresa}`;
            window.open(url, '_blank');
        }
    </script>

    <script>
        //Productos mas vendidos
        function producto_vendido(baseUrl, inicio, fin, cod_empresa, sucursal, producto){
            // Enviar los datos mediante AJAX
            fetch(`${baseUrl}reporte/producto_mas_vendido.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir token CSRF para seguridad
                },
                body: JSON.stringify({
                    inicio: inicio,
                    fin: fin,
                    sucursal: sucursal,
                    empresa: cod_empresa,
                    producto: producto,
                })
            })
            .then(response => response.json())
            .then(data => {
                // Manejar la respuesta del servidor
                if (data.success) {
                    // Referencia al contenedor de la tabla
                    const tablaResultados = document.getElementById('tablaResultados');

                    // Crear estructura HTML para la tabla
                    let tablaHTML = `
                    <button class="btn btn-sm btn-danger mb-3"
                        id="btnDescargarProd" data-inicio="${inicio}" data-fin="${fin}" data-sucursal="${sucursal}"
                        data-empresa="${cod_empresa}" data-producto="${producto}">Descargar Pdf</button>

                    <button class="btn btn-sm btn-success mb-3"
                        onclick="descargarExcelProd('${baseUrl}', '${inicio}', '${fin}', '${sucursal}', '${producto}', '${cod_empresa}')">
                        Descargar Excel</button>

                    <div class="table-responsive">
                        <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                            <thead class="bg-colorbase" style="font-size: 12px;">
                                <tr class="text-white">
                                    <th style="align-content: center;"><center>PRODUCTO</center></th>
                                    <th style="align-content: center;"><center>CANTIDAD</center></th>
                                    <th style="align-content: center;"><center>TOTAL BS.</center></th>
                                    <th style="align-content: center;"><center>SUCURSAL</center></th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 11px;">
                    `;

                    // Recorrer las ventas y crear filas dinámicamente
                    data.ventas.forEach(venta => {
                    tablaHTML += `
                    <tr>
                        <td>${venta.producto}</td>
                        <td><center>${venta.total_cantidad}</center></td>
                        <td><center>${venta.total_monto}</center></td>
                        <td>${venta.sucursal}</td>
                    </tr>
                    `;
                    });

                    // Cerrar la tabla
                    tablaHTML += `
                            </tbody>
                        </table>
                    </div>
                    `;

                    // Inyectar la tabla en el contenedor
                    tablaResultados.innerHTML = tablaHTML;

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error al consultar el reporte',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la conexion con la BD',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        }

        // Nueva función para descargar Excel
        function descargarExcelProd(baseUrl, inicio, fin, sucursal, producto, cod_empresa) {
            const url = `${baseUrl}reporte/excel_producto_vendido.php?inicio=${inicio}&fin=${fin}&sucursal=${sucursal}&producto=${producto}&empresa=${cod_empresa}`;
            window.open(url, '_blank');
        }
    </script>

    <script>
        //Ventas por Sucursal
        function ventas_sucursal(baseUrl, inicio, fin, cod_empresa){
            // Enviar los datos mediante AJAX
            fetch(`${baseUrl}reporte/ventas_sucursal.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir token CSRF para seguridad
                },
                body: JSON.stringify({
                    inicio: inicio,
                    fin: fin,
                    empresa: cod_empresa
                })
            })
            .then(response => response.json())
            .then(data => {
                // Manejar la respuesta del servidor
                if (data.success) {
                    // Referencia al contenedor de la tabla
                    const tablaResultados = document.getElementById('tablaResultados');
                    let totalVenta = data.total ? data.total : 0;
                    // Crear estructura HTML para la tabla
                    let tablaHTML = `
                    <button class="btn btn-sm btn-danger mb-3"
                        id="btnDescargarSuc" data-inicio="${inicio}" data-fin="${fin}"
                        data-empresa="${cod_empresa}">Descargar Pdf</button>

                    <button class="btn btn-sm btn-success mb-3"
                        onclick="descargarExcelSuc('${baseUrl}', '${inicio}', '${fin}', '${cod_empresa}')">
                        Descargar Excel</button>

                    <div class="table-responsive">
                        <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                            <thead class="bg-colorbase" style="font-size: 12px;">
                                <tr class="text-white">
                                    <th rowspan="2" style="align-content: center;"><center>SUCURSAL</center></th>
                                    <th colspan="1" style="align-content: center;"><center>TOTAL BS.</center></th>
                                </tr>
                                <tr class="text-white">
                                    <th style="align-content: center;"><center>Ventas = ${totalVenta} Bs.</center></th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 11px;">
                    `;

                    // Recorrer las ventas y crear filas dinámicamente
                    data.ventas.forEach(venta => {
                    tablaHTML += `
                    <tr>
                        <td>${venta.sucursal}</td>
                        <td><center>${venta.total}</center></td>
                    </tr>
                    `;
                    });

                    // Cerrar la tabla
                    tablaHTML += `
                            </tbody>
                        </table>
                    </div>
                    `;

                    // Inyectar la tabla en el contenedor
                    tablaResultados.innerHTML = tablaHTML;

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error al consultar el reporte',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la conexion con la BD',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        }

        // Nueva función para descargar Excel
        function descargarExcelSuc(baseUrl, inicio, fin, cod_empresa) {
            const url = `${baseUrl}reporte/excel_venta_sucursal.php?inicio=${inicio}&fin=${fin}&empresa=${cod_empresa}`;
            window.open(url, '_blank');
        }
    </script>

    <script>

        function cierre_caja(baseUrl, inicio, fin, cod_empresa, sucursal){
            // Enviar los datos mediante AJAX
            fetch(`${baseUrl}reporte/cierre_arqueo.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir token CSRF para seguridad
                },
                body: JSON.stringify({
                    inicio: inicio,
                    fin: fin,
                    empresa: cod_empresa,
                    sucursal: sucursal,
                })
            })
            .then(response => response.json())
            .then(data => {
                // Manejar la respuesta del servidor
                if (data.success) {
                    // Referencia al contenedor de la tabla
                    const tablaResultados = document.getElementById('tablaResultados');
                    let totalVenta = data.total ? data.total : 0;
                    // Crear estructura HTML para la tabla
                    let tablaHTML = `

                    <button class="btn btn-sm btn-danger mb-3"
                        id="btnDescargarCaja" data-inicio="${inicio}" data-fin="${fin}"
                        data-empresa="${cod_empresa}" data-sucursal="${sucursal}">Descargar Pdf</button>

                    <button class="btn btn-sm btn-success mb-3"
                        onclick="descargarExcelCierre('${baseUrl}', '${inicio}', '${fin}', '${cod_empresa}', '${sucursal}')">
                        Descargar Excel</button>

                    <div class="table-responsive">
                        <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                            <thead class="bg-colorbase" style="font-size: 12px;">
                                <tr class="text-white">
                                    <th rowspan="2" style="align-content: center;"><center>NRO</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>SUCURSAL</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>APERTURA</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>CIERRE</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>MONTO APERTURA</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>MONTO CIERRE</center></th>
                                    <th colspan="1" style="align-content: center;"><center>SOBRANTE / FALTANTE</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>CANT. VENTAS</center></th>
                                </tr>
                                <tr class="text-white">
                                    <th style="align-content: center;"><center>Total = ${totalVenta} Bs.</center></th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 11px;">
                    `;

                    // Recorrer las ventas y crear filas dinámicamente
                    data.ventas.forEach(venta => {

                    tablaHTML += `
                    <tr>
                        <td>${venta.nro}</td>
                        <td>${venta.sucursal}</td>
                        <td>
                            <span>${venta.fecha_a}<br>
                            <b>${venta.hora_a}</b></span>
                        </td>
                        <td>
                            <span>${venta.fecha_c}<br>
                            <b style="color:#b10c1c">${venta.hora_c}</b></span>
                        </td>
                        <td><center>${venta.monto_a}</center></td>
                        <td><center>${venta.monto_c}</center></td>
                        <td><center>${venta.diferencia}</center></td>
                        <td><center>${venta.ventas}</center></td>
                    </tr>
                    `;
                    });

                    // Cerrar la tabla
                    tablaHTML += `
                            </tbody>
                        </table>
                    </div>
                    `;

                    // Inyectar la tabla en el contenedor
                    tablaResultados.innerHTML = tablaHTML;

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error al consultar el reporte',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la conexion con la BD',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        }

        // Nueva función para descargar Excel
        function descargarExcelCierre(baseUrl, inicio, fin, cod_empresa, sucursal) {
            const url = `${baseUrl}reporte/excel_cierre.php?inicio=${inicio}&fin=${fin}&empresa=${cod_empresa}&sucursal=${sucursal}`;
            window.open(url, '_blank');
        }
    </script>

    <script>
        function categoria_vendido(baseUrl, inicio, fin, cod_empresa, sucursal, categoria){
            // Enviar los datos mediante AJAX
            fetch(`${baseUrl}reporte/categoria_ventas.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir token CSRF para seguridad
                },
                body: JSON.stringify({
                    inicio: inicio,
                    fin: fin,
                    sucursal: sucursal,
                    empresa: cod_empresa,
                    categoria: categoria,
                })
            })
            .then(response => response.json())
            .then(data => {
                // Manejar la respuesta del servidor
                if (data.success) {
                    // Referencia al contenedor de la tabla
                    const tablaResultados = document.getElementById('tablaResultados');

                    // Crear estructura HTML para la tabla
                    let tablaHTML = `
                    <button class="btn btn-sm btn-danger mb-3"
                        id="btnDescargarCat" data-inicio="${inicio}" data-fin="${fin}" data-sucursal="${sucursal}"
                        data-empresa="${cod_empresa}" data-categoria="${categoria}">Descargar Pdf</button>

                    <button class="btn btn-sm btn-success mb-3"
                        onclick="descargarExcelCat('${baseUrl}', '${inicio}', '${fin}', '${cod_empresa}', '${sucursal}', '${categoria}')">
                        Descargar Excel</button>

                    <div class="table-responsive">
                        <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                            <thead class="bg-colorbase" style="font-size: 12px;">
                                <tr class="text-white">
                                    <th style="align-content: center;"><center>CATEGORIA</center></th>
                                    <th style="align-content: center;"><center>CANTIDAD</center></th>
                                    <th style="align-content: center;"><center>TOTAL BS.</center></th>
                                    <th style="align-content: center;"><center>SUCURSAL</center></th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 11px;">
                    `;

                    // Recorrer las ventas y crear filas dinámicamente
                    data.ventas.forEach(venta => {
                    tablaHTML += `
                    <tr>
                        <td>${venta.categoria}</td>
                        <td><center>${venta.total_cantidad}</center></td>
                        <td><center>${venta.total_monto}</center></td>
                        <td>${venta.sucursal}</td>
                    </tr>
                    `;
                    });

                    // Cerrar la tabla
                    tablaHTML += `
                            </tbody>
                        </table>
                    </div>
                    `;

                    // Inyectar la tabla en el contenedor
                    tablaResultados.innerHTML = tablaHTML;

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error al consultar el reporte',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la conexion con la BD',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        }

        // Nueva función para descargar Excel
        function descargarExcelCat(baseUrl, inicio, fin, cod_empresa, sucursal, categoria) {
            const url = `${baseUrl}reporte/excel_categoria.php?inicio=${inicio}&fin=${fin}&empresa=${cod_empresa}&sucursal=${sucursal}&categoria=${categoria}`;
            window.open(url, '_blank');
        }
    </script>

    <script>
        function cliente_eliminado(baseUrl, inicio, fin, cod_empresa){
            // Enviar los datos mediante AJAX
            fetch(`${baseUrl}reporte/cliente_eliminado.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir token CSRF para seguridad
                },
                body: JSON.stringify({
                    inicio: inicio,
                    fin: fin,
                    empresa: cod_empresa,
                })
            })
            .then(response => response.json())
            .then(data => {
                // Manejar la respuesta del servidor
                if (data.success) {
                    // Referencia al contenedor de la tabla
                    const tablaResultados = document.getElementById('tablaResultados');

                    // Crear estructura HTML para la tabla
                    let tablaHTML = `
                    <button class="btn btn-sm btn-danger mb-3"
                        id="btnDescargarCli" data-inicio="${inicio}" data-fin="${fin}"
                        data-empresa="${cod_empresa}">Descargar Pdf</button>

                    <button class="btn btn-sm btn-success mb-3"
                        onclick="descargarExcelCli('${baseUrl}', '${inicio}', '${fin}', '${cod_empresa}')">
                        Descargar Excel</button>

                    <div class="table-responsive">
                        <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                            <thead class="bg-colorbase" style="font-size: 12px;">
                                <tr class="text-white">
                                    <th style="align-content: center;"><center>NOMBRE</center></th>
                                    <th style="align-content: center;"><center>TELEFONO</center></th>
                                    <th style="align-content: center;"><center>CORREO</center></th>
                                    <th style="align-content: center;"><center>SEXO</center></th>
                                    <th style="align-content: center;"><center>F. CUMPLEAÑOS</center></th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 11px;">
                    `;

                    // Recorrer las ventas y crear filas dinámicamente
                    data.ventas.forEach(venta => {
                    tablaHTML += `
                    <tr>
                        <td>${venta.nombre}</td>
                        <td><center>${venta.telefono}</center></td>
                        <td><center>${venta.correo}</center></td>
                        <td>${venta.sexo}</td>
                        <td>${venta.fecha}</td>
                    </tr>
                    `;
                    });

                    // Cerrar la tabla
                    tablaHTML += `
                            </tbody>
                        </table>
                    </div>
                    `;

                    // Inyectar la tabla en el contenedor
                    tablaResultados.innerHTML = tablaHTML;

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error al consultar el reporte',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la conexion con la BD',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        }

        // Nueva función para descargar Excel
        function descargarExcelCli(baseUrl, inicio, fin, cod_empresa) {
            const url = `${baseUrl}reporte/excel_cliente_eliminado.php?inicio=${inicio}&fin=${fin}&empresa=${cod_empresa}`;
            window.open(url, '_blank');
        }
    </script>

    <script>
        function ventas_usuario(baseUrl, inicio, fin, cod_empresa, sucursal, usuario){
            // Enviar los datos mediante AJAX
            fetch(`${baseUrl}reporte/ventas_usuario.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir token CSRF para seguridad
                },
                body: JSON.stringify({
                    inicio: inicio,
                    fin: fin,
                    empresa: cod_empresa,
                    sucursal: sucursal,
                    usuario: usuario,
                })
            })
            .then(response => response.json())
            .then(data => {
                // Manejar la respuesta del servidor
                if (data.success) {
                    // Referencia al contenedor de la tabla
                    const tablaResultados = document.getElementById('tablaResultados');

                    // Crear estructura HTML para la tabla
                    let tablaHTML = `
                    <button class="btn btn-sm btn-danger mb-3"
                        id="btnDescargarUsu" data-inicio="${inicio}" data-fin="${fin}" data-sucursal="${sucursal}"
                        data-empresa="${cod_empresa}" data-usuario="${usuario}">Descargar Pdf</button>

                    <button class="btn btn-sm btn-success mb-3"
                        onclick="descargarExcelUsu('${baseUrl}', '${inicio}', '${fin}', '${cod_empresa}','${sucursal}', '${usuario}')">
                        Descargar Excel</button>

                    <div class="table-responsive">
                        <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                            <thead class="bg-colorbase" style="font-size: 12px;">
                                <tr class="text-white">
                                    <th style="align-content: center;"><center>USUARIO</center></th>
                                    <th style="align-content: center;"><center>CANTIDAD</center></th>
                                    <th style="align-content: center;"><center>TOTAL BS.</center></th>
                                    <th style="align-content: center;"><center>SUCURSAL</center></th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 11px;">
                    `;

                    // Recorrer las ventas y crear filas dinámicamente
                    data.ventas.forEach(venta => {
                    tablaHTML += `
                    <tr>
                        <td>${venta.usuario}</td>
                        <td><center>${venta.total_cantidad}</center></td>
                        <td><center>${venta.total_monto}</center></td>
                        <td>${venta.sucursal}</td>
                    </tr>
                    `;
                    });

                    // Cerrar la tabla
                    tablaHTML += `
                            </tbody>
                        </table>
                    </div>
                    `;

                    // Inyectar la tabla en el contenedor
                    tablaResultados.innerHTML = tablaHTML;

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error al consultar el reporte',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la conexion con la BD',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        }

        // Nueva función para descargar Excel
        function descargarExcelUsu(baseUrl, inicio, fin, cod_empresa, sucursal, usuario) {
            const url = `${baseUrl}reporte/excel_ventas_usuario.php?inicio=${inicio}&fin=${fin}&empresa=${cod_empresa}`;
            window.open(url, '_blank');
        }
    </script>

    <script>
        document.addEventListener('click', function (e) {
            if (e.target && e.target.id === 'btnDescargarPDF') {
                const button = e.target;

                // Obtener los parámetros desde los atributos `data-`
                const params = {
                    inicio: button.getAttribute('data-inicio'),
                    fin: button.getAttribute('data-fin'),
                    sucursal: button.getAttribute('data-sucursal'),
                    cliente: button.getAttribute('data-cliente'),
                    tipo_pago: button.getAttribute('data-tipo-pago'),
                    empresa: button.getAttribute('data-empresa'),
                    activo: button.getAttribute('data-activo')
                };

                // Crear un formulario dinámico para enviar al controlador
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'det_venta_pdf'; // Asegúrate de usar la ruta correcta
                form.target = '_blank'; // Abrir el PDF en una nueva pestaña

                // Añadir token CSRF
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // Agregar los parámetros al formulario
                for (const key in params) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = params[key];
                    form.appendChild(input);
                }

                // Añadir el formulario al cuerpo, enviarlo y eliminarlo
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
            }
            else if(e.target && e.target.id === 'btnDescargarProd')
            {

                const button = e.target;

                // Obtener los parámetros desde los atributos `data-`
                const params = {
                    inicio: button.getAttribute('data-inicio'),
                    fin: button.getAttribute('data-fin'),
                    sucursal: button.getAttribute('data-sucursal'),
                    empresa: button.getAttribute('data-empresa'),
                    producto: button.getAttribute('data-producto'),
                };

                // Crear un formulario dinámico para enviar al controlador
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'prod_vendido_pdf'; // Asegúrate de usar la ruta correcta
                form.target = '_blank'; // Abrir el PDF en una nueva pestaña

                // Añadir token CSRF
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // Agregar los parámetros al formulario
                for (const key in params) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = params[key];
                    form.appendChild(input);
                }

                // Añadir el formulario al cuerpo, enviarlo y eliminarlo
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);

            }
            else if(e.target && e.target.id === 'btnDescargarSuc')
            {

                const button = e.target;

                // Obtener los parámetros desde los atributos `data-`
                const params = {
                    inicio: button.getAttribute('data-inicio'),
                    fin: button.getAttribute('data-fin'),
                    empresa: button.getAttribute('data-empresa'),
                };

                // Crear un formulario dinámico para enviar al controlador
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'venta_sucursal_pdf'; // Asegúrate de usar la ruta correcta
                form.target = '_blank'; // Abrir el PDF en una nueva pestaña

                // Añadir token CSRF
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // Agregar los parámetros al formulario
                for (const key in params) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = params[key];
                    form.appendChild(input);
                }

                // Añadir el formulario al cuerpo, enviarlo y eliminarlo
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);

            }
            else if(e.target && e.target.id === 'btnDescargarCaja')
            {

                const button = e.target;

                // Obtener los parámetros desde los atributos `data-`
                const params = {
                    inicio: button.getAttribute('data-inicio'),
                    fin: button.getAttribute('data-fin'),
                    empresa: button.getAttribute('data-empresa'),
                    sucursal: button.getAttribute('data-sucursal'),
                };

                // Crear un formulario dinámico para enviar al controlador
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'caja_pdf'; // Asegúrate de usar la ruta correcta
                form.target = '_blank'; // Abrir el PDF en una nueva pestaña

                // Añadir token CSRF
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // Agregar los parámetros al formulario
                for (const key in params) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = params[key];
                    form.appendChild(input);
                }

                // Añadir el formulario al cuerpo, enviarlo y eliminarlo
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);

            }
            else if(e.target && e.target.id === 'btnDescargarCat')
            {

                const button = e.target;

                // Obtener los parámetros desde los atributos `data-`
                const params = {
                    inicio: button.getAttribute('data-inicio'),
                    fin: button.getAttribute('data-fin'),
                    empresa: button.getAttribute('data-empresa'),
                    sucursal: button.getAttribute('data-sucursal'),
                    categoria: button.getAttribute('data-categoria'),
                };

                // Crear un formulario dinámico para enviar al controlador
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'categoria_pdf'; // Asegúrate de usar la ruta correcta
                form.target = '_blank'; // Abrir el PDF en una nueva pestaña

                // Añadir token CSRF
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // Agregar los parámetros al formulario
                for (const key in params) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = params[key];
                    form.appendChild(input);
                }

                // Añadir el formulario al cuerpo, enviarlo y eliminarlo
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);

            }
            else if(e.target && e.target.id === 'btnDescargarCli')
            {

                const button = e.target;

                // Obtener los parámetros desde los atributos `data-`
                const params = {
                    inicio: button.getAttribute('data-inicio'),
                    fin: button.getAttribute('data-fin'),
                    empresa: button.getAttribute('data-empresa'),
                };

                // Crear un formulario dinámico para enviar al controlador
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'cliente_pdf'; // Asegúrate de usar la ruta correcta
                form.target = '_blank'; // Abrir el PDF en una nueva pestaña

                // Añadir token CSRF
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // Agregar los parámetros al formulario
                for (const key in params) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = params[key];
                    form.appendChild(input);
                }

                // Añadir el formulario al cuerpo, enviarlo y eliminarlo
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);

            }
            else if(e.target && e.target.id === 'btnDescargarUsu')
            {

                const button = e.target;

                // Obtener los parámetros desde los atributos `data-`
                const params = {
                    inicio: button.getAttribute('data-inicio'),
                    fin: button.getAttribute('data-fin'),
                    empresa: button.getAttribute('data-empresa'),
                    sucursal: button.getAttribute('data-sucursal'),
                    usuario: button.getAttribute('data-usuario'),
                };

                // Crear un formulario dinámico para enviar al controlador
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'usuario_pdf'; // Asegúrate de usar la ruta correcta
                form.target = '_blank'; // Abrir el PDF en una nueva pestaña

                // Añadir token CSRF
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // Agregar los parámetros al formulario
                for (const key in params) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = params[key];
                    form.appendChild(input);
                }

                // Añadir el formulario al cuerpo, enviarlo y eliminarlo
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);

            }

        });
    </script>

@endpush
@push('styles')
    <style>
        .fec{
            width: 19%;
        }

        b{
            color: #4CAF50;
        }

        .sel{
            max-width: 400px;
        }

        .filtros{
            border: 2px solid #4CAF50;
            padding: 10px 5px;
            border-radius: 5px;
        }

        .btn-color{
            background: #4CAF50;
        }

        @media (max-width: 768px) {
            .fec{
                width: 45%;
            }
        }
    </style>
@endpush
@stop
