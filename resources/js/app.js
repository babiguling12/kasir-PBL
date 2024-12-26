import './bootstrap';
import 'flowbite';
import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';

//BackgroundColour
function generateColors(count) {
    const colors = [];
    for (let i = 0; i < count; i++) {
        // Generate random colors
        const color = `hsl(${Math.floor(Math.random() * 360)}, 70%, 50%)`;
        colors.push(color);
    }
    return colors;
}

Chart.register(ChartDataLabels);
// Diagram Lingkaran: Penjualan Barang
if(window.SalesData){
    const dynamicColors = generateColors(window.SalesData.length);
    const labels = window.SalesData.map(item => item.nama_produk); 
    const data = window.SalesData.map(item => item.terjual); 

const ctx1 = document.getElementById('BarangLarisChart').getContext('2d');
const BarangLarisChart = new Chart(ctx1, {
    type: 'pie',
    data: {
        datasets: [{
            data: data,
            backgroundColor: dynamicColors,
            borderColor: dynamicColors.map(() => '#fff'),
            borderWidth: 1
        }],
        labels: labels
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
                display: true,
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
})
};

// Diagram Garis: Total Penjualan per Bulan
if(window.MonthSales){
    const thisYearData = Object.values(window.MonthSales.thisYear).map(item => parseFloat(item.total_revenue));
    const lastYearData = Object.values(window.MonthSales.lastYear).map(item => parseFloat(item.total_revenue));
    
const ctx2 = document.getElementById('penjualanBulanChart').getContext('2d');
const penjualanBulanChart = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: Array.from({ length: 12 }, (_, i) => (i + 1).toString()),
        datasets: [{
            label: 'Penjualan Tahun Ini',
            data: thisYearData,
            backgroundColor: '#0FADEC',
            borderColor: '#0FADEC',
            tension: 0.1
        },
        {
            label: 'Penjualan Tahun Lalu',
            data:lastYearData,
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
                        const revenue = tooltipItem.raw.toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0
                        });
                        return `${tooltipItem.dataset.label}: ${revenue}`;
                    }
                }
            },
            datalabels: {
                display: false
            }
        }
    }
})

};
