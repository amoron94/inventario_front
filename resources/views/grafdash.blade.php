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
                            <h2 class="mt-1 mb-0"><b>2.382</b></h2>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-6">
                    <div class="card">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title">Ventas del Mes</h5>
                            <h2 class="mt-1 mb-0"><b>2.382</b></h2>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title">Ventas del Año</h5>
                            <h2 class="mt-1 mb-0"><b>2.382</b></h2>
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
                            <h2 class="mt-1 mb-0"><b>2.382</b></h2>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-6">
                    <div class="card">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title">Gastos del Mes</h5>
                            <h2 class="mt-1 mb-0"><b>2.382</b></h2>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <center>
                            <h5 class="card-title">Gastos del Año</h5>
                            <h2 class="mt-1 mb-0"><b>2.382</b></h2>
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
                    <div class="card" style="height: 300px">
                        <div class="card-body">
                            <center><h3 class="card-title">Tabla de Comisiones de Empleados por Semana</h3></center>

                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered table-hover align-middle">
                                    <thead class="bg-primary" style="font-size: 12px;">
                                        <tr class="text-white">
                                            <th>Nombre</th>
                                            <th>Comision</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 11px;">
                                        <tr>
                                            <td>Ximena Flores</td>
                                            <td>4306 <b>Bs.</b></td>
                                        </tr>
                                        <tr>
                                            <td>Ximena Flores</td>
                                            <td>4306 <b>Bs.</b></td>
                                        </tr>
                                        <tr>
                                            <td>Ximena Flores</td>
                                            <td>4306 <b>Bs.</b></td>
                                        </tr>
                                        <tr>
                                            <td>Ximena Flores</td>
                                            <td>4306 <b>Bs.</b></td>
                                        </tr>
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
                            <center><h3 class="card-title">Servicios mas Requeridos en el Mes</h3></center>

                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered table-hover align-middle">
                                    <thead class="bg-primary" style="font-size: 12px;">
                                        <tr class="text-white">
                                            <th>Servicio</th>
                                            <th>Cant. Realizado</th>
                                            <th>Cant. Recaudado (Bs.)</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 11px;">
                                        <tr>
                                            <td>Ximena Flores</td>
                                            <td>75</td>
                                            <td>4306 <b>Bs.</b></td>
                                        </tr>
                                        <tr>
                                            <td>Ximena Flores</td>
                                            <td>38</td>
                                            <td>4306 <b>Bs.</b></td>
                                        </tr>
                                        <tr>
                                            <td>Ximena Flores</td>
                                            <td>24</td>
                                            <td>4306 <b>Bs.</b></td>
                                        </tr>
                                        <tr>
                                            <td>Ximena Flores</td>
                                            <td>15</td>
                                            <td>4306 <b>Bs.</b></td>
                                        </tr>
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
                            <center><h3 class="card-title">Comparativa de Ganancias Anual</h3></center>

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
						display: false
					},
					cutoutPercentage: 70
				}
			});
		});
	</script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
                        data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                        barPercentage: .75,
                        categoryPercentage: .5
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
                                display: false
                            },
                            stacked: false,
                            ticks: {
                                stepSize: 20
                            }
                        }],
                        xAxes: [{
                            stacked: false,
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

