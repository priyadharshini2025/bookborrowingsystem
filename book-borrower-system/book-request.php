<?php
session_start();
include ('./conn/conn.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$successMessage = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookTitle = $_POST['book_title'];
    $bookAuthor = $_POST['book_author'];

    // Store the book request in the database
    $stmt = $conn->prepare("INSERT INTO tbl_book_requests (book_title, book_author) VALUES (?, ?)");
    $stmt->execute([$bookTitle, $bookAuthor]);

    // Check if the insertion was successful
    if ($stmt->rowCount() > 0) {
        // Redirect to success page
        header('Location: request-success.php');
        exit();
    } else {
        // If unsuccessful, set an error message
        $errorMessage = "Error: Unable to submit book request.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Book</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="book-list.php">List of Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="book-request.php">Request Book</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="requested-books.php">Requested Books</a>
                </li>
                <!-- Add other navigation options here -->
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h3>Request a Book</h3>
        <form method="POST">
            <div class="form-group">
                <label for="book_title">Book Title:</label>
                <input type="text" class="form-control" id="book_title" name="book_title" required>
            </div>
            <div class="form-group">
                <label for="book_author">Book Author:</label>
                <input type="text" class="form-control" id="book_author" name="book_author" required>
            </div>
            <button type="submit" class="btn btn-primary">Request Book</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
