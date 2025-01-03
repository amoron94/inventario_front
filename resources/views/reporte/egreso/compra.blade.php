@extends('dashboard')
@section('contenido')
    <?php $usuario = session('usuario_logueado'); ?>

    <input type="text" name="cod_empresa" value="{{ $usuario['data']['cod_empresa'] }}" hidden>

    <div class="card-header">
        <div class="container-fluid p-0">
            <label for="form-label" class="mr-3"><b class="b">Rango de Fechas:</b></label>
            <input name="daterange" class="form-control d-inline align-middle fec">
        </div>

        <div class="row mt-3">
            <div class="col d-flex align-items-center">
                <label for="form-label" class="mr-3"><b class="b">Seleccione su reporte:</b></label>
                <select name="buscar" class="form-select mr-5 sel">
                    <option value="1">Detalle Compras</option>
                    <option value="2">Compras Eliminadas</option>
                    <option value="3">Producto mas Comprados</option>
                    <option value="4">Compras por producto</option>
                    <option value="5">Compras por Sucursal</option>
                    <option value="6">Detalle de Gastos</option>
                    <option value="7">Gastos por Sucursal</option>
                    <option value="8">Gastos eliminados</option>
                    <option value="9">Proveedores Eliminados</option>
                </select>
                <button id="buscar" class="btn btn-primary btn-color">Buscar</button>
            </div>
        </div>

        <div class="row mt-4 filtros">
            <div class="col d-flex align-items-center">
                <div class="form-group mr-5">
                    <label for="form-label"><b class="b">Sucursal</b></label>
                    <select name="sucursal" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todas las sucursales</option>
                        @foreach ($sucursales['data'] as $sucursal)
                        <option value="{{ $sucursal['codigo'] }}">{{ $sucursal['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-5">
                    <label for="form-label"><b class="b">Proveedor</b></label>
                    <select name="proveedor" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todos los Proveedores</option>
                        @foreach ($proveedores['data'] as $proveedor)
                        <option value="{{ $proveedor['codigo'] }}">{{ $proveedor['empresa'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-5">
                    <label for="form-label"><b class="b">Productos</b></label>
                    <select name="producto" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todos los Productos</option>
                        @foreach ($productos['data'] as $productos)
                        <option value="{{ $productos['codigo'] }}">{{ $productos['descripcion'] }}</option>
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
            // Capturar el evento de cambio en el select "buscar"
            $('select[name="buscar"]').on('change', function () {
                let selectedValue = $(this).val();

                // Ocultar o mostrar los campos según el valor seleccionado
                switch (selectedValue) {
                    case '1':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="proveedor"]').closest('.form-group').show();
                        $('select[name="producto"]').closest('.form-group').hide();
                        break;
                    case '2':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="proveedor"]').closest('.form-group').show();
                        $('select[name="producto"]').closest('.form-group').hide();
                        break;
                    case '3':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="proveedor"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').hide();
                        break;
                    case '4':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="proveedor"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').show();
                        break;
                    case '5':
                        $('select[name="sucursal"]').closest('.form-group').hide();
                        $('select[name="proveedor"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').hide();
                        break;
                    case '6':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="proveedor"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').hide();
                        break;
                }


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
        });

    </script>

@endpush
@push('styles')
    <style>
        .fec{
            width: 19%;
        }

        .b{
            color: #1e27a5;
        }

        .sel{
            max-width: 400px;
        }

        .filtros{
            border: 2px solid #1e27a5;
            padding: 10px 5px;
            border-radius: 5px;
        }

        .btn-color{
            background: #1e27a5;
        }

        @media (max-width: 768px) {
            .fec{
                width: 45%;
            }
        }
    </style>
@endpush
@stop
