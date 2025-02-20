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
    <title>Planning</title>
    <link rel="icon" href="../img/logo_airnavsub.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="jquery/jquery-3.7.1.min.js"></script>
    <script src="dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    margin-top:-80px;
    margin-bottom:71px;
    position:relative;
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

.info{
  background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width:80.5%;
    margin-left:19%;
    height:100%;
    position:relative;
    margin-top:-60px;
    margin-bottom: 11px;
}

.btn{
  background-color: #337ab7;
  color:lightgrey;
  font-weight:bold;
  border:none;
  padding:10px 20px;
  cursor:pointer;
  position:relative;
  margin-top:1%
}

.btn:hover{
  background-color:blue;
  color:white;
  transition:0.3s;
}

table{
  text-align:center;
  position:relative;
  top:0;
  left:0;
}

th{
    border:1px solid lightgrey;
    font-size:14px;
    position: relative;
}

td{
    border:1px solid lightgrey;
    padding:5px;
    position: relative;
    font-size:15px;
} 

.srch{
  background-color: whitesmoke;
  color:black;
  float:right;
  border-radius:3px;
  justify-content: space-around;
  border:1px solid lightgrey;
  padding:5px;
}

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type="time"]::-webkit-calendar-picker-indicator {
  display: none;
  margin: 0;
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

input{
  background-color: whitesmoke;
  border-radius: 3px;
  border: 1px solid lightgrey;
}
input:hover{
  background-color: white;
  border-radius: 3px;
  border: 1px solid black;
}
    </style>
</head>
<body>
    <header>
    </>
    <h1>Planning</h1>
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
    <li><a href="dashboardop.php?page=<?= md5($_SESSION['role']);?>"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
  <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
</svg>Home</a></li>
<li><a href="#" class="open-toggle"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-airplane-fill" viewBox="0 0 16 16">
  <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849"/>
</svg>Data Penerbangan</a><svg xmlns="http://www.w3.org/2000/svg" style="margin-left:5px;" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
</svg></li>
<ul class="open" style="margin-top:-15px;">
<li><a href="#" class="submenu-toggle"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-airplane-fill" viewBox="0 0 16 16">
  <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849"/>
</svg>Izin Rute</a><svg xmlns="http://www.w3.org/2000/svg" style="margin-left:5px;" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
</svg>
<ul class="submenu">
  <li><a href="planning.php?page=1"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-clipboard2-plus-fill" viewBox="0 0 16 16">
  <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5"/>
  <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585q.084.236.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5q.001-.264.085-.5M8.5 6.5V8H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V9H6a.5.5 0 0 1 0-1h1.5V6.5a.5.5 0 0 1 1 0"/>
</svg>Planning</a></li>
  <li><a href="realisasi.php?page=<?php echo $_SESSION['role'];?>"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-clipboard2-check-fill" viewBox="0 0 16 16">
  <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5"/>
  <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585q.084.236.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5q.001-.264.085-.5m6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
</svg>Realisasi</a></li>
</ul>
</li>
</ul>
<li>

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

    
    <div class="list">
      <h2>Input Data Izin Rute</h2>
    <form method="post" action="">
      <table>
        <thead>
                <th>Rute Penerbangan</th>
                <th>Tipe Pesawat</th>
                <th>Kapasitas Pesawat</th>
                <th>Nomor Penerbangan</th>
                <th>ETD</th>
                <th>ETA</th>
                <th>DOS</th>
                <th>Frekuensi</th>
              </thead>
              <tbody>
                <td><input type="text" style="width:80px;" name="rp" required></td>
                <td><input type="text" style="width:50px;" name="tpla" required></td>
                <td><input type="number" style="width:60px;" name="kp" required></td>
                <td><input type="text" style="width:80px;" name="nofly" required></td>
                <td><input type="time" name="etd" required></td>
                <td><input type="time" name="eta" required></td>
                <td><input type="number" style="width:80px;" name="dos" required></td>
                <td><input type="number" style="width:30px;" name="freq" min="1" max="7" required></td>
              </tbody>
            </table>
        <br>
        <table>
          <thead>
            <th>Masa Berlaku</th>
            <th>Total Frekuensi</th>
            <th>Nomor Penerbitan</th>
            <th>Tipe Pengajuan</th>
          </thead>
          <tbody>
            <td><input type="date" style="width:145px;" name="datestart" required>
            <input type="date" style="width:145px;" name="dateend" required></td>
            <td><input type="text" style="width:65px;" name="tofrq" required></td>
            <td><input type="text" style="width:205px;" name="nopen" required></td>
            <td><select name="tpen">
              <option>perubahan</option>
              <option>perpanjangan</option>
              <option>baru</option>
            </select>
          </td>
        </tbody>
      </table>
      <button type="submit" name="send" class="btn">Simpan</button>
    </form>
    </div>
    <div class="info">
      <h2>Izin Rute</h2>
      <a href="export-izin.php">
      <button class="btn" style="margin-top:0px; margin-bottom:15px;">Export</button>
      </a>
      <input type="text" name="search" id="search" class="srch" placeholder="Search..." autocomplete="off">
      <table id="myTable">
            <thead>
                <tr>
                <th>No</th>
                <th>Rute Penerbangan</th>
                <th>Tipe Pesawat</th>
                <th>Kapasitas Pesawat</th>
                <th>Nomor Penerbangan</th>
                <th>ETD</th>
                <th>ETA</th>
                <th>DOS</th>
                <th>Frekuensi</th>
                <th>Masa Berlaku</th>
                <th>Total Frekuensi</th>
                <th>Nomor Penerbitan</th>
                <th>Tipe Pengajuan</th>
                <th>Total Terbang</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php
                include_once('function/koneksi.php');
                if(isset($_GET['page'])){

                  $page = $_GET['page'];
                
                }else{
                  $page = 1;
                }
                
                $num_per_page = 10;
                $start_from = (int)($page-1)*10;
                
                $query = mysqli_query($koneksi, "SELECT * FROM izinrute ORDER by id limit $start_from,$num_per_page");
                $i=1;
                while($row = mysqli_fetch_assoc($query)){
                ?>
                <td><?=htmlspecialchars($row['id'])?></td>
                <td><?=htmlspecialchars($row['rp'])?></td>
                <td><?=htmlspecialchars($row['tpla'])?></td>
                <td><?=htmlspecialchars($row['kp'])?></td>
                <td><?=htmlspecialchars($row['nofly'])?></td>
                <td><?=date('H:i',strtotime($row['etd']))?></td>
                <td><?=date('H:i',strtotime($row['eta']))?></td>
                <td><?=htmlspecialchars($row['dos'])?></td>
                <td><?=htmlspecialchars($row['freq'])?></td>
                <td><?=date("d-m-Y",strtotime($row['datestart']))?>
                    <?=date("d-m-Y",strtotime($row['dateend']))?></td>
                <td><?=htmlspecialchars($row['tofrq'])?></td>
                <td><?=htmlspecialchars($row['nopen'])?></td>
                <td><?=htmlspecialchars($row['tpen'])?></td>
                <?php
// Tanggal awal dan akhir
$tanggal_awal = $row['datestart'];
$tanggal_akhir = $row['dateend'];

// Data yang berisi angka 1-7
$data = array($row['freq']); // Contoh data

// Menghitung jumlah hari
$jumlah_hari = 7;

// Menghitung jumlah hari dari data
if($data){
foreach ($data as $angka) {
    if ($angka >= 1 && $angka <= 7) {
        $jumlah_hari += $angka;
    }
}
}

// Menampilkan hasil

// Menghitung jumlah hari dalam rentang tanggal
$start_date = new DateTime($tanggal_awal);
$end_date = new DateTime($tanggal_akhir);
$end_date->modify('+1 day'); // Tambahkan satu hari untuk inklusi

$interval = new DateInterval('P1D'); // Interval satu hari
$date_range = new DatePeriod($start_date, $interval, $end_date);

$total_hari = 0;

foreach ($date_range as $date) {
    // Cek apakah hari dalam data
    $day_of_week =(int)$date->format('N'); // 1 (Senin) hingga 7 (Minggu)
    if (in_array($day_of_week, $data)) {
        $total_hari++;
    }
}

// Menampilkan total hari dalam rentang tanggal
echo "<td> $total_hari </td>";
?>

                </tr>
            </tbody>
                <?php
                }
                ?>
                </table>
                <?php

                $pr_query = "SELECT * FROM izinrute";
                $pr_result = mysqli_query($koneksi, $pr_query);
                $total_record = mysqli_num_rows($pr_result);
                
                $total_page = ceil($total_record/$num_per_page);
                
                for($i=1;$i<=$total_page;$i++){
                  
                  echo "<a href='planning.php?page=".$i."' class='btn' style='margin-right:10px'>$i</a>";
                }
                ?>
    </div>
    <div class="chart">
      <h2>Diagram</h2>
      <div>
        <canvas id="myChart"></canvas>
      </div>
    </div>
    </body>
    </html>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdownMenu = document.querySelector('.dropdown');

    dropdownToggle.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default anchor click behavior
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const submenuToggle = document.querySelector('.submenu-toggle');
    const submenuMenu = document.querySelector('.submenu');

    submenuToggle.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default anchor click behavior
        submenuMenu.style.display = submenuMenu.style.display === 'block' ? 'none' : 'block';
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bukaToggle = document.querySelector('.buka-toggle');
    const bukaMenu = document.querySelector('.buka');

    bukaToggle.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default anchor click behavior
        bukaMenu.style.display = bukaMenu.style.display === 'block' ? 'none' : 'block';
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const openToggle = document.querySelector('.open-toggle');
    const openMenu = document.querySelector('.open');

    openToggle.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default anchor click behavior
        openMenu.style.display = openMenu.style.display === 'block' ? 'none' : 'block';
    });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#search').keyup(function(){
      search_table($(this).val());

    });
    function search_table(value){
      $('#myTable tr').each(function(){
        var found ='false';
        $(this).each(function(){
          if($(this).text().toLowerCase().indexOf(value.toLowerCase())>=0)
          {
            found='true';
          }
        });
        if(found=='true'){
          $(this).show();
        }
        else{
          $(this).hide();
        }
      });
    }
  });
