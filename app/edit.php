<?php
require_once 'session.php';
include_once 'logic/edit_links.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>IP Logger - User Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/jvectormap.css" rel="stylesheet" />
</head>

<body id="page-top">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">IP Logger</a>

        <div class="d-none d-md-inline-block ms-auto me-0 me-md-3 my-2 my-md-0"></div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="user.php">Edit User</a></li>
                    <li><a class="dropdown-item" href="links.php">Manage Links</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="wrapper">
        <div id="content-wrapper">
            <div class="container-fluid">
                <div class="card mb-3 mt-3">
                    <div class="card-header">
                        <i class="fas fa-user-circle"></i>
                        User Settings
                    </div>
                    <form method="POST">
                        <div class="card-body">
                            <div class="container container-special">
                                <?php if (isset($message)) : ?>

                                    <?php if ($message == "yes") : ?>

                                        <?php echo $utils->alert(
                                            "Link has been updated",
                                            "success",
                                            "check-circle"
                                        ); ?>

                                    <?php endif; ?>

                                <?php endif; ?>
                            </div>
                            <div class="container container-special">
                                <div class="align-content-center justify-content-center">

                                    <?php echo $utils->input("id", $l->id); ?>

                                    <?php echo $utils->input("csrf", $utils->sanitize($_SESSION['csrf'])); ?>

                                    <div class="mb-2">

                                        <div class="form-label-group">
                                            <input class="form-control" type="text" name="long_url" placeholder="Long Url" value="<?php echo $l->long_url; ?>">
                                        </div>
                                    </div>

                                    <button class="btn btn-primary btn-block">Update Url</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Faris AL-Otaibi - 2022</div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="js/jvectormap.js"></script>
    <script src="js/world.js"></script>
</body>

</html>