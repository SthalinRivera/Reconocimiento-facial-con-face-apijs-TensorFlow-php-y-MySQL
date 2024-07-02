<?php
include './includes/dbcon.php';
date_default_timezone_set('America/Lima'); // Cambia 'America/Your_City' por tu zona horaria

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attendanceData = json_decode(file_get_contents("php://input"), true);
    if (!empty($attendanceData)) {
        foreach ($attendanceData as $data) {
            $studentID = $data['studentID'];
            $attendanceStatus = $data['attendanceStatus'];
            $course = $data['course'];
            $unit = $data['unit'];
            $date = date("Y-m-d"); 
            $dateTime = date("Y-m-d H:i:s");  ;  // Formato de fecha y hora

            // Consulta la última entrada del estudiante en la base de datos
            $sqlCheck = "SELECT dateTimeMarked FROM tblattendance 
                         WHERE studentRegistrationNumber = '$studentID' 
                         ORDER BY dateTimeMarked DESC LIMIT 1";
            $result = $conn->query($sqlCheck);

            $shouldInsert = true;

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $lastDateTime = new DateTime($row['dateTimeMarked']);
                $currentDateTime = new DateTime($dateTime);

                // Calcula la diferencia en segundos
                $interval = $currentDateTime->getTimestamp() - $lastDateTime->getTimestamp();

                // Solo inserta si ha pasado al menos un segundo (o minuto)
                if ($interval < 60) { // Cambia el valor a 60 para chequear por minutos
                    $shouldInsert = false;
                }
            }

            if ($shouldInsert) {
                $sql = "INSERT INTO tblattendance(studentRegistrationNumber, course, unit, attendanceStatus, dateMarked, dateTimeMarked)  
                        VALUES ('$studentID', '$course', '$unit', '$attendanceStatus', '$date', '$dateTime')";
                if ($conn->query($sql) === TRUE) {
                    echo "Attendance data for student ID $studentID inserted successfully.<br>";
                } else {
                    echo "Error inserting attendance data: " . $conn->error . "<br>";
                }
            } else {
                echo "Attendance data for student ID $studentID not inserted to avoid duplicates within one second.<br>";
            }
        }
    } else {
        echo "No attendance data received.<br>";
    }
} else {
    echo "Invalid request method.<br>";
}
?>
