// Mã tạo biểu đồ với Chart.js
window.onload = function() {
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar', // Loại biểu đồ, ở đây là biểu đồ cột
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'], // Các nhãn cho trục X
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: [100, 150, 200, 250, 300], // Dữ liệu doanh thu
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Đảm bảo trục Y bắt đầu từ 0
                }
            }
        }
    });
};
