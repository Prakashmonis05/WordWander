<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Database connection
$conn = new mysqli("localhost", "root", "", "bookstore");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all orders for the user
$stmt = $conn->prepare("
    SELECT o.*, 
           COUNT(oi.id) as total_items,
           GROUP_CONCAT(b.title SEPARATOR '||') as book_titles
    FROM orders o
    LEFT JOIN order_items oi ON o.id = oi.order_id
    LEFT JOIN books b ON oi.book_id = b.id
    WHERE o.user_id = ?
    GROUP BY o.id
    ORDER BY o.order_date DESC
");
$stmt->bind_param("i", $userId);
$stmt->execute();
$orders = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Orders - WordWander</title>
    <!-- Use the special CSS file first to override Bootstrap styles -->
    <link rel="stylesheet" href="css/special-pages.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .order-card {
            transition: transform 0.2s;
        }
        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .status-badge {
            font-size: 0.9em;
            padding: 0.5em 1em;
        }
        .order-details {
            font-size: 0.95em;
        }
    </style>
</head>
<body style="background: #f5f7fa;">

    
    <div class="container py-5">
        <h2 class="mb-4">Your Orders</h2>
        
        <?php if ($orders->num_rows === 0): ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                You haven't placed any orders yet. 
                <a href="home.php" class="alert-link">Browse our collection</a>
            </div>
        <?php else: ?>
            <?php while ($order = $orders->fetch_assoc()): ?>
                <div class="card order-card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Order #<?php echo $order['id']; ?></h5>
                        <?php 
                        // Determine badge color based on status
                        $statusColor = 'bg-secondary';
                        $statusIcon = 'fa-clock';
                        
                        if ($order['status'] == 'confirmed') {
                            $statusColor = 'bg-success';
                            $statusIcon = 'fa-check-circle';
                        } elseif ($order['status'] == 'processing') {
                            $statusColor = 'bg-primary';
                            $statusIcon = 'fa-spinner';
                        } elseif ($order['status'] == 'shipped') {
                            $statusColor = 'bg-info';
                            $statusIcon = 'fa-shipping-fast';
                        } elseif ($order['status'] == 'delivered') {
                            $statusColor = 'bg-success';
                            $statusIcon = 'fa-box-open';
                        } elseif ($order['status'] == 'cancelled') {
                            $statusColor = 'bg-danger';
                            $statusIcon = 'fa-times-circle';
                        }
                        ?>
                        <span class="badge <?php echo $statusColor; ?> status-badge">
                            <i class="fas <?php echo $statusIcon; ?> me-1"></i>
                            <?php echo ucfirst($order['status']); ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <p><strong><i class="far fa-calendar-alt me-2"></i>Order Date:</strong> 
                                    <?php echo date('F j, Y', strtotime($order['order_date'])); ?>
                                </p>
                                <p><strong><i class="fas fa-book me-2"></i>Items:</strong> 
                                    <?php echo $order['total_items']; ?>
                                </p>
                                <p><strong><i class="fas fa-rupee-sign me-2"></i>Total Amount:</strong> 
                                    ₹<?php echo number_format($order['total_amount'], 2); ?>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong><i class="fas fa-shipping-fast me-2"></i>Shipping Address:</strong></p>
                                <?php 
                                $address_parts = explode(", ", $order['shipping_address']);
                                echo '<p class="ms-4 mb-0">' . htmlspecialchars($address_parts[0]) . '<br>';
                                echo htmlspecialchars($address_parts[1]) . '<br>';
                                echo htmlspecialchars($address_parts[2]) . ', ';
                                echo htmlspecialchars($address_parts[3]) . ' ';
                                echo htmlspecialchars($address_parts[4]) . '<br>';
                                echo 'Phone: ' . htmlspecialchars($address_parts[5]) . '</p>';
                                ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
