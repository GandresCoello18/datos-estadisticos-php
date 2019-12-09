var ctx = document.getElementById('primero').getContext('2d');
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],
            datasets: [{
                label: 'Multas por mes',
                backgroundColor: ['rgb(255, 99, 132)', 'rgb(235, 9, 37)', 'rgb(183, 199, 132)', 'rgb(72, 39, 132)', 'rgb(25, 199, 232)', 'rgb(25, 99, 132)', 'rgb(250, 190, 13)', 'rgb(200, 89, 232)', 'rgb(255, 99, 132)', 'rgb(255, 99, 232)', 'rgb(25, 99, 12)', 'rgb(255, 99, 132)'],
                borderColor: 'rgb(255, 99, 132)',
                data: [30, 20, 45, 12, 30, 50, 25, 83, 23, 44, 74, 55]
            }]
        },
        options:{
            scales: {
                xAxes: [{
                    gridLines: {
                        offsetGridLines: true
                    }
                }]
            }
        }
    });
    ///////////////////////////////////
    var ctx_2 = document.getElementById('segundo').getContext('2d');
    var myPieChart = new Chart(ctx_2, {
        type: 'pie',
        data: {
            labels: ['2016','2017', '2018', '2019'],
            datasets: [{
                label: 'Datos por año',
                backgroundColor: ['rgba(220, 30, 210)', 'rgba(120, 130, 210)', 'rgba(20, 180, 90)', 'rgba(20, 230, 10)'],
                borderColor: '',
                data: [40, 20, 40, 60]
            }]
        },
        options:{
            scales: {
                xAxes: [{
                    gridLines: {
                        offsetGridLines: true
                    }
                }]
            }
        }
    });
