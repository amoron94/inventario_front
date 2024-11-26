@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <h3 class="d-inline align-middle">Listado de Lotes por Productos</h3>
        </div>
    </div>

    <div class="card-body">
        <div class="row flex-grow-1 sect-prod">

            @foreach ($productos['data'] as $producto)
            <!-- Repite este bloque para cada producto -->
            <div class="col-6 col-lg-2 animate__animated animate__fadeIn">
                <a href="{{ route('ver_lote', ['id' => $producto['codigo'], 'nombre' => urlencode($producto['producto'])]) }}" class="text-decoration-none">
                <div class="product-card">
                    <span class="precio"><b>{{ $producto['producto'] }}</b></span>
                    <img src="{{ asset('img/productos/' . $producto['img']) }}" alt="img-p" class="img-fluid rounded-3 mb-2">
                    <span>{{ $producto['tipo'] }} ({{ $producto['av'] }})</span><br>
                    <span class="badge-primary rounded-2 px-1">{{ $producto['categoria'] }}</span>
                    <span hidden>{{ $producto['cant'] }}</span>
                </div>
                </a>
            </div>
            <!-- Fin del bloque de producto -->
            @endforeach
        </div>
    </div>


@push('scripts')
    <script>

    </script>
@endpush
@push('styles')
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

        .sect-prod{
            font-family: 'Poppins', sans-serif !important;
        }

        .product-card {
            background: #d8e4d9;
            font-family: 'Poppins', sans-serif !important;
            border: 1px solid #ffffff;
            padding: 5px 10px;
            margin-top: 5px;
            border-radius: 8px;
            color: #000;
            font-weight: bold;
            transition: transform 0.3s ease;
            font-size: 8px;
        }

        .product-card:hover {
            border: 1px solid #168500;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            font-family: 'Poppins', sans-serif !important;
        }

        .product-card:focus {
            border: 1px solid #168500;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            font-family: 'Poppins', sans-serif !important;
        }

        .precio{
            color: #168500;
            font-weight: bold;
            font-size: 9px;
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
@endpush
@stop
