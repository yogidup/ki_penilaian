
// Bar Chart

var ctx = document.getElementById('profil-barChart').getContext('2d');

var labelBar = ['KOMUNIKASI', 'KEDISIPLINAN', 
                'KEANDALAN', 'KERAMAH - TAMAHAN', 'KERJASAMA TIM', 'KREATIVITAS & INOVATIF',
                'KESEHATAN DAN KESELAMATAN KERJA','PERILAKU BERSIH']
var dataBar =  [2, 4, 3, 2, 7, 4, 6, 2];

var myChart = new Chart(ctx, {

    type: 'bar',
    data: {
        labels: labelBar,
        datasets: [{
            label: 'Nilai',
            data:dataBar,
            backgroundColor: [
                '#FFE743',
                '#34FFD6',
                '#508FFF',
                '#FE4C4C',
                '#39FF8F',
                '#FB51EA',
                '#FFA736',
                '#9F40FF'
            ],
            borderColor: [
                '#FFE743',
                '#34FFD6',
                '#508FFF',
                '#FE4C4C',
                '#39FF8F',
                '#FB51EA',
                '#FFA736',
                '#9F40FF'
            ],
            borderWidth: 1
        }]
    },
    height : 900,
    options: {
        legend: {
            display: false
         },
        scales: {
            yAxes: [{
                gridLines: {
                    display:false
                },
                ticks: {
                    beginAtZero: true
                }
            }],
            xAxes: [{
                gridLines: {
                    display:false
                }   
            }]
        },
        responsive: true,
        maintainAspectRatio: false
    }
});

// End Bar Chart


// Pie Chart
var ctx1 = document.getElementById('profil-doughnut').getContext('2d');

var valuePie = 98; // <--- input value

var dataPie = {
    labels: ['Performa',''],
    datasets: [{
        label: '# of Votes',
        data: [valuePie,170-valuePie],
        backgroundColor: [
            '#fff',
            '#293EFF'
        ],
        borderColor: [
            '#fff',
            '#293EFF'
        ],
        borderWidth: 1
    }]
}

var myChart = new Chart(ctx1, {
    type: 'doughnut',
    data: dataPie,
    height : 900,
    options: {
        hover: {mode: null},
        legend: {
            display: false
         },
        cutoutPercentage : 69,
        scales: {
            yAxes: [{
                display: false,
                gridLines: {
                    display:false
                },
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        responsive: true,
        maintainAspectRatio: false,
        tooltips: false,
    }
});

$('.box-performa-numb span').html(valuePie)

