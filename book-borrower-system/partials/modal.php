<?php include ($_SERVER['DOCUMENT_ROOT'].'/book-borrower-system/conn/conn.php'); ?>
<!-- Add Borrowed Book Modal -->
<div class="modal fade mt-5" id="addBorrowedBookModal" tabindex="-1" aria-labelledby="addBorrowedBook" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBorrowedBook">Add Borrowed Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./endpoint/add-borrowed-book.php" method="POST">
                    <div class="form-group">
                        <label for="borrowedBook">Book</label>
                        <select class="form-control" name="tbl_book_list_id" id="borrowedBook" required>
                            <option value="">-select-</option>
                            <?php 
                                $stmt = $conn->prepare("SELECT * FROM tbl_book_list");
                                $stmt->execute();

                                $result = $stmt->fetchAll();

                                foreach ($result as $row) {
                                    $bookID = $row['tbl_book_list_id'];
                                    $bookTitle = $row['book_title'];
                                    $bookAuthor = $row['book_author'];
                                    echo "<option value=\"$bookID\">$bookTitle by $bookAuthor</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="borrowerName">Borrower's Name</label>
                        <input type="text" class="form-control" id="borrowerName" name="borrower_name" required>
                    </div>
                    <div class="form-group">
                        <label for="borrowerContact">Borrower's Contact</label>
                        <input type="text" class="form-control" id="borrowerContact" name="borrower_contact" required>
                    </div>
                    <div class="form-group">
                        <label for="borrowerEmail">Borrower's Email</label>
                        <input type="email" class="form-control" id="borrowerEmail" name="borrower_email" required>
                    </div>
                    <div class="form-group">
                        <label for="dateReturn">Date Return</label>
                        <input type="date" class="form-control" id="dateReturn" name="date_return" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
