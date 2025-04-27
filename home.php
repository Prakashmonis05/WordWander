<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Session start to maintain login state
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Fetch books from database
function getBooksByCategory($conn, $category) {
    $sql = "SELECT * FROM books WHERE category = '$category' LIMIT 10";
    $result = $conn->query($sql);
    
    $books = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
    }
    return $books;
}

// Get books for each category
$collectionsBooks = getBooksByCategory($conn, "Programming","Finance","general Knowledge");
$programmingBooks = getBooksByCategory($conn, "Programming");
$financeBooks = getBooksByCategory($conn, "Finance");
$knowledgeBooks = getBooksByCategory($conn, "General Knowledge");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Books - WordWander</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
    <nav class="navbar">
        <div class="navdiv">
            <span class="logo" id="element"></span>
            <ul>
                <li><a href="order.php">Your Orders</a></li>
                <button class="logout"><a href="logout.php">LogOut</a></button>
            </ul>
        </div>
    </nav>
    
    <!-- heading -->
    <div class="cate-head">
        <div class="category">Our Collections</div>
    </div>

    <!-- students-grid (books grid) -->
    <div class="students-section">
        <div class="students-grid">
            <?php
            // Display Collections books
            foreach($collectionsBooks as $book) {
                echo '<div class="content" onclick="location.href=\'book.php?id=' . $book['id'] . '\';">';
                echo '<img src="images/' . $book['image'] . '">';
                echo '<h2>' . $book['title'] . '</h2>';
                echo '<p class="author">' . $book['author'] . '</p>';
                echo '<div class="rating">
                        <div class="stars">★★★★☆</div>
                        <div class="rating-container">
                            <div class="rating-box">
                                <span class="rating-value">' . $book['rating'] . '</span>
                                <span class="star-icon">★</span>
                            </div>
                            <span class="num-ratings">(' . $book['num_ratings'] . ')</span>
                        </div>
                    </div>';
                echo '<div class="price-section">
                        <span class="new-price">₹' . $book['price'] . '</span>
                        <span class="old-price">₹' . $book['original_price'] . '</span>
                    </div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Programming books section -->
    <div class="cate-head">
        <div class="category">Programming</div>
    </div>

    <div class="students-section">
        <div class="students-grid">
            <?php
            // Display Programming books
            foreach($programmingBooks as $book) {
                echo '<div class="content" onclick="location.href=\'book.php?id=' . $book['id'] . '\';">';
                echo '<img src="images/' . $book['image'] . '">';
                echo '<h2>' . $book['title'] . '</h2>';
                echo '<p class="author">' . $book['author'] . '</p>';
                echo '<div class="rating">
                        <div class="stars">★★★★☆</div>
                        <div class="rating-container">
                            <div class="rating-box">
                                <span class="rating-value">' . $book['rating'] . '</span>
                                <span class="star-icon">★</span>
                            </div>
                            <span class="num-ratings">(' . $book['num_ratings'] . ')</span>
                        </div>
                    </div>';
                echo '<div class="price-section">
                        <span class="new-price">₹' . $book['price'] . '</span>
                        <span class="old-price">₹' . $book['original_price'] . '</span>
                    </div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Finance books section -->
    <div class="cate-head">
        <div class="category">Finance</div>
    </div>

    <div class="students-section">
        <div class="students-grid">
            <?php
            // Display Finance books
            foreach($financeBooks as $book) {
                echo '<div class="content" onclick="location.href=\'book.php?id=' . $book['id'] . '\';">';
                echo '<img src="images/' . $book['image'] . '">';
                echo '<h2>' . $book['title'] . '</h2>';
                echo '<p class="author">' . $book['author'] . '</p>';
                echo '<div class="rating">
                        <div class="stars">★★★★☆</div>
                        <div class="rating-container">
                            <div class="rating-box">
                                <span class="rating-value">' . $book['rating'] . '</span>
                                <span class="star-icon">★</span>
                            </div>
                            <span class="num-ratings">(' . $book['num_ratings'] . ')</span>
                        </div>
                    </div>';
                echo '<div class="price-section">
                        <span class="new-price">₹' . $book['price'] . '</span>
                        <span class="old-price">₹' . $book['original_price'] . '</span>
                    </div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- General Knowledge books section -->
    <div class="cate-head">
        <div class="category">General Knowledge</div>
    </div>

    <div class="students-section">
        <div class="students-grid">
            <?php
            // Display General Knowledge books
            foreach($knowledgeBooks as $book) {
                echo '<div class="content" onclick="location.href=\'book.php?id=' . $book['id'] . '\';">';
                echo '<img src="images/' . $book['image'] . '">';
                echo '<h2>' . $book['title'] . '</h2>';
                echo '<p class="author">' . $book['author'] . '</p>';
                echo '<div class="rating">
                        <div class="stars">★★★★☆</div>
                        <div class="rating-container">
                            <div class="rating-box">
                                <span class="rating-value">' . $book['rating'] . '</span>
                                <span class="star-icon">★</span>
                            </div>
                            <span class="num-ratings">(' . $book['num_ratings'] . ')</span>
                        </div>
                    </div>';
                echo '<div class="price-section">
                        <span class="new-price">₹' . $book['price'] . '</span>
                        <span class="old-price">₹' . $book['original_price'] . '</span>
                    </div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <div class="footer">
        <p class="foot-p">&copy; 2024 WordWander. All rights reserved.</p><br>
        <p class="foot-p">follow-us On</p>
        <div class="wrapper">
            <a href="social.php" class="icon"><i class="fa-brands fa-instagram"></i></a>
            <a href="social.php" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="social.php" class="icon"><i class="fa-brands fa-youtube"></i></a>
            <a href="social.php" class="icon"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="social.php" class="icon"><i class="fa-brands fa-github"></i></a>
        </div>
    </div>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script>
        var typed = new Typed('#element', {
            strings: ['WordWander'],
            typeSpeed: 50,
        });
    </script>
</body>

</html>
<?php
// Close connection
$conn->close();
?>