</script>

<script>
var ctx = document.getElementById(myChart).getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data:{
    labels: []
  } 
})
</script>
 

    <?php
include_once('function/koneksi.php');

if(isset($_POST['send'])){
    $rp = $_POST['rp'];
    $tpla = $_POST['tpla'];
    $kp = $_POST['kp'];
    $nofly = $_POST['nofly'];
    $etd = $_POST['etd'];
    $eta = $_POST['eta'];
    $dos = $_POST['dos'];
    $freq = $_POST['freq'];
    $datestart = $_POST['datestart'];
    $dateend = $_POST['dateend'];
    $tofrq = $_POST['tofrq'];
    $nopen = $_POST['nopen'];
    $tpen = $_POST['tpen'];

    $query = mysqli_query($koneksi, "INSERT INTO izinrute(rp,tpla,kp,nofly,etd,eta,dos,freq,datestart,dateend,tofrq,nopen,tpen) values('$rp','$tpla','$kp','$nofly','$etd','$eta','$dos','$freq','$datestart','$dateend','$tofrq','$nopen','$tpen')");
    if($query){
      
      echo "<script>
      Swal.fire({
          title: 'Sukses!',
          text: 'Data berhasil ditambahkan',
          icon: 'success',
        }).then((result) => {
          if (result.isConfirmed) {
            window.location = 'planning.php';
          }
        });
      </script>";
      exit;
    }
  }
    


?>