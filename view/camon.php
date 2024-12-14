<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảm ơn bạn đã đặt hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f0f4f7;
        font-family: 'Arial', sans-serif;
    }

    .thank-you-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .thank-you-card {
        padding: 40px;
        border-radius: 15px;
        background-color: white;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        text-align: center;
        max-width: 600px;
        width: 100%;
    }

    .thank-you-card h1 {
        color: #28a745;
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .thank-you-card p {
        font-size: 1.3rem;
        margin-bottom: 30px;
        color: #6c757d;
    }

    .btn-primary {
        font-size: 1.2rem;
        padding: 12px 20px;
        border-radius: 30px;
    }

    .btn-secondary {
        font-size: 1.2rem;
        padding: 12px 20px;
        border-radius: 30px;
    }

    .thank-you-card img {
        width: 100px;
        height: 100px;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <div class="thank-you-container">
        <div class="thank-you-card">
            <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Success Icon">
            <h1>Cảm ơn bạn đã đặt hàng!</h1>
            <p>Chúng tôi rất trân trọng sự ủng hộ của bạn. Đơn hàng của bạn đang được xử lý và sẽ giao trong thời gian
                sớm nhất.</p>
            <a href="index.php?act=ctdonhang" class="btn btn-primary">Xem đơn hàng của bạn</a>
            <a href="index.php" class="btn btn-secondary">Quay về trang chủ</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>