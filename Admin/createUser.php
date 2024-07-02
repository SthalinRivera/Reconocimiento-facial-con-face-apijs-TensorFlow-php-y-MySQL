<?php 

include '../Includes/dbcon.php';
include '../Includes/session.php';


if (isset($_POST["addLecture"])) {
    $userName = $_POST["userName"]; 
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $dateRegistered = date("Y-m-d");
    $password=$_POST["password"];
    $password = md5($password);
    $query=mysqli_query($conn,"select * from tbladmin where emailAddress='$email'");
    $ret=mysqli_fetch_array($query);
        if($ret > 0){ 
            $message = " Lecture Already Exists";
        }
    else{
            $query=mysqli_query($conn,"insert into tbladmin(userName,firstName,lastName,emailAddress,password,dateRegistered) 
        value('$userName','$firstName','$lastName','$email','$password','$dateRegistered')");
        $message = " Lecture Added Successfully";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" rel="stylesheet">

    <?php include "Includes/head.php";?>
    
    <script src="./javascript/addStudent.js"></script>
    <script src="./javascript/addStudent.js"></script>
    <script src="https://unpkg.com/face-api.js"></script>
</head>

<body>
    <?php include "Includes/topbar.php";?>
    <section class="main container-fluid">
        <?php include "Includes/sidebar.php";?>
        <div class="main--content">
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

                <div id="overlay"></div>
                <div id="messageDiv" class="alert alert-info" style="display:none;"></div>

                <div class="table-container mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="section--title">Lectures</h2>

                        <button class="btn btn-primary" id="addLecture" data-bs-toggle="modal"
                            data-bs-target="#addStudentModal"><i class="ri-add-line"></i> Add Student</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>User Name</th>
                                    <th>Fisrt Name</th>
                                    <th>Last Name</th>
                                    <th>Email Address</th>
                                    <th>Date Registered</th>
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
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["userName"] . "</td>";
                                    echo "<td>" . $row["firstName"] . "</td>";
                                    echo "<td>" . $row["lastName"] . "</td>";
                                    echo "<td>" . $row["emailAddress"] . "</td>";
                                    echo "<td>" . $row["dateRegistered"] . "</td>";
                                    echo "<td>
                                    <button class='btn btn-sm btn-danger delete-btn' data-id='" . $row["id"] . "'><i class='ri-delete-bin-line'></i> Delete</button>
                                    <button class='btn btn-sm btn-primary edit-btn' data-id='" . $row["id"] . "'><i class='ri-edit-line'></i> Edit</button>
                                    </td>";
                                    echo "<td></td>";

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
                                        <label for="userName" class="form-label">User Name</label>
                                        <input type="text" name="userName" class="form-control" placeholder="User Name"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" name="firstName" class="form-control"
                                            placeholder="First Name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" name="lastName" class="form-control" placeholder="Last Name"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Email Address" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="**********" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="addLecture">Save User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </main><!-- End #main -->
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

    document.addEventListener('DOMContentLoaded', function() {
        // Edit button click event listener
        document.querySelectorAll('.edit-btn').forEach(item => {
            item.addEventListener('click', event => {
                var lectureId = event.currentTarget.getAttribute('data-id');
                // Populate edit form with existing data (optional)
                // Example: fetchLectureData(lectureId);
                var modal = new bootstrap.Modal(document.getElementById('modal'));
                modal.show();
                // Set form action and modify form for editing
                document.querySelector('form[name="addLecture"]').setAttribute('action',
                    'editLecture.php');
                document.querySelector('button[name="addLecture"]').innerHTML = 'Update User';
                // Add hidden input field to carry lecture ID
                var input = document.createElement('input');
                input.setAttribute('type', 'hidden');
                input.setAttribute('name', 'lectureId');
                input.setAttribute('value', lectureId);
                document.querySelector('form[name="addLecture"]').appendChild(input);
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Delete button click event listener
        document.querySelectorAll('.delete-btn').forEach(item => {
            item.addEventListener('click', event => {
                if (confirm('Are you sure you want to delete this lecture?')) {
                    var lectureId = event.currentTarget.getAttribute('data-id');
                    // Send AJAX request to deleteLecture.php

                    fetch('deleteLecture.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'lectureId=' + lectureId,
                        })
                        .then(response => response.text())
                        .then(data => {
                            alert(data); // Display success or error message
                            // Refresh the page or update the table
                            window.location.reload();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            });
        });
    });
    </script>
    <?php if(isset($message)){
        echo "<script>showMessage('" . $message . "');</script>";
    } 
    ?>
</body>

</html>