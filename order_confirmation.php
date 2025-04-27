<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if order ID is provided
if (!isset($_GET['order_id'])) {
    header("Location: index.php");
    exit();
}

$orderId = (int)$_GET['order_id'];
$userId = $_SESSION['user_id'];

// Fetch order details
$conn = new mysqli("localhost", "root", "", "bookstore");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $orderId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php");
    exit();
}

$order = $result->fetch_assoc();

// Fetch order items
$stmt = $conn->prepare("SELECT oi.*, b.title, b.image FROM order_items oi JOIN books b ON oi.book_id = b.id WHERE oi.order_id = ?");
$stmt->bind_param("i", $orderId);
$stmt->execute();
$items = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation - Word Wander</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
   
    
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h1 class="text-success"><i class="fas fa-check-circle"></i> Order Confirmed!</h1>
            <p class="lead">Thank you for your purchase. Your order has been placed successfully.</p>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <h4>Order #<?php echo $order['id']; ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Order Details</h5>
                        <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($order['order_date'])); ?></p>
                        <p><strong>Total Amount:</strong> ₹<?php echo number_format($order['total_amount'], 2); ?></p>
                    </div>
                    <div class="col-md-6">
                        <h5>Shipping Address</h5>
                        <p><?php 
                        $address_parts = explode(", ", $order['shipping_address']);
                        echo htmlspecialchars($address_parts[0]); ?><br>
                        <?php echo htmlspecialchars($address_parts[1]); ?><br>
                        <?php echo htmlspecialchars($address_parts[2]); ?>, 
                        <?php echo htmlspecialchars($address_parts[3]); ?> 
                        <?php echo htmlspecialchars($address_parts[4]); ?><br>
                        Phone: <?php echo htmlspecialchars($address_parts[5]); ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <h4 class="mb-3">Items Ordered</h4>
        <?php while ($item = $items->fetch_assoc()): ?>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="images/<?php echo htmlspecialchars($item['image']); ?>" class="img-fluid rounded-start" alt="<?php echo htmlspecialchars($item['title']); ?>">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['title']); ?></h5>
                            <p class="card-text">Quantity: <?php echo $item['quantity']; ?></p>
                            <p class="card-text">Price: ₹<?php echo number_format($item['price'], 2); ?></p>
                            <p class="card-text"><strong>Subtotal: ₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        
        <div class="text-center mt-4">
            <a href="home.php" class="btn btn-primary">Continue Shopping</a>
            <a href="order.php" class="btn btn-outline-secondary ms-2">View Order History</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>