<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "bookstore");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// Get book ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$bookId = (int)$_GET['id'];

// Fetch book details
$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $bookId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: index.php");
    exit();
}

$book = $result->fetch_assoc();

// Handle Buy Now action
if (isset($_POST['buy_now'])) {
    if (!$isLoggedIn) {
        header("Location: login.php?redirect=book_details.php?id=" . $bookId);
        exit();
    }
    
    $_SESSION['pending_order'] = [
        'book_id' => $bookId,
        'quantity' => isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1,
        'price' => $book['price'],
        'title' => $book['title'],
        'image' => $book['image']
    ];
    
    header("Location: checkout.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($book['title']); ?> - Word Wander</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <img src="images/<?php echo htmlspecialchars($book['image']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($book['title']); ?>">
            </div>
            <div class="col-md-8">
                <h1><?php echo htmlspecialchars($book['title']); ?></h1>
                <p class="text-muted">by <?php echo htmlspecialchars($book['author']); ?></p>
                
                <div class="my-4">
                    <span class="h3 text-danger">₹<?php echo number_format($book['price'], 2); ?></span>
                    <?php if ($book['original_price'] > $book['price']): ?>
                        <span class="text-decoration-line-through text-muted">₹<?php echo number_format($book['original_price'], 2); ?></span>
                        <span class="badge bg-success">Save <?php echo round(($book['original_price'] - $book['price']) / $book['original_price'] * 100); ?>%</span>
                    <?php endif; ?>
                </div>
                
                <form method="post">
                    <div class="mb-3 w-25">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <select name="quantity" id="quantity" class="form-select">
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    
                    <button type="submit" name="buy_now" class="btn btn-primary btn-lg">
                        <i class="fas fa-bolt"></i> Buy Now
                    </button>
                    
                    <button type="submit" name="add_to_cart" class="btn btn-outline-secondary btn-lg ms-2">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>