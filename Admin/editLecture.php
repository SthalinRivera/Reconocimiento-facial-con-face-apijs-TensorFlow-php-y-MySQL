<?php
include '../Includes/dbcon.php'; // Adjust the path as per your file structure

if (isset($_POST["addLecture"])) {
    $lectureId = $_POST["lectureId"];
    $userName = $_POST["userName"]; 
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];

    // Update the lecture record
    $query = "UPDATE tbladmin SET userName='$userName', firstName='$firstName', lastName='$lastName', emailAddress='$email' WHERE id='$lectureId'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $message = "Lecture updated successfully";
    } else {
        $message = "Error updating lecture: " . mysqli_error($conn);
    }
}

// Redirect back to lectures.php with a message
header("Location: lectures.php?message=" . urlencode($message));
exit();
?>
