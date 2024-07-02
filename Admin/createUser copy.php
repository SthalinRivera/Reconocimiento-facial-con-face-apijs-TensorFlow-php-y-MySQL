<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';


error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';
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


if (isset($_POST["addLecture"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phoneNumber= $_POST["phoneNumber"];
    $faculty = $_POST["faculty"];
    $dateRegistered = date("Y-m-d");
    $password=$_POST["password"];
    $password = md5($password);

    $query=mysqli_query($conn,"select * from tbllecture where emailAddress='$email'");
    $ret=mysqli_fetch_array($query);
        if($ret > 0){ 
            $message = " Lecture Already Exists";
        }
    else{
            $query=mysqli_query($conn,"insert into tbllecture(firstName,lastName,emailAddress,password,phoneNo,facultyCode,dateCreated) 
        value('$firstName','$lastName','$email','$password','$phoneNumber','$faculty','$dateRegistered')");
        $message = " Lecture Added Successfully";

    }
   
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="img/logo/attnlg.png" rel="icon">
    <title>AMS - Dashboard</title>
    <link rel="stylesheet" href="css/stylesss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" rel="stylesheet">
    <script src="./javascript/addStudent.js"></script>
    <script src="./javascript/addStudent.js"></script>
    <script src="https://unpkg.com/face-api.js"></script>
</head>

<body>
    <?php include "Includes/topbar.php";?>

    <section class="main d-flex">
        <?php include "Includes/sidebar.php";?>

        <div class="main--content flex-grow-1 p-4">
            <div id="overlay"></div>
            <div id="messageDiv" class="alert alert-info" style="display:none;"></div>

            <div class="table-container mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="section--title">Lectures</h2>
                    <a href="#add-form" class="btn btn-primary" id="addLecture">
                        <i class="ri-add-line"></i> Add Lecture
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Name</th>
                                <th>Last Name</th>
                                <th>Email Address</th>
                                <th>Settings</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM tbladmin";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["firstName"] . "</td>";
                                    echo "<td>" . $row["lastName"] . "</td>";
                                    echo "<td>" . $row["emailAddress"] . "</td>";
                                    echo "<td><span><i class='ri-edit-line edit'></i> <i class='ri-delete-bin-line delete'></i></span></td>";
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

            <div id="modal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Lecture</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="" name="addLecture" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" name="firstName" class="form-control" placeholder="First Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phoneNumber" class="form-label">Phone Number</label>
                                    <input type="text" name="phoneNumber" class="form-control" placeholder="Phone Number" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="**********" required>
                                </div>
                                <div class="mb-3">
                                    <label for="faculty" class="form-label">Faculty</label>
                                    <select name="faculty" class="form-select" required>
                                        <option value="" selected>Select Faculty</option>
                                        <?php
                                        $facultyNames = getFacultyNames($conn);
                                        foreach ($facultyNames as $faculty) {
                                            echo '<option value="' . $faculty["facultyCode"] . '">' . $faculty["facultyName"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" name="addLecture">Save Lecture</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script src="javascript/main.js"></script>
    <script src="javascript/addLecture.js"></script>
    <script src="./javascript/confirmation.js"></script>
    <script>
        document.getElementById('addLecture').addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('modal'));
            modal.show();
        });
    </script>
    <?php if(isset($message)){
        echo "<script>showMessage('" . $message . "');</script>";
    } 
    ?>
</body>

</html>
