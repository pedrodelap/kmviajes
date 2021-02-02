

var configLine = {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Solicitudes',
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ],
            fill: false,
        }, {
            label: 'Ventas',
            fill: false,
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ],
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: false,
            text: 'Chart.js Line Chart'
        },
        legend: {
            display: false
        },
        layout: {
            padding: {
                left: 10,
                right: 10,
                top: 10,
                bottom: 0
            }
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        pointBackgroundColor: '#fff',
        pointBorderColor: window.chartColors.blue,
        pointBorderWidth: '2',
        scales: {
            xAxes: [{
                display: false,
                scaleLabel: {
                    display: true,
                    labelString: 'Mes'
                }
            }],
            yAxes: [{
                display: false,
                scaleLabel: {
                    display: true,
                    labelString: 'Valor'
                }
            }]
        }
    }
};

$(document).ready(function () {
    loadDataGraficoDashboard();

    var barChartData = {
        labels: ['Octubre', 'Noviembre', 'Diciembre', 'Enero'],
        datasets: [{
            label: 'Registrado',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: [
                2,
                5,
                4,
                16

            ]
        }, {
            label: 'Cotizada',
            backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: [
                2,
                3,
                4,
                14
            ]
        },
        {
            label: 'Reservada',
            backgroundColor: color(window.chartColors.orange).alpha(0.5).rgbString(),
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: [
                2,
                3,
                2,
                14
            ]
        }, {
            label: 'Pagada',
            backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: [
                2,
                3,
                2,
                12
            ]
        }
        ]

    };

    if (document.getElementById('canvas')) {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Grafico'
                }
            }
        });
    }

});

function loadDataGraficoDashboard() {
    var formPago = new FormData();


    formPago.append("grafico", true);
    $.ajax({

        url: "ajax/ajax.reporte.php",
        method: "POST",
        data: formPago,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "text",
        beforeSend: function () {
            $("#loading-backend").show();
        },
        success: function (data) {
            $("#loading-backend").hide();

            var respuesta = JSON.parse(data);

            var labels = []
            $(respuesta).each(function (index, value) {
                labels.push(value["month"])
            });

            var data1 = []
            $(respuesta).each(function (index, value) {
                data1.push(value["qSolicitud"])
            });


            var data2 = []
            $(respuesta).each(function (index, value) {
                data2.push(value["qVentas"])
            });


            configLine.data.labels = labels;
            configLine.data.datasets[0].data = data1;
            configLine.data.datasets[1].data = data2;

            console.info(configLine);
            if (document.getElementById('solicitud-ventas-grafico')) {
                var ctx5 = document.getElementById('solicitud-ventas-grafico').getContext('2d');
                window.myLine = new Chart(ctx5, configLine);
            }


        }

    });
}
