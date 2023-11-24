<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Data of University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- Marker Cluster -->
    <link rel="stylesheet" href="assets/plugins/leaflet-markercluster/MarkerCluster.css" />
    <link rel="stylesheet" href="assets/plugins/leaflet-markercluster/MarkerCluster.Default.css" />
    <!-- Routing -->
    <link rel="stylesheet" href="assets/plugins/leaflet-routing/leaflet-routing-machine.css" />
    <!-- Search CSS Library -->
    <link rel="stylesheet" href="assets/plugins/leaflet-search/leaflet-search.css" />
    <!-- Geolocation CSS Library for Plugin -->
    <link rel="stylesheet"
        href="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.css" />
    <!-- Leaflet Mouse Position CSS Library -->
    <link rel="stylesheet" href="assets/plugins/leaflet-mouseposition/L.Control.MousePosition.css" />
    <!-- Leaflet Measure CSS Library -->
    <link rel="stylesheet" href="assets/plugins/leaflet-measure/leaflet-measure.css" />
    <!-- EasyPrint CSS Library -->
    <link rel="stylesheet" href="assets/plugins/leaflet-easyprint/easyPrint.css" />
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'EB Garamond', serif;
            font-size: 18px;
        }

        .form-container {
            background-color: #7C97C6; /* Set your desired blue color */
            padding: 20px; /* Adjust the padding as needed */
            border-radius: 10px; /* Add border radius for a rounded appearance */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add a subtle box shadow */
        }

        .form-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 50%;
            /* Atur lebar formulir sesuai kebutuhan */
            text-align: center;
        }


        .form-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 50%;
            /* Atur lebar formulir sesuai kebutuhan */
            text-align: center;
        }

        body {
            padding-top: 70px;
            /* Sesuaikan dengan tinggi navbar Anda */
        }

        .content {
            margin-top: 70px;
            /* Sesuaikan dengan tinggi navbar Anda */
            padding-bottom: 20px;
            /* Atur padding di bagian bawah jika diperlukan */
        }

        #map {
            height: 97.5vh;
        }

        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            text-align: center;
        }

        .info h2 {
            margin: 0 0 5px;
            color: #777;
        }
    </style>
</head>

<body>
     <!-- navbar -->
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg fixed-top">
      <div class="container">
          <a class="navbar-brand" href="#">Friendsity</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse text-right" id="navbarNav">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#services">Services</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#about">About</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Content
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="friendsity.php">Peta Titik Sebaran Perguruan Tinggi <br> (adjustable) </a></li>
                        <li><a class="dropdown-item" href="petauni.html">Peta Persebaran Perguruan Tinggi</a></li>
                        <li><a class="dropdown-item" href="grafikuni.html">Infografis Persebaran Perguruan Tinggi</a></li>
                    </ul>
                  <li class="nav-item">
                      <a class="nav-link" href="#teams">Teams</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#contact">Contact</a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>

  <?php
  $nama = $_POST["Nama"];
  $kabupaten = $_POST["Kabupaten"];
  $longitude = $_POST["Longitude"];
  $latitude = $_POST["Latitude"];

  // Sesuaikan dengan setting MySQL
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "latihan";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Hindari SQL Injection dengan menggunakan prepared statement
  $sql = "INSERT INTO friendsity (Nama, Kabupaten, Longitude, Latitude) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);

  // Bind parameter
  $stmt->bind_param("ssdd", $nama, $kabupaten, $longitude, $latitude);

  if ($stmt->execute()) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $stmt->close();
  $conn->close();
  ?>
   </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- footer -->
    <footer class="bg-dark p-2 text-center">
        <div class="container">
            <p class="text-light">Nazhifa Khoirunnisa &copy; 2023 - Project Bootstrap</p>
        </div>
    </footer>
    </script>
</body>

</html>