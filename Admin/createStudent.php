<?php 
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';

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
function getFacultyNames($conn) {
    $sql = "SELECT facultyCode, facultyName FROM tblfaculty";
    $result = $conn->query($sql);

    $facultyNames = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $facultyNames[] = $row;
        }
    }

    return $facultyNames;
}

if(isset($_POST['addStudent'])){
  $firstName=$_POST['firstName'];
  $lastName=$_POST['lastName'];
  $email=$_POST['email'];
  $registrationNumber=$_POST['registrationNumber'];
  $courseCode=$_POST['course'];
  $faculty=$_POST['faculty'];
  $dateRegistered = date("Y-m-d");
  $capturedImage1 = $_POST['capturedImage1'];
  $capturedImage2 = $_POST['capturedImage2'];
  $capturedImage3 = $_POST['capturedImage3'];
  $capturedImage4 = $_POST['capturedImage4'];
  $base64Data1 = explode(',', $capturedImage1)[1];
  $base64Data2 = explode(',', $capturedImage2)[1];
  $base64Data3 = explode(',', $capturedImage3)[1];
  $base64Data4 = explode(',', $capturedImage4)[1];
  $imageData1 = base64_decode($base64Data1);
  $imageData2 = base64_decode($base64Data2);
  $imageData3 = base64_decode($base64Data3);
  $imageData4 = base64_decode($base64Data4);
  $registrationNumber = mysqli_real_escape_string($conn, $_POST['registrationNumber']);
  $folderPath = "../Lecture/labels/{$registrationNumber}/";
  if (!file_exists($folderPath)) {
      mkdir($folderPath, 0777, true);
  }
  file_put_contents($folderPath . '1.png', $imageData1);
  file_put_contents($folderPath . '2.png', $imageData2);
  file_put_contents($folderPath . '3.png', $imageData3);
  file_put_contents($folderPath . '4.png', $imageData4);

    $query=mysqli_query($conn,"select * from tblstudents where registrationNumber ='$registrationNumber'");
    $ret=mysqli_fetch_array($query);

    if($ret > 0){ 

        $message = "Student with the give Registration No: $registrationNumber Exists!";
    }
    else{

    $query=mysqli_query($conn,"insert into tblstudents(firstName,lastName,email,registrationNumber,faculty,courseCode,studentImage1,studentImage2,studentImage3,studentImage4, dateRegistered) 
    value('$firstName','$lastName','$email','$registrationNumber','$faculty','$courseCode', '$registrationNumber" . "_image1.png', '$registrationNumber" . "_image2.png', '$registrationNumber" . "_image3.png','$registrationNumber" . "_image4.png','$dateRegistered')");

    $message = " Student : $registrationNumber Added Successfully";

    if ($query) {
        
            
    }
    else
    {
    }
  }
}

  if(isset($_POST['update'])){
    
  $firstName=$_POST['firstName'];
  $lastName=$_POST['lastName'];
  $email=$_POST['email'];

  $registrationNumber=$_POST['registrationNumber'];
  $classId=$_POST['classId'];
  $classArmId=$_POST['classArmId'];
  $dateCreated = date("Y-m-d");

 $query=mysqli_query($conn,"update tblstudents set firstName='$firstName', lastName='$lastName',
    email='$email', registrationNumber='$registrationNumber',password='12345', classId='$classId',classArmId='$classArmId'
    where Id='$Id'");
            if ($query) {
                
                echo "<script type = \"text/javascript\">
                window.location = (\"createStudents.php\")
                </script>"; 
            }
            else
            {
                $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
            }
        }
    
  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
	{
        $Id= $_GET['Id'];
        $classArmId= $_GET['classArmId'];

        $query = mysqli_query($conn,"DELETE FROM tblstudents WHERE Id='$Id'");

        if ($query == TRUE) {

            echo "<script type = \"text/javascript\">
            window.location = (\"createStudents.php\")
            </script>";
        }
        else{

            $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>"; 
         }
      
  }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link href="img/logo/attnlg.png" rel="icon"> -->
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" rel="stylesheet">
    <script src="./javascript/addStudent.js"></script>
    <!-- Agrega jQuery al encabezado de tu HTML -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?php include "Includes/head.php";?>
    <style>
    .camera-container {
        position: fixed;
        z-index: 1050;
        /* Z-index alto para estar encima del modal */
        top: 50%;
        /* Ajustar según sea necesario */
        left: 50%;
        /* Ajustar según sea necesario */
        transform: translate(-50%, -50%);
        /* Centrar horizontal y verticalmente */
    }
    </style>
</head>

<body>
    <?php include 'includes/topbar.php';?>
    <section class="main container-fluid">
        <?php include "Includes/sidebar.php"; ?>
        <div class="main-content">
            <main id="main" class="main">
                <div class="pagetitle">
                    <h1>Data Tables</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item">Tables</li>
                            <li class="breadcrumb-item active">Data</li>
                        </ol>
                    </nav>
                </div><!-- End Page Title -->
                <div id="messageDiv" class="messageDiv alert alert-info d-none"></div>
                <div class=" my-4">
                    <div class="d-flex justify-content-between align-items-center mb-3" id="addStudent">
                        <h2 class="section-title">Students</h2>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal"><i
                                class="ri-add-line"></i> Add Student</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Registration No</th>
                                    <th>Name</th>
                                    <th>Faculty</th>
                                    <th>Course</th>
                                    <th>Email</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM tblstudents";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["registrationNumber"] . "</td>";
                                        echo "<td>" . $row["firstName"] . "</td>";
                                        echo "<td>" . $row["faculty"] . "</td>";
                                        echo "<td>" . $row["courseCode"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td><span><i class='ri-edit-line edit'></i><i class='ri-delete-bin-line delete'></i></span></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No records found</td></tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="addStudentModal" tabindex="-10" aria-labelledby="addStudentModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addStudentModalLabel">Add Students</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <div class="mb-3">
                                        <input type="text" class="form-control mb-2" required name="registrationNumber"
                                            value="<?php echo $row['registrationNumber'];?>" id="registrationNumber"
                                            placeholder="DNI">
                                        <input type="text" class="form-control mb-2" name="firstName"
                                            value="<?php echo $row['firstName'];?>" placeholder="First Name">
                                        <input type="text" class="form-control mb-2" name="lastName"
                                            value="<?php echo $row['lastName'];?>" placeholder="Last Name">
                                        <input type="email" class="form-control mb-2" name="email"
                                            value="<?php echo $row['email'];?>" placeholder="Email Address">
                                        <select required name="faculty" class="form-select mb-2">
                                            <option value="" selected>Select Faculty</option>
                                            <?php
                                    $facultyNames = getFacultyNames($conn);
                                    foreach ($facultyNames as $faculty) {
                                        echo '<option value="' . $faculty["facultyCode"] . '">' . $faculty["facultyName"] . '</option>';
                                    }
                                ?>
                                        </select>

                                        <select required name="course" class="form-select mb-2">
                                            <option value="" selected>Select Course</option>
                                            <?php
                                    $courseNames = getCourseNames($conn);
                                    foreach ($courseNames as $course) {
                                        echo '<option value="' . $course["courseCode"] . '">' . $course["name"] . '</option>';
                                    }
                                ?>
                                        </select>


                                    </div>
                                    <div class="mb-3">
                                        <div class="form-title-image mb-2">
                                            <h6>Take Student Pictures</h6>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="image-box text-center me-2" onclick="openCamera('button1');">
                                                <img src="img/default.png" alt="Default Image"
                                                    id="button1-captured-image" class="img-fluid">
                                                <div class="edit-icon">
                                                    <i class="fas fa-camera" onclick="openCamera('button1');"></i>
                                                </div>
                                                <input type="hidden" id="button1-captured-image-input"
                                                    name="capturedImage1" />
                                            </div>
                                            <div class="image-box text-center ms-2 me-3"
                                                onclick="openCamera('button2');">
                                                <img src="img/default.png" alt="Default Image"
                                                    id="button2-captured-image" class="img-fluid">
                                                <div class="edit-icon">
                                                    <i class="fas fa-camera" onclick="openCamera('button2');"></i>
                                                </div>
                                                <input type="hidden" id="button2-captured-image-input"
                                                    name="capturedImage2" />
                                            </div>
                                            <div class="image-box text-center me-2" onclick="openCamera('button3');">
                                                <img src="img/default.png" alt="Default Image"
                                                    id="button3-captured-image" class="img-fluid">
                                                <div class="edit-icon">
                                                    <i class="fas fa-camera" onclick="openCamera('button3');"></i>
                                                </div>
                                                <input type="hidden" id="button3-captured-image-input"
                                                    name="capturedImage3" />
                                            </div>
                                            <div class="image-box text-center ms-2" onclick="openCamera('button4');">
                                                <img src="img/default.png" alt="Default Image"
                                                    id="button4-captured-image" class="img-fluid">
                                                <div class="edit-icon">
                                                    <i class="fas fa-camera" onclick="openCamera('button4');"></i>
                                                </div>
                                                <input type="hidden" id="button4-captured-image-input"
                                                    name="capturedImage4" />
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (isset($Id)) { ?>
                                    <button type="submit" class="btn btn-warning w-100" name="update">Update</button>
                                    <?php } else { ?>
                                    <input type="submit" class="btn btn-primary w-100" value="Save Student"
                                        name="addStudent" />
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main><!-- End #main -->
        </div>
    </section>
    <script src="javascript/main.js"></script>
    <script>
    const addStudent = document.getElementById('addStudent');
    const addStudentForm = document.getElementById("addStudentForm");
    addStudent.addEventListener("click", function() {

        // overlay.style.display = "block";
        document.body.style.overflow = 'hidden';


    })
    var closeButtons = document.querySelectorAll(' #addStudentForm .close');

    closeButtons.forEach(function(closeButton) {
        closeButton.addEventListener('click', function() {
            addStudentForm.style.display = "none";
            overlay.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    // para buscar datos en sivireno
    $(document).ready(function() {
        $('#registrationNumber').blur(function() {
            var registrationNumber = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'fetch_student_data.php', // Archivo PHP que maneja la consulta
                data: {
                    registrationNumber: registrationNumber
                },
                success: function(response) {

                    var data = JSON.parse(response);

                    if (data.success) {
                        // Actualiza los campos del formulario con los datos recibidos
                        $('input[name="firstName"]').val(data.firstName);
                        $('input[name="lastName"]').val(data.lastName);
                        $('input[name="email"]').val(data.email);
                        $('select[name="faculty"]').val(data.facultyCode);
                        $('select[name="course"]').val(data.courseCode);

                        // // Construir el mensaje de alerta con los datos recuperados
                        // var message = "DNI: " + data.dni + "\n" +
                        //     "Nombre: " + data.firstName + " " + data.lastName + "\n" +
                        //     "Email: " + data.email + "\n" +
                        //     "Facultad: " + data.facultyCode + "\n" +
                        //     "Curso: " + data.courseCode;

                        // // Mostrar el mensaje de alerta con los datos
                        // alert(message);

                    } else {
                        alert(data
                            .message); // Muestra un mensaje si no se encontraron datos
                    }
                }
            });
        });
    });
    </script>
    <script src="./javascript/confirmation.js"></script>
    <?php if(isset($message)){
    echo "<script>showMessage('" . $message . "');</script>";
} 
?>
</body>

</html>