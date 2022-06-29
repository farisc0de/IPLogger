<?php
include_once 'session.php';
include_once 'logic/clients.php';
include_once 'logic/links.php';
include_once 'logic/hits.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Dashboard - IP Logger</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/jvectormap.css" rel="stylesheet" />
</head>

<body>
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
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Dashboard</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
      <div class="row">
        <div class="col-xl-3 col-md-6">
          <div class="card bg-primary text-white mb-4">
            <div class="card-body"><?php echo $client->countClients(); ?> Total Clients</div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-warning text-white mb-4">
            <div class="card-body"><?php echo $link->countLinks(); ?> Total Links</div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-success text-white mb-4">
            <div class="card-body"><?php echo $hits; ?> Total Hits</div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6">
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-chart-area me-1"></i>
              World Map
            </div>
            <div class="card-body">
              <div id="map" style="width: 100%; height: 243px"></div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-chart-bar me-1"></i>
              Bar Chart
            </div>
            <div class="card-body">
              <canvas id="myBarChart" width="100%" height="40"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-table me-1"></i>
          IP Logger information
        </div>
        <div class="card-body">
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>IP Address</th>
                <th>Country</th>
                <th>OS</th>
                <th>Browser</th>
                <th>Device</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($c as $d) : ?>
                <tr>
                  <td><?php echo $d->ip_address; ?></td>
                  <td><img src="<?php echo $client->getClientFlag($d->country); ?>" /></td>
                  <td><?php echo $d->os; ?></td>
                  <td><?php echo $d->browser; ?></td>
                  <td><?php echo $d->device; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
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
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      $.getJSON("api/numberOfUsersPerCountry.php", {}, function(data) {
        var dataC = eval(data);
        var clients = [];
        $.each(dataC.countries, function() {
          clients[this.id] = this.value;
        });

        $("#map").vectorMap({
          map: "world_merc",
          backgroundColor: "transparent",
          series: {
            regions: [{
              values: clients,
              scale: ["#e6e6e6", "#007bff"],
              normalizeFunction: "polynomial",
            }, ],
          },
          regionStyle: {
            hover: {
              fill: "#0056b3",
              cursor: "pointer",
            },
          },

          onRegionTipShow: function(e, el, code) {
            if (typeof clients[code] != "undefined") {
              el.html(el.html() + " (" + clients[code] + " Clients)");
            }
          },
        });
      });
    });
  </script>
</body>

</html>