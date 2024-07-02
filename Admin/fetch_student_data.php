

<?php
// Conexión a la base de datos remota
include './Includes/dbconremote.php';  // Ajusta la ruta según tu estructura de directorios

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrationNumber'])) {
    $registrationNumber = $_POST['registrationNumber'];

    // Consulta para obtener datos del estudiante y detalles de carrera
    $sql = "SELECT e.id_estu,e.dni_estu, e.email_estu, e.fot_estu, CONCAT( e.apepa_estu,' ', e.apema_estu) last_name, e.nom_estu , d.id_car, c.nom_car 
 FROM estudiante e , detestudiante d, carrera c, plan_estudio p
 WHERE  e.id_estu=d.id_estu AND d.id_car=c.id_car AND  d.id_plan=p.id_plan AND d.activo='SI' AND  e.dni_estu = '$registrationNumber'";

    $result = $conn_remote->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

           // Verifica si las claves existen antes de acceder a ellas
           $lastName = isset($row['last_name']) ? $row['last_name'] : '';
           $facultyCode = isset($row['id_car']) ? $row['id_car'] : '';
           $courseCode = isset($row['nom_car']) ? $row['nom_car'] : '';

        $response = array(
            'success' => true,
            'dni' => $row['dni_estu'],
            'firstName' => $row['nom_estu'],
            'lastName' => $lastName,
            'email' => $row['email_estu'],
            'facultyCode' => $facultyCode,
            'courseCode' => $courseCode
        );

        echo json_encode($response);
    } else {
        $response = array('success' => false, 'message' => 'No se encontraron datos para el número de registro proporcionado.');
        echo json_encode($response);
    }
} else {
    $response = array('success' => false, 'message' => 'Petición inválida.');
    echo json_encode($response);
}
?>