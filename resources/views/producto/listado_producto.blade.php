@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <button class="btn btn-sm btn-success float-end" data-bs-toggle="modal" data-bs-target="#nuevo">Nuevo</button>
            <h3 class="d-inline align-middle">Listado Producto</h3>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                <thead class="bg-primary" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Precio Bs.</th>
                        <th>U. Medida</th>
                        <th>Categoria</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($productos['data'] as $producto)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/productos/' . $producto['img']) }}" class="rounded-circle" width="40" height="40">
                                <div class="ms-3">
                                    <b>{{ $producto['descripcion']}}</b>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if( $producto['tipo'] == 'PRODUCTO TERMINADO')
                                <span class="badge bg-primary rounded-3 fw-semibold" style="font-size: 10px;">{{ $producto['tipo']}}</span>
                            @elseif($producto['tipo'] == 'SEMITERMINADO')
                            <span class="badge bg-success rounded-3 fw-semibold" style="font-size: 10px;">{{ $producto['tipo']}}</span>
                            @else
                                <span class="badge bg-warning rounded-3 fw-semibold" style="font-size: 10px;">{{ $producto['tipo']}}</span>
                            @endif
                        </td>
                        <td>{{ $producto['precio']}}</td>
                        <td>{{ $producto['medida']}} <b>({{ $producto['av'] }})</b></td>
                        <td>{{ $producto['categoria']}}</td>
                        <td>
                            <center>
                                <a data-bs-toggle="modal" data-bs-target="#editar{{ $producto['codigo'] }}" title="Editar">
                                    <i class="text-primary" data-feather="edit-2"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#eliminar{{ $producto['codigo'] }}" title="Eliminar">
                                    <i class="text-danger" data-feather="trash-2"></i>
                                </a>
                            </center>
                        </td>

                        <!--Modal Editar-->
                        <div class="modal fade" id="editar{{ $producto['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-primary">
                                        <h3 class="modal-title fs-5 text-white">Editar - {{ $producto['descripcion'] }}</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('editar_producto', ['id' => $producto['codigo']]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Nombre</label>
                                                            <input type="text" name="nombre" class="form-control form-control-sm" value="{{ $producto['descripcion'] }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Precio</label>
                                                            <input type="number" name="precio" class="form-control form-control-sm" required step="0.01" min="0"  value="{{ $producto['precio'] }}"required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Categoría</label>
                                                            <input type="text" id="categoria-{{ $producto['codigo'] }}" name="categoria" value="{{ $producto['cod_cat'] }}" hidden>
                                                            <select id="select-categoria-{{ $producto['codigo'] }}" name="cat" class="selectpicker show-tick form-control form-control-sm" data-live-search="true" required>
                                                                @foreach ($categorias['data']  as $categoria)
                                                                    @if($categoria['codigo'] == $producto['cod_cat'])
                                                                        <option value="{{ $categoria['codigo'] }}" selected>{{ $categoria['descripcion'] }}</option>
                                                                    @else
                                                                        <option value="{{ $categoria['codigo'] }}">{{ $categoria['descripcion'] }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-xs-12 mb-1">
                                                        <label for="form-label">Cambiar de Imagen</label>
                                                        <input type="file" name="img" class="form-control form-control-sm" accept="image/*">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-xs-12">
                                                        <center>
                                                            <img src="{{ asset('img/productos/' . $producto['img']) }}" alt="img-producto" class="img-fluid rounded-3" width="250" height="250"/>
                                                        </center>
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
                        <div class="modal fade" id="eliminar{{ $producto['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h3 class="modal-title fs-5 text-white">Eliminar - {{ $producto['descripcion'] }}</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_producto', ['id' => $producto['codigo']]) }}" method="POST">
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
                    <h3 class="modal-title fs-5 text-white" id="exampleModalLabel">Agregar Producto</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guardar_producto') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">
                                    <label for="form-label">Tipo de Producto</label>
                                    <center>
                                        <div class="radio-img">
                                            <input type="radio" id="m_prima" name="tipo" value="1" required>
                                            <label for="m_prima">
                                                <img src="{{asset('img/icons/m_prima.png')}}" alt="Option 1">
                                            </label>
                                            <span class="badge bg-success rounded-3 fw-semibold" style="font-size: 10px;">Materia Prima</span>
                                        </div>
                                        <div class="radio-img">
                                            <input type="radio" id="p_semiterminado" name="tipo" value="3">
                                            <label for="p_semiterminado">
                                                <img src="{{asset('img/icons/semiterminado.png')}}" alt="Option 2">
                                            </label>
                                            <span class="badge bg-success rounded-3 fw-semibold" style="font-size: 10px;">Semi - Terminado</span>
                                        </div>
                                        <div class="radio-img">
                                            <input type="radio" id="p_terminado" name="tipo" value="2">
                                            <label for="p_terminado">
                                                <img src="{{asset('img/icons/bienes.png')}}" alt="Option 3">
                                            </label>
                                            <span class="badge bg-success rounded-3 fw-semibold" style="font-size: 10px;">Producto Terminado</span>
                                        </div>
                                    </center>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Nombre</label>
                                        <input type="text" name="nombre" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Unidad de Medida</label>
                                        <select id="medidaSelect" name="medida" class="form-select form-select-sm" required>
                                            <!-- Opciones se llenarán dinámicamente -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Categoría</label>
                                        <select name="categoria" class="selectpicker show-tick form-control form-control-sm" data-live-search="true" required>
                                            @foreach ($categorias['data']  as $categoria)
                                            <option value="{{ $categoria['codigo'] }}">{{ $categoria['descripcion'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Imagen del Producto</label>
                                        <input type="file" name="img" class="form-control form-control-sm" accept="image/*" required>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Precio</label>
                                        <input type="number" name="precio" class="form-control form-control-sm" step="0.01" min="0" required>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Stock Mínimo</label>
                                        <input type="number" id="stockMinimo" name="stock_m" class="form-control form-control-sm" min="0" required>
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
        document.addEventListener("DOMContentLoaded", function() {
            const medidaSelect = document.getElementById("medidaSelect");
            const radioMateriaPrima = document.getElementById("m_prima"); //1
            const radioProductoTerminado = document.getElementById("p_terminado"); //2
            const radioSemiTerminado = document.getElementById("p_semiterminado"); //3
            const unidadesMedida = @json($u_medidas['data']); // Obtén los datos de las unidades de medida desde el backend

            function actualizarMedidas() {
                const tipoSeleccionado = document.querySelector('input[name="tipo"]:checked').value;

                // Limpia el select de unidades de medida
                medidaSelect.innerHTML = '';

                unidadesMedida.forEach(medida => {
                    if (tipoSeleccionado === '1' && medida.codigo !== '9') {
                        // Si es Materia Prima, omite la unidad con código 9
                        addOption(medida);
                    } else if (tipoSeleccionado === '2' && medida.codigo === '9') {
                        // Si es Producto Terminado, solo muestra la unidad con código 9
                        addOption(medida);
                    } else if (tipoSeleccionado === '3') {
                        // Si es Semiterminado, muestra todas las unidades
                        addOption(medida);
                    } else if (tipoSeleccionado === '1' && medida.codigo === '9') {
                        // Si es Materia Prima, oculta la unidad con código 9
                        return;
                    } else if (tipoSeleccionado === '2' && medida.codigo !== '9') {
                        // Si es Producto Terminado, oculta otras unidades
                        return;
                    }
                });

                function addOption(medida) {
                    const option = document.createElement('option');
                    option.value = medida.codigo;
                    option.text = medida.descripcion;
                    medidaSelect.add(option);
                }

            }

            // Event listeners
            radioMateriaPrima.addEventListener("change", actualizarMedidas);
            radioProductoTerminado.addEventListener("change", actualizarMedidas);
            radioSemiTerminado.addEventListener("change", actualizarMedidas);

            // Carga inicial
            actualizarMedidas();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach($productos['data'] as $producto)
            document.getElementById('select-categoria-{{ $producto['codigo'] }}').addEventListener('change', function() {
                document.getElementById('categoria-{{ $producto['codigo'] }}').value = this.value;
            });
            @endforeach
        });
    </script>
@endpush

@stop
