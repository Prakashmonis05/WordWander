<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "bookstore");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get statistics
$result = $conn->query("SELECT COUNT(*) as total FROM books");
$total_books = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT COUNT(*) as total FROM orders WHERE status='pending'");
$pending_orders = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT COUNT(*) as total FROM users");
$total_users = $result->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - WordWander</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">WordWander Admin</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Total Books</h5>
                        <h2><?php echo $total_books; ?></h2>
                        <a href="manage_books.php" class="btn btn-light mt-2">Manage Books</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <h5>Pending Orders</h5>
                        <h2><?php echo $pending_orders; ?></h2>
                        <a href="manage_orders.php" class="btn btn-dark mt-2">View Orders</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Total Users</h5>
                        <h2><?php echo $total_users; ?></h2>
                        <a href="manage_users.php" class="btn btn-light mt-2">Manage Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>