<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';





function fetchStudentRecordsFromDatabase($conn, $courseCode, $unitCode) {
    $studentRows = array();

    $query = "SELECT * FROM tblattendance WHERE course = '$courseCode' AND unit = '$unitCode'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $studentRows[] = $row;
        }
    }

    return $studentRows;
}

$courseCode = isset($_GET['course']) ? $_GET['course'] : '';
$unitCode = isset($_GET['unit']) ? $_GET['unit'] : '';

$studentRows = fetchStudentRecordsFromDatabase($conn, $courseCode, $unitCode);

$coursename = "";
if (!empty($courseCode)) {
    $coursename_query = "SELECT name FROM tblcourse WHERE courseCode = '$courseCode'";
    $result = mysqli_query($conn, $coursename_query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $coursename = $row['name'];
    }
}
$unitname="";
if (!empty($unitCode)) {
    $unitname_query = "SELECT name FROM tblunit WHERE unitCode = '$unitCode'";
    $result = mysqli_query($conn, $unitname_query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $unitname = $row['name'];
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" rel="stylesheet">
    <?php include "Includes/head.php";?>
</head>

<body>
    <?php include 'includes/topbar.php';?>
    <section class="main">
        <?php include 'includes/sidebar.php';?>
        <div class="container mt-4">

            <button class="btn btn-primary mt-3"
                onclick="exportTableToExcel('attendanceTable', '<?php echo $unitCode ?>_on_<?php echo date('Y-m-d'); ?>','<?php echo $coursename ?>', '<?php echo $unitname ?>')">Export
                Attendance As Excel</button>
            <div class="table-responsive mt-4">
                <div class="title">
                    <h2 class="section--title">Attendance Preview</h2>
                </div>
                <table class="table table-bordered table-striped" id="attendanceTable">
                    <thead>
                        <tr>
                            <th>Registration No</th>
                            <?php
                        $distinctDatesQuery = "SELECT DISTINCT dateMarked FROM tblattendance where course='$courseCode' and unit='$unitCode'";
                        $distinctDatesResult = mysqli_query($conn, $distinctDatesQuery);

                        if ($distinctDatesResult) {
                            while ($dateRow = mysqli_fetch_assoc($distinctDatesResult)) {
                                echo "<th>" . $dateRow['dateMarked'] . "</th>";
                            }
                        }
                        ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach ($studentRows as $row) {
                        echo "<tr>";
                        echo "<td>" . $row["studentRegistrationNumber"] . "</td>";
                        $distinctDatesResult = mysqli_query($conn, $distinctDatesQuery);
                        if ($distinctDatesResult) {
                            while ($dateRow = mysqli_fetch_assoc($distinctDatesResult)) {
                                $date = $dateRow['dateMarked'];
                                $attendanceQuery = "SELECT attendanceStatus FROM tblattendance WHERE studentRegistrationNumber = '" . $row['studentRegistrationNumber'] . "' AND dateMarked = '$date'";
                                $attendanceResult = mysqli_query($conn, $attendanceQuery);
                                
                                if ($attendanceResult && mysqli_num_rows($attendanceResult) > 0) {
                                    $attendanceData = mysqli_fetch_assoc($attendanceResult);
                                    echo "<td>" . $attendanceData['attendanceStatus'] . "</td>";
                                } else {
                                    echo "<td>Absent</td>";
                                }
                            }
                        }
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div>
</body>

<script src="./min/js/filesaver.js"></script>
<script src="./min/js/xlsx.js"></script>
<script src="../admin/javascript/main.js"></script>


<script>
function updateTable() {
    var courseSelect = document.getElementById("courseSelect");
    var unitSelect = document.getElementById("unitSelect");

    var selectedCourse = courseSelect.value;
    var selectedUnit = unitSelect.value;

    var url = "downloadrecord.php";
    if (selectedCourse && selectedUnit) {
        url += "?course=" + encodeURIComponent(selectedCourse) + "&unit=" + encodeURIComponent(selectedUnit);
        window.location.href = url;

    }
}

function exportTableToExcel(tableId, filename = '', courseCode = '', unitCode = '') {
    var table = document.getElementById(tableId);
    var currentDate = new Date();
    var formattedDate = currentDate.toLocaleDateString(); // Format the date as needed

    var headerContent = '<p style="font-weight:700;"> Attendance for : ' + courseCode + ' Unit name : ' + unitCode +
        ' On: ' + formattedDate + '</p>';
    var tbody = document.createElement('tbody');
    var additionalRow = tbody.insertRow(0);
    var additionalCell = additionalRow.insertCell(0);
    additionalCell.innerHTML = headerContent;
    table.insertBefore(tbody, table.firstChild);
    var wb = XLSX.utils.table_to_book(table, {
        sheet: "Attendance"
    });
    var wbout = XLSX.write(wb, {
        bookType: 'xlsx',
        bookSST: true,
        type: 'binary'
    });
    var blob = new Blob([s2ab(wbout)], {
        type: 'application/octet-stream'
    });
    if (!filename.toLowerCase().endsWith('.xlsx')) {
        filename += '.xlsx';
    }

    saveAs(blob, filename);
}

function s2ab(s) {
    var buf = new ArrayBuffer(s.length);
    var view = new Uint8Array(buf);
    for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
    return buf;
}
</script>

</html>