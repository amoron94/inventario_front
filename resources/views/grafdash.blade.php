@extends('dashboard')

@section('card')

<div class="row">
    <div class="col-xl-12 col-xxl-5 d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-4 col-6">
                    <div class="card">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title">Ventas del Dia</h5>
                            <h2 class="mt-1 mb-0"><b>{{$ventas['dia']}} Bs.</b></h2>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-6">
                    <div class="card">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title">Ventas del Mes</h5>
                            <h2 class="mt-1 mb-0"><b>{{$ventas['mes']}} Bs.</b></h2>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title">Ventas del Año</h5>
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
                    <div class="card">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title">Gastos del Dia</h5>
                            <h2 class="mt-1 mb-0"><b>{{$compras['dia'] + $compras['gdia']}} Bs.</b></h2>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-6">
                    <div class="card">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title">Gastos del Mes</h5>
                            <h2 class="mt-1 mb-0"><b>{{$compras['mes'] + $compras['gmes']}} Bs.</b></h2>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title">Gastos del Año</h5>
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
                        <div class="card-body">
                            <center><h3 class="card-title">Grafico de Comisiones de Empleados por Semana</h3></center>

                            <div class="align-self-center w-100">
                                <div class="py-3">
                                    <div class="chart chart-xs"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                        <canvas id="chartjs-dashboard-pie" width="345" height="150" style="display: block; width: 345px; height: 150px;" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <center><h3 class="card-title">Metodo de Pago mas Utilizado</h3></center>

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
                            <center><h3 class="card-title">Servicios mas Requeridos en el Mes</h3></center>

                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered table-hover align-middle">
                                    <thead class="bg-primary" style="font-size: 12px;">
                                        <tr class="text-white">
                                            <th>Servicio</th>
                                            <th style="width: 15%">Cant. Realizado</th>
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
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: ["Ximena", "Karla", "Lucia", "Sthefani"],
					datasets: [{
						data: [4306, 3801, 1689, 3251],
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger,
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
                            window.theme.success,
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

