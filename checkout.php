<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if there's a pending order
if (!isset($_SESSION['pending_order'])) {
    header("Location: index.php");
    exit();
}

$order = $_SESSION['pending_order'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input
    $errors = [];
    
    $requiredFields = ['name', 'address', 'city', 'state', 'zip', 'phone', 'payment_method'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst($field) . " is required";
        }
    }
    
    if (empty($errors)) {
        // Process the order
        $conn = new mysqli("localhost", "root", "", "bookstore");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $userId = $_SESSION['user_id'];
        $totalAmount = $order['price'] * $order['quantity'];
        
        // Create shipping address string
        $shipping_address = implode(", ", [
            $_POST['name'],
            $_POST['address'],
            $_POST['city'],
            $_POST['state'],
            $_POST['zip'],
            $_POST['phone']
        ]);
        
        // Insert order
        $stmt = $conn->prepare("INSERT INTO orders (user_id, book_id, quantity, total_amount, shipping_address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiids", $userId, $order['book_id'], $order['quantity'], $totalAmount, $shipping_address);
        $stmt->execute();
        $orderId = $stmt->insert_id;
        
        // Insert order item
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, book_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $orderId, $order['book_id'], $order['quantity'], $order['price']);
        $stmt->execute();
        
        $conn->close();
        
        // Clear pending order
        unset($_SESSION['pending_order']);
        
        // Redirect to confirmation
        header("Location: order_confirmation.php?order_id=" . $orderId);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Word Wander</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <h2>Checkout</h2>
                
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <form method="post">
                    <h4 class="mt-4">Shipping Information</h4>
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required 
                               value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required><?php 
                            echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; 
                        ?></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required
                                   value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : ''; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="state" required
                                   value="<?php echo isset($_POST['state']) ? htmlspecialchars($_POST['state']) : ''; ?>">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="zip" class="form-label">ZIP Code</label>
                            <input type="text" class="form-control" id="zip" name="zip" required
                                   value="<?php echo isset($_POST['zip']) ? htmlspecialchars($_POST['zip']) : ''; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required
                                   value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                        </div>
                    </div>
                    
                    <h4 class="mt-4">Payment Method</h4>
                    <div class="mb-3">
                        <select class="form-select" name="payment_method" required>
                            <option value="">Select Payment Method</option>
                            <option value="cod" <?php echo (isset($_POST['payment_method']) && $_POST['payment_method'] === 'cod') ? 'selected' : ''; ?>>Cash on Delivery</option>
                            <option value="credit_card" <?php echo (isset($_POST['payment_method']) && $_POST['payment_method'] === 'credit_card') ? 'selected' : ''; ?>>Credit Card</option>
                            <option value="upi" <?php echo (isset($_POST['payment_method']) && $_POST['payment_method'] === 'upi') ? 'selected' : ''; ?>>UPI</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg">Place Order</button>
                </form>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <img src="images/<?php echo htmlspecialchars($order['image']); ?>" class="img-thumbnail me-3" style="width: 80px; height: auto;">
                            <div>
                                <h6><?php echo htmlspecialchars($order['title']); ?></h6>
                                <p>Quantity: <?php echo $order['quantity']; ?></p>
                                <p>₹<?php echo number_format($order['price'], 2); ?> each</p>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>₹<?php echo number_format($order['price'] * $order['quantity'], 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span>FREE</span>
                        </div>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total:</span>
                            <span>₹<?php echo number_format($order['price'] * $order['quantity'], 2); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>