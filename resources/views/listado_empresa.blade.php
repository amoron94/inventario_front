@extends('dashboard')
@section('contenido')


    <div class="card-header">
        <div class="container-fluid p-0">
            <h3 class="d-inline align-middle">Editar Datos de Empresa</h3>
            <br>
            <span class="text-danger"><b>Nota: Todo Cambio Realizado se reflejara en los datos de impresion y/o reportes.</b></span>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('editar_empresa', ['id' => $empresas['data']['codigo']]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-xs-12 mt-2">
                        <label for="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control form-control-sm" value="{{ $empresas['data']['nombre'] }}" required>
                    </div>
                    <div class="col-lg-7 col-xs-12 mt-2">
                        <label for="form-label">Direccion</label>
                        <input type="text" name="direccion" class="form-control form-control-sm" value="{{ $empresas['data']['direccion'] }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-xs-12 mt-2">
                        <label for="form-label">Telefono</label>
                        <input type="number" name="telefono" class="form-control form-control-sm" value="{{ $empresas['data']['telefono'] }}" required>
                    </div>
                    <div class="col-lg-9 col-xs-12 mt-2">
                        <label for="form-label">Slogan</label>
                        <input type="text" name="slogan" class="form-control form-control-sm" value="{{ $empresas['data']['slogan'] }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xs-12 mt-2">
                        <label for="form-label">Cambiar de Logo</label>
                        <input type="file" name="img" class="form-control form-control-sm" accept="image/*">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xs-12 mt-2">
                        <center>
                            <img src="{{ asset('img/empresa/' . $empresas['data']['img']) }}" alt="img-empresa" class="img-fluid rounded-3" width="200" height="200"/>
                        </center>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm float-end">Guardar Datos</button>
            </div>
        </form>
    </div>

@push('scripts')
    <script>

    </script>
@endpush

@stop
