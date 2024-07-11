$(document).ready( function () {
    $('#borrowedTable').DataTable();
} );

function updateBook(id) {
    $("#updateBookModal").modal("show");

    let updateBookID = $("#bookID-" + id).text();
    let updateBookTitle = $("#bookTitle-" + id).text();
    let updateBookAuthor = $("#bookAuthor-" + id).text();

    $("#updateBookID").val(updateBookID);
    $("#updateBookTitle").val(updateBookTitle);
    $("#updateBookAuthor").val(updateBookAuthor);
}

function deleteBook(id) {
    if (confirm('Do you want to delete this book?')) {
        window.location = "./endpoint/delete-book.php?book=" + id;
    }
}


function updateBorrowedBook(id) {
    $("#updateBorrowedBookModal").modal("show");

    let updateBorrowedID = $("#borrowedID-" + id).text();
    let updateBookID = $("#bookID-" + id).text();
    let updateBorrowerName = $("#borrowerName-" + id).text();
    let updateBorrowerContact = $("#borrowerContact-" + id).text();
    let updateDateBorrowed = $("#dateBorrowed-" + id).text();
    let updateDateReturn = $("#dateReturn-" + id).text();

    $("#updateBorrowedID").val(updateBorrowedID);

    $("#updateBorrowedBook option").prop("selected", false);
    $("#updateBorrowedBook option[value='" + updateBookID + "']").prop("selected", true);

    $("#updateBorrowerName").val(updateBorrowerName);
    $("#updateBorrowerContact").val(updateBorrowerContact);
    $("#updateDateBorrowed").val(updateDateBorrowed);
    $("#updateDateReturn").val(updateDateReturn);
}

function deleteBorrowedBook(id) {
    if (confirm('Do you want to delete this borrowed book?')) {
        window.location = "./endpoint/delete-borrowed-book.php?borrowed=" + id;
    }
}