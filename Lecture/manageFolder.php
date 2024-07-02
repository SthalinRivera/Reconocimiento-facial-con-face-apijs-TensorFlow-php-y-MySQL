<?php
include '../Includes/dbcon.php';

$response = array();  

if (isset($_POST['courseID'])) {
    $courseID = $_POST['courseID'];


    $sql = "SELECT registrationNumber FROM tblStudents WHERE courseCode = '$courseID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $registrationNumbers = array();
        while ($row = $result->fetch_assoc()) {
            $registrationNumbers[] = $row["registrationNumber"];
        }

        $response['status'] = 'success';
        $response['data'] = $registrationNumbers;
       
    } else {
        $response['status'] = 'error';
        $response['message'] = 'No records found';
    }

    ob_start();  
    include 'studentTablePrin.php';  
    $tableHTML = ob_get_clean();  

    $response['html'] = $tableHTML;
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid or missing parameters';
}


header('Content-Type: application/json');
echo json_encode($response);
?>
