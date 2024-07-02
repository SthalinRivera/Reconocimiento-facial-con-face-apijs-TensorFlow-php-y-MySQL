<?php
include '../Includes/dbcon.php'; // Adjust the path as per your file structure

if (isset($_POST["lectureId"])) {
    $lectureId = $_POST["lectureId"];
    // Delete the lecture record
    $query = "DELETE FROM tbladmin WHERE id='$lectureId'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "Lecture deleted successfully";
    } else {
        echo "Error deleting lecture: " . mysqli_error($conn);
    }
}
?>
