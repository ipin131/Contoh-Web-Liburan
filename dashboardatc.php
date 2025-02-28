<?php
require_once('function/helper.php');
include_once('function/koneksi.php');

session_start(); 

$page = isset($_GET['page']) ? ($_GET['page']) : false;
if($_SESSION['id_user'] == null){
  header("location: " . BASE_URL);
  exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="icon" href="img/logo_airnavsub.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="dist/sweetalert2.all.min.js">
    <script src="dist/sweetalert2.all.min.js"></script>
<style>

    body{
        font-family:Calibri, sans-serif;
        background-color: whitesmoke;
    }

    h1{
        text-align:left;
        font-size:30px;
        margin-bottom:10px;
        margin-top:0px;
        padding:25px;
        margin-left:17%;
        font-weight:bold;
    }

    h2{
      border-bottom: 1px solid lightgray;
      padding:5px;
      font-size:24px;
      font-weight:bold;
    }

    h3 {
        color: black;
        margin-top: 0;
        font-size:x-large;
        margin-bottom: 0;
        font-weight:bold;
      }

    p{
        font-size:large;
        text-align:justify;

    }

    strong{
        font-weight:bold;
        color:black;
        font-size:large;
    }

    section {
    background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width:80.5%;
    margin-left:19%;
    margin-top:-6.3%;
    margin-bottom:70px;
    position:relative;
    }

    header{
        background-color:white;
        color:black;
        padding:0px;
        top:0;
        left:0;
        width:100%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        position:relative;
        margin-bottom:1px;
    }

    footer{
    background-color: white;
    color:gray;
    padding:20px;
    text-align:right;
    font-size:small;
    margin-inline: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .img-hdr{
    max-width:100%;
    margin-top: 15px;
    padding-bottom:25px;
    margin:0;
    }

    .sidebar {
  position: fixed;
  top: 0;
  left: 0;
  width: 240px;
  height: 100vh;
  background-color: darkblue;
  color: #fff;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.sidebar ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.sidebar li {
  margin-bottom: 15px;
  font-size:20px;
}

.sidebar a {
  color: #fff;
  text-decoration: none;
}

.sidebar a:hover {
  color: #ccc;
}

.datetime {
  font-size: x-large;
  font-weight: bold;
  color:black;
  text-align:right;
  transform:translateY(-125%) translateX(-2%);
}

.date {
  margin-bottom: 10px;
}

.date span {
  margin: 0 5px;
}

.clock {
  font-size: x-large;
  font-weight: bold;
  text-align: right;
  color:black;
}

.clock span {
  margin: 0 5px;
}

h4{
  color:lightgray;
  text-align:left;
  font-size:10px;
  margin-top: 130%;
}

.list{
  background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width:80.5%;
    margin-left:19%;
    height:100%;
    position:relative;
}

.info{
  background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width:80.5%;
    margin-left:19%;
    height:100%;
    position:relative;
    margin-top:-80px;
    margin-bottom: 11px;
}

table{
  text-align:center;
  position:relative;
  top:0;
  left:0;
}

th{
    border:1px solid lightgrey;
    padding:10px;
    font-size:20px;
    position: relative;
}

td{
    border:1px solid lightgrey;
    padding:10px;
    font-size:20px;
    position: relative;
} 

.dropdown  {
  display: none;
}

.dropdown li{
  padding-left:25px;  
}
.submenu  {
  display: none;
}

.submenu li{
  padding-left:25px;
}

.buka{
  display:none;
}

.buka li{
  padding-left:25px;
}

.open{
  display:none;
}

.open li{
  padding-left:25px;
}

.kalender{
  background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width:80.5%;
    margin-left:19%;
    height:100%;
    position:relative;
    margin-top:10px;
    margin-bottom: 11px;
}

.chart{
  background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width:80.5%;
    margin-left:19%;
    height:100%;
    margin-top:10px;
    position:relative;
}
    </style>
</head>
<body>
    <header>
    </a>
    <h1>Dashboard</h1>


</header>


    <div class="datetime">
  <div class="date">
    <span id="day">00</span>
    <span id="month">Month</span>
    <span id="year">0000</span>
    <div class="clock">
  <span id="hour">00</span>:
  <span id="minute">00</span>:
  <span id="second">00</span>
</div>
</div>
</div>
<script>
 function updateDateTime() {
  const now = new Date();
  const day = now.getDate();
  const month = now.toLocaleString('default', { month: 'long' });
  const year = now.getFullYear();
  const hour = now.getHours();
  const minute = now.getMinutes();
  const second = now.getSeconds();

  document.getElementById('day').textContent = day.toString().padStart(2, '0');
  document.getElementById('month').textContent = month;
  document.getElementById('year').textContent = year.toString();

  document.getElementById('hour').textContent = hour.toString().padStart(2, '0');
  document.getElementById('minute').textContent = minute.toString().padStart(2, '0');
  document.getElementById('second').textContent = second.toString().padStart(2, '0');
}

setInterval(updateDateTime, 1000);
</script>
<nav class="sidebar">
    <a href="">
        <img src="img/new_logo.png" class="img-hdr"></a>
    <h2><?php echo $_SESSION['nama']; ?></h2>
    <ul>
<li>
        <?php
        $filename ="page/$page.php";

        if (file_exists($filename)){
          include_once($filename);
        }else{
          echo "404";
        }

        ?>
        </li>
    <li><a href="settings.php?page=<?= md5($_SESSION['role']);?>"> <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
</svg>Pengaturan Akun</a></li>
    <li><a href="process/logout.php"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
  <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
</svg>Logout</a></li>
    </ul>
    <h4>© Copyright 2024 by AirNav Cabang Surabaya</h4>
    </nav>

    <div class="info">
    <h2>Informasi Cuti</h2>
    <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-airplane-fill" viewBox="0 0 16 16">
  <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849"/>
</svg></span>

              <div class="info-box-content">
                <span class="info-box-text">Jumlah Personil Cuti</span>
                <span class="info-box-number">
                  <?php
                  $sql = "SELECT * from cuti";

                  if ($result = mysqli_query($koneksi, $sql)) {
                  
                      // Return the number of rows in result set
                      $rowcount = mysqli_num_rows( $result );
                      
                      // Display result
                      echo $rowcount;
                   }
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-calendar-event-fill" viewBox="0 0 16 16">
  <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
</svg></span>

              <div class="info-box-content">
                <span class="info-box-text">Cuti tersedia hari ini</span>
                <span class="info-box-number">
                <?php

                // Ambil data dari tabel slot
                $tanggal = mysqli_query($koneksi, "SELECT * FROM slot");
                $kolom = mysqli_fetch_array($tanggal);

                $tanggal_mulai = $kolom['start_date']; 
                $tanggal_akhir = $kolom['end_date']; 

                // Ambil jumlah slot
                $jumlah_slot = $kolom['day'];

                // Inisialisasi hasil
                $hasil = [];

                // Buat objek DateTime untuk tanggal mulai dan akhir
                $startDate = new DateTime($tanggal_mulai);
                $endDate = new DateTime($tanggal_akhir);

                // Ambil tanggal hari ini
                $tanggal_hari_ini = date('Y-m-d');

                // Loop melalui rentang tanggal
                for ($date = $startDate; $date <= $endDate; $date->modify('+1 day')) {
                    $tanggal_sekarang = $date->format('Y-m-d');

                    // Hitung jumlah pengajuan cuti untuk tanggal saat ini
                    $sql = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah_submit FROM cuti WHERE DATE(datestart) <= '$tanggal_sekarang' AND DATE(dateend) >= '$tanggal_sekarang'");
                    $row = mysqli_fetch_array($sql);

                    // Jika tidak ada pengajuan cuti, set jumlah_submit ke 0
                    $jumlah_submit = $row ? $row['jumlah_submit'] : 0;

                    // Hitung jumlah slot tersisa
                    $jumlah_slot_tersisa = $jumlah_slot - $jumlah_submit;

                    // Jika tanggal sekarang adalah hari ini, simpan hasilnya
                    if ($tanggal_sekarang === $tanggal_hari_ini) {
                        $hasil[$tanggal_sekarang] = [
                            'jumlah_submit' => $jumlah_submit,
                            'jumlah_slot_tersisa' => $jumlah_slot_tersisa
                        ];
                    }
                }

                // Jika tidak ada pengajuan cuti sama sekali, tampilkan jumlah slot
                if (empty($hasil)) {
                    echo $jumlah_slot; // Menampilkan jumlah slot jika tidak ada pengajuan
                } else {
                    foreach ($hasil as $tanggal => $data) {
                        echo $data['jumlah_slot_tersisa'];
                    }
                }
                ?>

                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
</svg></span>

              <div class="info-box-content">
                <span class="info-box-text">Jumlah User</span>
                <span class="info-box-number">

                  <?php
                  $sql = "SELECT * from user WHERE role = 'ATC'";
                  
                  if ($result = mysqli_query($koneksi, $sql)) {
                    
                    // Return the number of rows in result set
                    $rowcount = mysqli_num_rows( $result );
                    
                    // Display result
                    echo $rowcount;
                  }
                  ?>
                  </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="white" class="bi bi-calendar-range-fill" viewBox="0 0 16 16">
  <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 7V5H0v5h5a1 1 0 1 1 0 2H0v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9h-6a1 1 0 1 1 0-2z"/>
</svg></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Durasi Cuti</span>
                <span class="info-box-number">
                <?php
                $sql = mysqli_query($koneksi, "SELECT * FROM slot WHERE id = 1");
                while ($row = mysqli_fetch_array($sql)) {

                    $start_date = date('d-m-Y', strtotime($row['start_date']));
                    $end_date = date('d-m-Y', strtotime($row['end_date']));

                    // Menggunakan CSS untuk mengubah ukuran huruf
                    echo "<span style='font-size: 14px;'>" . $start_date . " " . $end_date . "</span><br>";
                }
                ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>



      <div class="chart">
        <h2>Perkembangan Cuti</h2>
      <div>
  <canvas id="myChart"></canvas>
</div>

<?php

$sql = "SELECT DATE(time) as tanggal, COUNT(*) as jumlah FROM cuti GROUP BY DATE(time)";
$result = $koneksi->query($sql);

$tanggal = [];
$jumlah = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tanggal[] = date('d-m-Y', strtotime($row['tanggal']));
        $jumlah[] = $row['jumlah'];
    }
}
?>

<script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($tanggal); ?>, // Label sumbu X
                datasets: [{
                    label: 'Jumlah Cuti',
                    data: <?php echo json_encode($jumlah); ?>, // Data sumbu Y
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                            }
                        }
                    }
        );
    </script>
</div>
    
</body>
</html>

<?php
if (isset($_SESSION['alertShown']) && $_SESSION['alertShown'] === true) {

  $nama = $_SESSION['nama']; 

  $namaJson = json_encode($nama);


  echo "<script>
      window.onload = function() {
          Swal.fire({
              title: 'Selamat Datang!',
              text: 'Selamat datang ' + $namaJson,
              icon: 'success',
          });
      };
  </script>";

  unset($_SESSION['alertShown']);
}
?>

