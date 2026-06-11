<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if($title === 'Quản lý chỉ số nước')
            const tempCtx = document.getElementById('waterAirTempChart').getContext('2d');
            new Chart(tempCtx, {
                type: 'line',
                data: {
                    labels: {!! isset($chartLabels) ? json_encode($chartLabels) : "['01/06', '02/06', '03/06', '04/06', '05/06', '06/06', '07/06', '08/06', '09/06', '10/06']" !!},
                    datasets: [
                        {
                            label: 'Nhiệt độ nước (°C)',
                            data: {!! isset($waterTempData) ? json_encode($waterTempData) : '[27.5, 28.0, 27.2, 28.5, 29.0, 28.8, 27.9, 28.1, 28.6, 28.3]' !!},
                            borderColor: '#4f46e5',
                            backgroundColor: 'rgba(79, 70, 229, 0.08)',
                            fill: true,
                            tension: 0.3,
                            borderWidth: 2.5,
                            pointBackgroundColor: '#4f46e5',
                        },
                        {
                            label: 'Nhiệt độ không khí (°C)',
                            data: {!! isset($airTempData) ? json_encode($airTempData) : '[31.2, 32.0, 30.5, 33.1, 34.0, 32.5, 31.8, 32.2, 33.5, 32.9]' !!},
                            borderColor: '#f59e0b',
                            backgroundColor: 'transparent',
                            tension: 0.3,
                            borderWidth: 2,
                            pointBackgroundColor: '#f59e0b',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: { color: '#64748b', font: { size: 10, weight: '600' } }
                        }
                    },
                    scales: {
                        y: { ticks: { color: '#94a3b8', font: { size: 9 } }, grid: { color: '#f1f5f9' } },
                        x: { ticks: { color: '#94a3b8', font: { size: 9 } }, grid: { display: false } }
                    }
                }
            });
        @endif

        @if($title === 'Chi phí vận hành')
            const costCtx = document.getElementById('expenseDistributionChart').getContext('2d');
            new Chart(costCtx, {
                type: 'bar',
                data: {
                    labels: ['Điện & Năng lượng', 'Lương nhân sự', 'Nhiên liệu', 'Bảo trì ao', 'Khác'],
                    datasets: [{
                        label: 'Số tiền (VND)',
                        data: [54200000, 65000000, 10800000, 14500000, 8000000],
                        backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#ec4899', '#94a3b8'],
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { ticks: { color: '#94a3b8', font: { size: 9 } }, grid: { color: '#f1f5f9' } },
                        x: { ticks: { color: '#94a3b8', font: { size: 9 } }, grid: { display: false } }
                    }
                }
            });
        @endif
    });
</script>
