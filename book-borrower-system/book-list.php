<?php
include ('./conn/conn.php'); // Include your database connection file
include ('./partials/header.php'); // Include the header file with session management

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

try {
    // Retrieve books from the database
    $stmt = $conn->prepare("SELECT book_id, title, file_path FROM tbl_books");
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Book List</h2>
    <ul class="list-group">
        <?php foreach ($books as $book): ?>
            <li class="list-group-item">
                <strong style="color: green;">Title:</strong> <span style="color: green;"><?= htmlspecialchars($book['title']) ?></span><br>
                <strong style="color: green;">ID:</strong> <span style="color: green;"><?= htmlspecialchars($book['book_id']) ?></span><br>
                <a href="<?= htmlspecialchars($book['file_path']) ?>" download>Download PDF</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include ('./partials/footer.php'); ?>

<!-- Bootstrap JS for interactions (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
