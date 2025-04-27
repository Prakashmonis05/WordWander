<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation - Word Wander</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 mb-5">
        <h2 class="mb-4">Thank you for your purchase!</h2>
        <div class="card shadow p-4 mb-4">
            <h5>Order ID: <strong>#<?php echo $order['id']; ?></strong></h5>
            <p>Status: <span class="badge bg-warning text-dark"><?php echo ucfirst($order['status']); ?></span></p>
            <p>Total Amount: <strong>₹<?php echo number_format($order['total_amount'], 2); ?></strong></p>
            
            <div class="mt-4">
                <h6>Delivery Address:</h6>
                <p><?php echo htmlspecialchars($order['name']); ?><br>
                <?php echo htmlspecialchars($order['address']); ?><br>
                <?php echo htmlspecialchars($order['city']) . ', ' . htmlspecialchars($order['state']) . ' - ' . htmlspecialchars($order['zip']); ?><br>
                Phone: <?php echo htmlspecialchars($order['phone']); ?></p>
                
                <h6>Payment Method:</h6>
                <p><?php echo strtoupper($order['payment_method']); ?></p>
            </div>
        </div>

        <div class="row">
            <?php while ($item = $items->fetch_assoc()): ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="images/<?php echo $item['image']; ?>" class="img-fluid rounded-start" alt="<?php echo $item['title']; ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $item['title']; ?></h5>
                                    <p class="card-text">Quantity: <?php echo $item['quantity']; ?></p>
                                    <p class="card-text">Price per unit: ₹<?php echo number_format($item['price'], 2); ?></p>
                                    <p class="card-text">Subtotal: ₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="text-center mt-4">
            <a href="home.php" class="btn btn-success">Continue Shopping</a>
        </div>
    </div>
</body>
</html>