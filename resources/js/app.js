import './bootstrap';
import 'flowbite';
import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';

Chart.register(ChartDataLabels);
// Diagram Lingkaran: Penjualan Barang
const ctx1 = document.getElementById('BarangLarisChart').getContext('2d');
const BarangLarisChart = new Chart(ctx1, {
    type: 'pie',
    data: {
        datasets: [{
            data: [50, 30, 15, 5],
            backgroundColor: ['#0FADEC', '#E4BF27', '#E81810', '#E4BF27'],
            borderColor: ['#fff', '#fff', '#fff', '#fff'],
            borderWidth: 1
        }],
        labels: ['Produk A', 'Produk B', 'Produk C', 'Produk D']
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,  
                }
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw + ' unit';
                    }
                }
            },
            datalabels: {
                color: 'white',
                font: {
                    weight: 'bold',
                    size: 12
                },
                formatter: (value, context) => {
                    let total = context.dataset.data.reduce((acc, val) => acc + val, 0);
                    let percentage = (value / total * 100).toFixed(2); 
                    return percentage + '%';  
                }
            }
        }
    }
});

// Diagram Garis: Total Penjualan per Bulan
const ctx2 = document.getElementById('penjualanBulanChart').getContext('2d');
const penjualanBulanChart = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: Array.from({ length: 30 }, (_, i) => (i + 1).toString()),
        datasets: [{
            label: 'Penjualan Bulan Ini',
            data: [167, 178, 98, 76, 66, 52, 63, 80, 70, 201, 154, 128, 190, 142, 110, 187, 125, 155, 85, 103, 206, 115, 120, 182, 161, 136, 82, 121, 173, 142]
            ,
            fill: false,
            backgroundColor: '#0FADEC',
            borderColor: '#0FADEC',
            tension: 0.1
        },
        {
            label: 'Penjualan Bulan Lalu',
            data: [109, 82, 88, 101, 120, 91, 133, 202, 190, 205, 56, 114, 160, 90, 124, 147, 194, 61, 52, 210, 151, 142, 205, 158, 124, 204, 55, 216, 111, 141]
            ,
            fill: false,
            backgroundColor: '#E4BF27',
            borderColor: '#E4BF27',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true, 
                    pointStyle: 'rect',  
                }
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.dataset.label + ': Rp ' + tooltipItem.raw.toLocaleString();
                    }
                }
            },
            datalabels: {
                display: false
            }
        }
    }
});
