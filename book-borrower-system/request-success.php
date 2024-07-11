<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Successful</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Request Successful!</h4>
            <p>Your book request has been submitted successfully. Thank you for using our service.</p>
            <hr>
            <p class="mb-0">You can check the list of books for updates on requested books. Meanwhile, you can explore other features of our website.</p>
        </div>
        <a href="index.php" class="btn btn-primary">Go to Homepage</a>
    </div>
</body>
</html>
