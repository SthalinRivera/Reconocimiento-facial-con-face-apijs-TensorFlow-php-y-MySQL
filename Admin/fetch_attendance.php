<?php
include '../Includes/dbcon.php';

// Parámetros de paginación
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPage = 10; // Número de registros por página

// Calcular el offset basado en la página actual
$offset = ($page - 1) * $perPage;

// Consulta para obtener los datos paginados
$query = " SELECT att.studentRegistrationNumber, e.firstName,e.lastName, att.attendanceStatus, att.dateMarked, att.dateTimeMarked 
 FROM tblattendance att, tblstudents e 
 WHERE att.studentRegistrationNumber=e.registrationNumber 
 ORDER BY att.dateTimeMarked DESC 
          LIMIT $perPage OFFSET $offset";
$result = $conn->query($query);

$attendanceData = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $attendanceData[] = $row;
    }
}

// Obtener el total de registros sin paginación para la paginación
$totalQuery = "SELECT COUNT(*) as total FROM tblattendance";
$totalResult = $conn->query($totalQuery);
$totalRows = $totalResult->fetch_assoc()['total'];

// Calcular el número total de páginas
$totalPages = ceil($totalRows / $perPage);

// Construir el array de respuesta JSON
$response = array(
    'data' => $attendanceData,
    'page' => $page,
    'perPage' => $perPage,
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
);

header('Content-Type: application/json');
echo json_encode($response);
?>
