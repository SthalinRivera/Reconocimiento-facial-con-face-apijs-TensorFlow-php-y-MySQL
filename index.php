<?php 
error_reporting(0);
include 'Includes/dbcon.php';

function getCourseNames($conn) {
    $sql = "SELECT courseCode,name FROM tblcourse";
    $result = $conn->query($sql);
    $courseNames = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $courseNames[] = $row;
        }
    }
    return $courseNames;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attendanceData = json_decode(file_get_contents("php://input"), true);

    if (!empty($attendanceData)) {
        foreach ($attendanceData as $data) {
            $studentID = $data['studentID'];
            $attendanceStatus = $data['attendanceStatus'];
            $course = $data['course'];
            $unit = $data['unit'];
            $date = date("Y-m-d"); 

            $sql = "INSERT INTO tblattendance(studentRegistrationNumber, course, unit, attendanceStatus, dateMarked)  
                    VALUES ('$studentID', '$course', '$unit', '$attendanceStatus', '$date')";
            
            if ($conn->query($sql) === TRUE) {
                $message = " Attendance Recorded Successfully For $course : $unit on $date";
            } else {
                echo "Error inserting attendance data: " . $conn->error . "<br>";
            }
        }
    } else {
        echo "No attendance data received.<br>";
    }
} else {
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../admin/img/logo/attnlg.png" rel="icon">
    <title>Facial recognition - UNDC</title>
    <link rel="stylesheet" href="lecture/css/styles.css">
    <script defer src="lecture/face-api.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styleCamara.css">
</head>

<body>
    <section>
        <div class="col-12 text-center ">
            <h1 class="text-light font-weight-bold">Facial recognition - UNDC</h1>
            <div class="video-container " style="display:none;">
                <video class="video-container-size" id="video" width="1280" height="720" autoplay></video>
                <canvas id="overlay" class=""> </canvas>
                <button id="toggle-fullscreen" class="btn-fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>
        </div>
    </section>

    <script src="lecture/script.js"></script>
    <script src="admin/javascript/main.js"></script>
    <script src="./js/scriptSizeCamara.js"></script>
</body>

</html>