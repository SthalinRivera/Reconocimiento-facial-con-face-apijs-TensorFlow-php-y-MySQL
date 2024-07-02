<!-- <div class="sidebar bg-light border-right">
    <ul class="sidebar--items list-unstyled">
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="index.php">
                <span class="icon icon-1 mr-2"><i class="ri-layout-grid-line"></i></span>
                <span class="sidebar--item">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="realtime.php">
                <span class="icon icon-1 mr-2"><i class="ri-map-pin-line"></i></span>
                <span class="sidebar--item" style="white-space: nowrap;">Real Time</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="reports.php">
                <span class="icon icon-1 mr-2"><i class="ri-map-pin-line"></i></span>
                <span class="sidebar--item" style="white-space: nowrap;">Reports</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex   align-items-center" href="createUser.php">
                <span class="icon icon-1 mr-2"><i class="ri-map-pin-line"></i></span>
                <span class="sidebar--item" style="white-space: nowrap;">Users</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="createStudent.php">
                <span class="icon icon-1 mr-2"><i class="ri-user-line"></i></span>
                <span class="sidebar--item">Studens</span>
            </a>
        </li>
    </ul>
    <ul class="sidebar--bottom-items list-unstyled mt-auto">
       <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="#">
                <span class="icon icon-2 mr-2"><i class="ri-settings-3-line"></i></span>
                <span class="sidebar--item">Settings</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="../logout.php">
                <span class="icon icon-2 mr-2"><i class="ri-logout-box-r-line"></i></span>
                <span class="sidebar--item">Logout</span>
            </a>
        </li> 
    </ul>
</div> -->
<style>
.sidebar {
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
}

.sidebar--items,
.sidebar--bottom-items {
    padding-left: 0;
}

.nav-link {
    color: #333;
    padding: 10px 15px;
}

.nav-link:hover {
    background-color: #f8f9fa;
    color: #007bff;
}

.icon {
    font-size: 1.2em;
}

.mr-2 {
    margin-right: .5rem;
}

.mt-auto {
    margin-top: auto;
}
</style>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link " href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="reports_day.php">
                        <i class="bi bi-circle"></i><span>Reports per day</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->


        <li class="nav-heading">Pages</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="createStudent.php">
                <i class="bi bi-person"></i>
                <span>Studens</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="createUser.php">
                <i class="bi bi-question-circle"></i>
                <span>Users</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="reports.php">
                <i class="bi bi-envelope"></i>
                <span>Reports v1</span>
            </a>
        </li><!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="realtime.php">
                <i class="bi bi-card-list"></i>
                <span>Real Time</span>
            </a>
        </li><!-- End Register Page Nav -->
    </ul>

</aside><!-- End Sidebar-->
<script>
document.addEventListener("DOMContentLoaded", function() {
    var currentUrl = window.location.href;
    var links = document.querySelectorAll('.sidebar a');
    links.forEach(function(link) {
        if (link.href === currentUrl) {
            link.id = 'active--link';
        }
    });
});
</script>