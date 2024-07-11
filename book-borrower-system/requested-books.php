<?php
include ('./conn/conn.php'); // Include your database connection file
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Check if the 'uploaded' parameter is present in the URL
$uploaded = isset($_GET['uploaded']) ? $_GET['uploaded'] : '';

// Retrieve requested books from the database that have not been uploaded yet
$stmt = $conn->prepare("SELECT r.* FROM tbl_book_requests r LEFT JOIN tbl_books b ON r.book_title = b.title WHERE b.title IS NULL");
$stmt->execute();
$requestedBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requested Books</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand ml-3" href="#">Book Borrower System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="uploadbook.php">Upload Books</a>
            </li>
<           <li class="nav-item">
                <a class="nav-link" href="book-list.php">List of Books</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="book-request.php">Request Book</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="requested-books.php">Requested Books</a>
            </li>
            <!-- Add other navigation options here -->
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h3>Requested Books</h3>
    <?php if (!empty($requestedBooks)): ?>
        <ul>
            <?php foreach ($requestedBooks as $book): ?>
                <li><?= htmlspecialchars($book['book_title']) ?> by <?= htmlspecialchars($book['book_author']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No books have been requested yet or all requested books have been uploaded.</p>
    <?php endif; ?>
</div>

<!-- Bootstrap JS and any other JavaScript libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php include ('./partials/footer.php'); ?>
