@extends('dashboard')
@section('contenido')

@php
    $fechaActual = date('d/m/Y');
@endphp

    <div class="card-header">
        <div class="container-fluid p-0">
            <h3 class="d-inline align-middle">Listado de Cobros Pendientes de Pago</h3>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle" data-order-direction="desc">
                <thead class="bg-colorbase" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Fecha Vencimiento</th>
                        <th>Cliente</th>
                        <th>Responsable Cobro</th>
                        <th>Monto Pagado</th>
                        <th>Saldo Pendiente</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($cobros['data'] as $cobro)
                    <tr>
                        @if($cobro['estado'] == 'PENDIENTE' && $cobro['fecha_v'] <= $fechaActual)
                            <td>
                                <span class="badge bg-danger fw-semibold" style="font-size: 11px;">
                                    <b>Fecha Vencida: {{ $cobro['fecha_v']}}</b>
                                </span>
                            </td>
                        @else
                            <td>{{ $cobro['fecha_v']}}</td>
                        @endif
                        <td>
                            <b><span>{{ $cobro['cliente']}}</span><br>
                            <span class="text-danger">{{ $cobro['telefono']}}</span></b>
                        </td>
                        <td>{{ $cobro['cajero']}}</td>
                        <td>{{ $cobro['total_pagado']}}</td>
                        <td>{{ $cobro['saldo_pendiente']}}</td>
                        <td>
                            @if( $cobro['estado'] == 'PENDIENTE')
                                <span class="badge bg-danger rounded-3 fw-semibold" style="font-size: 10px;">{{ $cobro['estado']}}</span>
                            @else
                                <span class="badge bg-success rounded-3 fw-semibold" style="font-size: 10px;">{{ $cobro['estado']}}</span>
                            @endif
                        </td>
                        <td>
                            @if( $cobro['estado'] == 'PENDIENTE')
                            <center>
                                <a data-bs-toggle="modal" data-bs-target="#pagar{{ $cobro['codigo'] }}" title="Cobrar">
                                    <i class="text-success" data-feather="dollar-sign"></i>
                                </a>
                            </center>
                            @endif
                        </td>

                        <!--Modal Pagar-->
                        <div class="modal fade" id="pagar{{ $cobro['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-success">
                                        <h3 class="modal-title fs-5 text-white">Cobrar deuda de Pago</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('pagar_cobro', ['id' => $cobro['codigo']]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12 col-xs-12">
                                                        <div class="form-group">
                                                            <h6>¿Estás seguro que quieres Cobrar la deuda?</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-success btn-sm">Cobrar</button>
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

@push('scripts')
    <script>
    </script>
@endpush

@stop
