<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="dashboard/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="dashboard/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Dashboard Admin - Manajemen BKK
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="dashboard/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="dashboard/assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <link href="dashboard/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
    <div class="wrapper">
        <div class="sidebar" data-color="white" data-active-color="danger">
            <div class="logo">
                <a href="https://www.creative-tim.com" class="simple-text logo-mini">
                    <div class="logo-image-small">
                        <img src="dashboard/assets/img/logo-small.png">
                    </div>
                </a>
                <a href="https://www.creative-tim.com" class="simple-text logo-normal">
                    Manajemen BKK
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="admin_dashboard.php">
                            <i class="nc-icon nc-bank"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="keuangan.php">
                            <i class="nc-icon nc-money-coins"></i>
                            <p>Keuangan</p>
                        </a>
                    </li>
                    <li>
                        <a href="./user.html">
                            <i class="nc-icon nc-single-02"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="logout.php">
                            <i class="nc-icon nc-spaceship" style="color: red;"></i>
                            <p style="color: red;">LOGOUT</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="javascript:;">Manajemen BKK</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <form>
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control" placeholder="Search...">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="nc-icon nc-zoom-split"></i>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="nc-icon nc-globe text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Capacity</p>
                                            <p class="card-title">150GB<p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-refresh"></i>
                                    Update Now
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="nc-icon nc-money-coins text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Revenue</p>
                                            <p class="card-title">$ 1,345<p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-calendar-o"></i>
                                    Last day
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="nc-icon nc-vector text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Errors</p>
                                            <p class="card-title">23<p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-clock-o"></i>
                                    In the last hour
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="nc-icon nc-favourite-28 text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Followers</p>
                                            <p class="card-title">+45K<p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-refresh"></i>
                                    Update now
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer footer-black footer-white">
                <div class="container-fluid">
                    <div class="row">
                        <nav class="footer-nav">
                            <ul>
                                <li><a href="https://www.creative-tim.com" target="_blank">BKK SMK NASIONAL INDRAMAYU - MANAJEMEN BKK</a></li>
                            </ul>
                        </nav>
                        <div class="credits ml-auto">
                            <span class="copyright">
                                © <script>
                                    document.write(new Date().getFullYear())
                                </script>, created by <i class="fa fa-heart heart"></i><a href="https://github.com/mohamad-riko"> Korri</a>
                            </span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="dashboard/assets/js/core/jquery.min.js"></script>
    <script src="dashboard/assets/js/core/popper.min.js"></script>
    <script src="dashboard/assets/js/core/bootstrap.min.js"></script>
    <script src="dashboard/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Chart JS -->
    <script src="dashboard/assets/js/plugins/chartjs.min.js"></script>
    <!-- Notifications Plugin -->
    <script src="dashboard/assets/js/plugins/bootstrap-notify.js"></script>
    <script src="dashboard/assets/js/paper-dashboard.min.js?v=2.0.1"></script>
    <script src="dashboard/assets/demo/demo.js"></script>

    <script>
        $(document).ready(function() {
            demo.initChartsPages();
        });
    </script>
</body>

</html>
