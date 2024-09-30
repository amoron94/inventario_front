@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <button class="btn btn-sm btn-success float-end" data-bs-toggle="modal" data-bs-target="#nuevo">Nuevo</button>
            <h3 class="d-inline align-middle">Listado Gastos</h3>
            <br>
            <span class="text-danger"><b>Nota: Se vizualizan los gastos de los ultimos 3 meses</b></span>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle" data-order-direction="desc">
                <thead class="bg-primary" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Fecha</th>
                        <th>Servicio</th>
                        <th>Monto (Bs.)</th>
                        <th>Observaciones</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($gastos['data'] as $gasto)
                    <tr>
                        <td><b>{{ $gasto['fecha']}}</b></td>
                        <td>{{ $gasto['servicio']}}</td>
                        <td>{{ $gasto['monto']}}</td>
                        <td>{{ $gasto['descripcion']}}</td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#editar{{ $gasto['codigo'] }}" title="Editar">
                                <i class="text-primary" data-feather="edit-2"></i>
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#eliminar{{ $gasto['codigo'] }}" title="Eliminar">
                                <i class="text-danger" data-feather="trash-2"></i>
                            </a>
                        </td>

                        <!--Modal Editar-->
                        <div class="modal fade" id="editar{{ $gasto['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-primary">
                                        <h3 class="modal-title fs-5 text-white">Editar</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('editar_gasto', ['id' => $gasto['codigo']]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Servicio</label>
                                                            <input type="text" id="servicio-{{ $gasto['codigo'] }}" name="servicio" value="{{ $gasto['cod_servicio'] }}" hidden>
                                                            <select id="select-servicio-{{ $gasto['codigo'] }}" name="ser" class="selectpicker show-tick form-control form-control-sm" data-live-search="true" required>
                                                                <option value="" disabled selected>Seleccionar...</option>
                                                                @foreach ($servicios['data']  as $servicio)
                                                                    @if($servicio['codigo'] == $gasto['cod_servicio'])
                                                                        <option value="{{ $servicio['codigo'] }}" selected>{{ $servicio['descripcion'] }}</option>
                                                                    @else
                                                                        <option value="{{ $servicio['codigo'] }}">{{ $servicio['descripcion'] }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Monto</label>
                                                            <input type="number" name="monto" class="form-control form-control-sm" value="{{ $gasto['monto'] }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Fecha</label>
                                                            <input type="date" name="fecha" class="form-control form-control-sm" value="{{ $gasto['fecha_g'] }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Descripcion</label>
                                                            <textarea type="text" name="descripcion" class="form-control form-control-sm" rows="3" placeholder="Ingrese el detalle del gasto">{{ $gasto['descripcion'] }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--Modal Eliminar-->
                        <div class="modal fade" id="eliminar{{ $gasto['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h3 class="modal-title fs-5 text-white">Eliminar</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_gasto', ['id' => $gasto['codigo']]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12 col-xs-12">
                                                        <div class="form-group">
                                                            <h6>¿Estás seguro que quieres eliminar?</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!--Modal Nuevo-->
    <div class="modal fade" id="nuevo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-success">
                    <h3 class="modal-title fs-5 text-white" id="exampleModalLabel">Agregar Gasto</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guardar_gasto') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Servicio</label>
                                        <select name="servicio" class="selectpicker show-tick form-control form-control-sm" data-live-search="true" required>
                                            <option value="" disabled selected>Seleccionar...</option>
                                            @foreach ($servicios['data'] as $servicio)
                                            <option value="{{ $servicio['codigo'] }}">{{ $servicio['descripcion'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Monto</label>
                                        <input type="number" name="monto" class="form-control form-control-sm" step="0.01" min="0" required>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Fecha</label>
                                        <input type="date" name="fecha" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Descripcion</label>
                                        <textarea name="descripcion" class="form-control form-control-sm" rows="3" placeholder="Ingrese el detalle del gasto"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        /*$('input[name="daterange"]').daterangepicker({
            opens: 'auto',
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
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });*/

        document.addEventListener("DOMContentLoaded", function() {
            @foreach($gastos['data'] as $gasto)
            document.getElementById('select-servicio-{{ $gasto['codigo'] }}').addEventListener('change', function() {
                document.getElementById('servicio-{{ $gasto['codigo'] }}').value = this.value;
            });
            @endforeach
        });
    </script>
@endpush

@stop
