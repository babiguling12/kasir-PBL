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

Livewire.on('filter-changed', (event) => {
    const salesData = event.salesData;

    console.log('Sales Data:', salesData.length);
    if (salesData && salesData.length > 0) {
        const dynamicColors = generateColors(salesData.length);

        // sorting top 5
        const sortedSalesData = salesData
            .sort((a, b) => b.terjual - a.terjual)
            .slice(0, 5); 

        const labels = sortedSalesData.map(item => item.nama_produk);
        const data = sortedSalesData.map(item => item.terjual);

        const ctx1 = document.getElementById('BarangLarisChart').getContext('2d');

        // If a chart already exists, destroy it
        if (window.BarangLarisChart instanceof Chart) {
            window.BarangLarisChart.destroy();
        }

        window.BarangLarisChart = new Chart(ctx1, {
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
                            let valueAsNumber = parseFloat(value);
                            let total = context.dataset.data.reduce((acc, val) => acc + parseFloat(val), 0);

                            if (total === 0) {
                                return '0%';
                            }
                            let percentage = ((valueAsNumber / total) * 100).toFixed(2);

                            return percentage + '%';
                        }
                    }
                }
            }
        });
    } else if (salesData.length === 0) {
        const chartContainer = document.getElementById('BarangLarisChart').parentElement;
        if (chartContainer) {
            chartContainer.innerHTML = '<p class="text-center text-gray-500">No data available</p>';
        }
    }
});




// Diagram Garis: Total Penjualan per Bulan
if (window.MonthSales) {
    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    const thisYearData = monthNames.map((month, index) => {
        const monthKey = (index + 1).toString();
        //mengecek index single digit dan double digit
        const data = window.MonthSales.thisYear[monthKey] || window.MonthSales.thisYear[monthKey.padStart(2, '0')];
        return data ? parseFloat(data.total_revenue) : 0; 
    });
    
    const lastYearData = monthNames.map((month, index) => {
        const monthKey = (index + 1).toString();
        const data = window.MonthSales.lastYear[monthKey] || window.MonthSales.lastYear[monthKey.padStart(2, '0')];
        return data ? parseFloat(data.total_revenue) : 0; 
    });

    // Chart.js configuration
    const ctx2 = document.getElementById('penjualanBulanChart').getContext('2d');
    const penjualanBulanChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: monthNames, 
            datasets: [
                {
                    label: 'Penjualan Tahun Ini',
                    data: thisYearData,
                    backgroundColor: '#0FADEC',
                    borderColor: '#0FADEC',
                    
                },
                {
                    label: 'Penjualan Tahun Lalu',
                    data: lastYearData,
                    backgroundColor: '#E4BF27',
                    borderColor: '#E4BF27',
            
                }
            ]
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
                        pointStyle: 'rect'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
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
    });
};


