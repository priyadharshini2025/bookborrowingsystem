<?php
include ('./conn/conn.php'); // Include your database connection file
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Function to create the "uploads" directory if it doesn't exist
function createUploadsDirectory($directory) {
    if (!is_dir($directory)) {
        if (!mkdir($directory, 0777, true)) {
            die('Failed to create directory: ' . $directory);
        }
    }
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Server-side validation for email and phone number
    if (!filter_var($_POST["uploader_email"], FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    if (strlen($_POST["phone_number"]) < 10) {
        echo "Phone number must be 10 digits long";
        exit();
    }

    // Check if file was uploaded without errors
    if (isset($_FILES["book_pdf"]) && $_FILES["book_pdf"]["error"] == 0) {
        // Call the function to create the "uploads" directory
        createUploadsDirectory("uploads/");

        // Book details
        $bookTitle = $_POST["book_title"];
        $bookAuthor = $_POST["book_author"];
        $uploaderEmail = $_POST["uploader_email"];
        $phoneNumber = $_POST["phone_number"];

        // File details
        $fileName = $_FILES["book_pdf"]["name"];
        $fileTmpName = $_FILES["book_pdf"]["tmp_name"];
        $fileType = $_FILES["book_pdf"]["type"];

        // Specify the directory where you want to save the uploaded files
        $uploadDir = "uploads/";

        // Generate a unique filename to avoid overwriting existing files
        $uniqueFilename = uniqid() . '_' . $fileName;

        // Check if the file is a PDF
        if ($fileType != "application/pdf") {
            echo "Sorry, only PDF files are allowed.";
        } else {
            // Move the uploaded file to the uploads directory with the unique filename
            $targetFile = $uploadDir . $uniqueFilename;
            if (move_uploaded_file($fileTmpName, $targetFile)) {
                // File uploaded successfully, now save the book details in the database
                $stmt = $conn->prepare("INSERT INTO tbl_books (title, author, uploader_email, phone_number, upload_date, file_path) VALUES (?, ?, ?, ?, NOW(), ?)");
                $stmt->execute([$bookTitle, $bookAuthor, $uploaderEmail, $phoneNumber, $targetFile]);

                // Display alert message to all users
                echo "<script>alert('Book \"$bookTitle\" uploaded successfully!');</script>";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file uploaded.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Book</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Book Borrower System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="uploadbook.php">Upload Book</a>
                </li>
                <li class="nav-item">
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
        <h2>Upload Book</h2>
        <form action="uploadbook.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="book_title">Book Title:</label>
                <input type="text" class="form-control" id="book_title" name="book_title" required>
            </div>
            <div class="form-group">
                <label for="book_author">Author:</label>
                <input type="text" class="form-control" id="book_author" name="book_author" required>
            </div>
            <div class="form-group">
                <label for="uploader_email">Your Email:</label>
                <input type="text" class="form-control" id="uploader_email" name="uploader_email" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Your Phone Number:</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="book_pdf">Upload PDF:</label>
                <input type="file" class="form-control-file" id="book_pdf" name="book_pdf" accept=".pdf" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload Book</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function validateForm() {
            var email = document.getElementById("uploader_email").value;
            var phone = document.getElementById("phone_number").value;

            // Email validation
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Phone number validation
            if (phone.length < 10) {
                alert("Phone number must be  10 digits long.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
