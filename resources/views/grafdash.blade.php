@extends('dashboard')

@section('card')

<?php $usuario = session('usuario_logueado'); ?>

@if($usuario['data']['dias'] <= 20)
<div class="row">
    <div class="col-xl-12 col-xxl-5 d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card animate__animated animate__fadeInRightBig" style="background: #b10c1c">
                        <div class="card-body">
                            <center>

                                <h3 style="color: #ffffff; font-weight: bold;">¡Tu suscripción está por vencer!</h3>

                                <h2 style="color: #ffffff">Solo te quedan <strong>{{$usuario['data']['dias']}} días</strong> antes de que tu suscripción expire.</h2>

                                <p style="color: #ffffff; font-size: 16px;">
                                    Asegúrate de renovar para seguir disfrutando de nuestros servicios sin interrupciones.
                                </p>

                                <a href="{{ url('reactivar') }}" class="btn btn-light mt-3" style="color: #b10c1c">Renovar Ahora</a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-xl-12 col-xxl-5 d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-4 col-6">
                    <div class="card animate__animated animate__slideInDown" style="background: #d5f1d5">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title" style="color: #008000">Ventas del Dia</h5>
                            <h2 class="mt-1 mb-0"><b>{{$ventas['dia']}} Bs.</b></h2>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-6">
                    <div class="card animate__animated animate__slideInDown" style="background: #d5f1d5">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title" style="color: #008000">Ventas del Mes</h5>
                            <h2 class="mt-1 mb-0"><b>{{$ventas['mes']}} Bs.</b></h2>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="card animate__animated animate__slideInDown" style="background: #d5f1d5">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title" style="color: #008000">Ventas del Año</h5>
                            <h2 class="mt-1 mb-0"><b>{{$ventas['ano']}} Bs.</b></h2>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-xxl-5 d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-4 col-6">
                    <div class="card animate__animated animate__slideInUp" style="background: #ffcdc5">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title" style="color: #b10c1c">Gastos del Dia</h5>
                            <h2 class="mt-1 mb-0"><b>{{$compras['dia'] + $compras['gdia']}} Bs.</b></h2>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-6">
                    <div class="card animate__animated animate__slideInUp" style="background: #ffcdc5">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title" style="color: #b10c1c">Gastos del Mes</h5>
                            <h2 class="mt-1 mb-0"><b>{{$compras['mes'] + $compras['gmes']}} Bs.</b></h2>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="card animate__animated animate__slideInUp" style="background: #ffcdc5">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title" style="color: #b10c1c">Gastos del Año</h5>
                            <h2 class="mt-1 mb-0"><b>{{$compras['ano'] + $compras['gano']}} Bs.</b></h2>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-xxl-5 d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body" style="height: 299px">
                            <center><h3 class="card-title">Servicios mas Requeridos en el Mes</h3></center>

                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered table-hover align-middle">
                                    <thead class="bg-colorbase" style="font-size: 12px;">
                                        <tr class="text-white">
                                            <th>Servicio</th>
                                            <th style="width: 25%">Cant. Realizado</th>
                                            <th>Cant. Recaudado (Bs.)</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 11px;">
                                        @foreach($productos['data'] as $producto)
                                        <tr>
                                            <td>{{ $producto['producto']}}</td>
                                            <td class="text-danger">{{ $producto['total_cantidad']}}</td>
                                            <td>{{ $producto['total_monto']}} <b>Bs.</b></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <center><h3 class="card-title">Metodo de Pago mas Utilizado del Mes</h3></center>

                            <div class="align-self-center w-100">
                                <div class="py-3">
                                    <div class="chart chart-xs"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                        <canvas id="chartjs-dashboard-pie-pago" width="345" height="150" style="display: block; width: 345px; height: 150px;" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-xxl-5 d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <center><h3 class="card-title">Movimientos del año Actual</h3></center>

                            <div class="align-self-center w-100">
                                <div class="py-3">
                                    <div class="chart chart-sm"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
										<canvas id="chartjs-dashboard-line" style="display: block; width: 656px; height: 250px;" width="1312" height="500" class="chartjs-render-monitor"></canvas>
									</div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-xxl-5 d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <center><h3 class="card-title">Comparativa de Ventas Mensuales</h3></center>

                            <div class="align-self-center chart chart-lg"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="chartjs-dashboard-bar" width="748" height="350" style="display: block; width: 748px; height: 350px;" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obteniendo los datos desde PHP a JavaScript
            const vmeses = @json($vmeses['data']);

            // Convirtiendo el objeto `vmeses` en un array con los valores ordenados del 1 al 12
            const ventasMensuales = [];
            for (let mes = 1; mes <= 12; mes++) {
                ventasMensuales.push(vmeses[mes]);
            }

            // Obteniendo los datos desde PHP a JavaScript
            const cmeses = @json($cmeses['data']);

            // Convirtiendo el objeto `vmeses` en un array con los valores ordenados del 1 al 12
            const comprasMensuales = [];
            for (let mes = 1; mes <= 12; mes++) {
                comprasMensuales.push(cmeses[mes]);
            }

            var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");

            // Gradiente de verde oscuro a verde claro
            var gradientLight = ctx.createLinearGradient(0, 0, 0, 225);
            gradientLight.addColorStop(0, "rgba(0, 128, 0, 1)"); // Verde oscuro (inicio)
            gradientLight.addColorStop(1, "rgba(144, 238, 144, 0)"); // Verde claro desvanecido a transparente (fin)


            var gradientDark = ctx.createLinearGradient(0, 0, 0, 225);
            gradientDark.addColorStop(0, "rgba(220, 53, 69, 1)"); // Rojo (Bootstrap Danger)
            gradientDark.addColorStop(1, "rgba(255, 159, 64, 0)"); // Naranja (Color degradado a transparente)

            // Line chart with two datasets
            new Chart(document.getElementById("chartjs-dashboard-line"), {
                type: "line",
                data: {
                    labels: ["Enero", "Febrero", "Mar", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    datasets: [
                        {
                            label: "Ventas (Bs)",
                            fill: true,
                            backgroundColor: gradientLight,
                            borderColor: 'rgba(0, 128, 0, 1)',
                            data: ventasMensuales
                        },
                        {
                            label: "Compras (Bs)",
                            fill: true,
                            backgroundColor: gradientDark,
                            borderColor: window.theme.danger,
                            data: comprasMensuales
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: true
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: true
                        }
                    },
                    scales: {
                        xAxes: [{
                            stacked: true,
                            gridLines: {
                                display: true
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 1000
                            },
                            display: true,
                            borderDash: [5, 5],
                            gridLines: {
                                display: true
                            },
                        }]
                    }
                }
            });
        });
    </script>

    <script>
        // Obteniendo los datos desde PHP a JavaScript
        const tpagos = @json($tpagos['data']);

        // Extraer labels y data de los tipos de pago
        const labels = tpagos.map(item => item.tipo_pago);
        const data = tpagos.map(item => parseFloat(item.total_monto));

        document.addEventListener("DOMContentLoaded", function() {
            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie-pago"), {
                type: "pie",
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: [
                            "#4CAF50",
                            window.theme.primary,
                            "#E8EAED"
                        ],
                        borderWidth: 5,
                        borderColor: window.theme.white
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    legend: {
                        display: true
                    },
                    cutoutPercentage: 0
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Obteniendo los datos desde PHP a JavaScript
            const vmeses = @json($vmeses['data']);

            // Convirtiendo el objeto `vmeses` en un array con los valores ordenados del 1 al 12
            const ventasMensuales = [];
            for (let mes = 1; mes <= 12; mes++) {
                ventasMensuales.push(vmeses[mes]);
            }

            console.log(ventasMensuales);

            // Bar chart
            new Chart(document.getElementById("chartjs-dashboard-bar"), {
                type: "bar",
                data: {
                    labels: ["Enero", "Febrero", "Mar", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    datasets: [{
                        label: "Bs.",
                        backgroundColor: window.theme.primary,
                        borderColor: window.theme.primary,
                        hoverBackgroundColor: window.theme.primary,
                        hoverBorderColor: window.theme.primary,
                        data: ventasMensuales,
                        barPercentage: .9,
                        categoryPercentage: .6
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: true
                            },
                            stacked: false,
                            ticks: {
                                stepSize: 500
                            }
                        }],
                        xAxes: [{
                            stacked: true,
                            gridLines: {
                                color: "transparent"
                            }
                        }]
                    }
                }
            });
        });
    </script>

@endpush

