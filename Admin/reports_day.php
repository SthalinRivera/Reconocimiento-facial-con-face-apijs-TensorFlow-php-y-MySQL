<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>

    <?php include "Includes/head.php";?>
</head>

<body>
    <?php include 'includes/topbar.php';?>
    <section class="main">
        <?php include 'includes/sidebar.php';?>
        <div class="main--content ">
            <main id="main" class="main">
                <div class="pagetitle">
                    <h1>Dashboard</h1>
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item">Tables</li>
                                    <li class="breadcrumb-item active">Registered persons </li>
                                </ol>
                            </nav>
                </div><!-- End Page Title -->
                <div class="">
                    <div class="table-responsive mt-4">
                        <div class="title">
                            <h2 class="section--title">Registered persons</h2>
                        </div>
                        <table class="table table-bordered table-striped" id="attendanceTable">
                            <thead>
                                <tr>
                                    <th>DNI</th>
                                    <th>Firt Name</th>
                                    <th>Last Name</th>
                                    <th>Date Time Marked</th>
                                    <th>Last minute contacted</th>
                                    <th>Person is:</th>
                                </tr>
                            </thead>
                            <tbody id="attendanceTableBody">
                                <!-- Data will be appended here by JavaScript -->
                            </tbody>
                        </table>
                        <nav aria-label="Pagination">
                            <ul class="pagination justify-content-center" id="pagination">
                                <!-- Los botones de paginación se añadirán aquí -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </main><!-- End #main -->
            <?php include "Includes/footer.php";?>
            <?php include "Includes/js.php";?>
        </div>
    </section>
</body>

<script>
function fetchAttendanceData(page = 1) {
    fetch(`fetch_attendance.php?page=${page}`)
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('attendanceTableBody');
            const pagination = document.getElementById('pagination');

            tableBody.innerHTML = '';
            pagination.innerHTML = '';

            // Iterar sobre los datos y añadir filas a la tabla
            data.data.forEach(record => {
                const row = document.createElement('tr');
                const currentTime = new Date();
                const dateTimeMarked = new Date(record.dateTimeMarked);
                const timeDifference = currentTime - dateTimeMarked;
                let elapsedTime;
                if (timeDifference < 60000) { // Menos de 1 minuto
                    elapsedTime = Math.floor(timeDifference / 1000) + ' seconds ago';
                } else if (timeDifference < 3600000) { // Menos de 1 hora
                    elapsedTime = Math.floor(timeDifference / 60000) + ' minutes ago';
                } else if (timeDifference < 86400000) { // Menos de 1 día
                    elapsedTime = Math.floor(timeDifference / 3600000) + ' hours ago';
                } else if (timeDifference < 31536000000) { // Menos de 1 año
                    elapsedTime = Math.floor(timeDifference / 86400000) + ' days ago';
                } else {
                    elapsedTime = Math.floor(timeDifference / 31536000000) + ' years ago';
                }

                // Determine the status message
                const statusMessage = (record.studentRegistrationNumber.toLowerCase() === 'unknown') ?
                    '<span class="badge bg-danger">Unknown</span>' :
                    '<span class="badge bg-success">Known</span>';
                row.innerHTML = `
                    <td>${record.studentRegistrationNumber}</td>
                    <td>${record.firstName}</td>
                    <td>${record.lastName}</td>
                    <td>${record.dateTimeMarked}</td>
                    <td>${elapsedTime}</td>
                    <td>${statusMessage}</td>
                `;
                tableBody.appendChild(row);
            });

            // Construir los botones de paginación
            if (data.totalPages > 1) {
                const currentPage = data.page;
                const totalPages = data.totalPages;
                const maxPagesToShow = 5; // Número máximo de botones de página para mostrar

                let startPage = 1;
                let endPage = totalPages;

                if (totalPages > maxPagesToShow) {
                    const halfMaxPagesToShow = Math.floor(maxPagesToShow / 2);

                    if (currentPage <= halfMaxPagesToShow) {
                        endPage = maxPagesToShow;
                    } else if (currentPage >= totalPages - halfMaxPagesToShow) {
                        startPage = totalPages - maxPagesToShow + 1;
                    } else {
                        startPage = currentPage - halfMaxPagesToShow;
                        endPage = currentPage + halfMaxPagesToShow;
                    }
                }

                for (let i = startPage; i <= endPage; i++) {
                    const li = document.createElement('li');
                    li.classList.add('page-item');
                    const a = document.createElement('a');
                    a.classList.add('page-link');
                    a.href = '#';
                    a.textContent = i;
                    if (i === currentPage) {
                        li.classList.add('active');
                    }
                    a.addEventListener('click', function() {
                        fetchAttendanceData(i);
                    });
                    li.appendChild(a);
                    pagination.appendChild(li);
                }

                // Agregar botón "Anterior"
                if (currentPage > 1) {
                    const liPrev = document.createElement('li');
                    liPrev.classList.add('page-item');
                    const aPrev = document.createElement('a');
                    aPrev.classList.add('page-link');
                    aPrev.href = '#';
                    aPrev.innerHTML = '&laquo;';
                    aPrev.addEventListener('click', function() {
                        fetchAttendanceData(currentPage - 1);
                    });
                    liPrev.appendChild(aPrev);
                    pagination.appendChild(liPrev);
                }

                // Agregar botón "Siguiente"
                if (currentPage < totalPages) {
                    const liNext = document.createElement('li');
                    liNext.classList.add('page-item');
                    const aNext = document.createElement('a');
                    aNext.classList.add('page-link');
                    aNext.href = '#';
                    aNext.innerHTML = '&raquo;';
                    aNext.addEventListener('click', function() {
                        fetchAttendanceData(currentPage + 1);
                    });
                    liNext.appendChild(aNext);
                    pagination.appendChild(liNext);
                }
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Llamar inicialmente para obtener los datos de la primera página
fetchAttendanceData();
</script>

</html>