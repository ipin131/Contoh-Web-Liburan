<?php
require_once('../function/helper.php');
include_once('../function/koneksi.php');


session_start();

$text = isset($_GET['data']);

$page = isset($_GET['page']) ? ($_GET['page']) : false;
if($_SESSION['id_user'] == null){
  header("location: " . BASE_URL);
  exit();
}
?>

<?php
include('../function/koneksi.php');

$msg="";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cuti</title>
    <link rel="icon" href="../img/logo_airnavsub.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="../dist/sweetalert2.all.min.js">
    <script src="../dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
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
        font-size:large;
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
  position:relative;
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

#calendar {
  border-collapse: collapse;
  width: 100%;
}

#calendar th, #calendar td {
  border: 1px solid #ddd;
  padding: 30px;
  text-align: center;
}

#calendar th {
  background-color: #f0f0f0;
}

#calendar td {
  background-color: #fff;
}

#calendar td.today {
  background-color: #ccc;
}

.btn{
    background-color: blue;
    color:white;
    cursor:pointer;
    font-weight:bold;
    float:right;
    padding:10px 20px;
    border:none;
    margin-bottom:1%;
}

.btn-1{
    background-color: #337ab7;
    color:lightgray;
    cursor:pointer;
    font-weight:bold;
    padding:10px 20px;
    border:none;
    margin-bottom:1%;
    border-radius: 3px;
    transition:0.3s;
}

.btn-1:hover{
    background-color: blue;
    color:white;
    cursor:pointer;
    font-weight:bold;
    padding:10px 20px;
    border:none;
    margin-bottom:1%;
    border-radius: 3px;
}

#popup-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display:none;
}

#popup-content {
  position: relative;
  width:30%;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 3px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

#close-popup {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
}

#date-input {
  width: 200px;
  height: 40px;
  padding: 5px;
  font-size: 16px;
  border: none;
  border-radius: 3px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  background-color: #f0f0f0;
  font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}

#date-input::-webkit-calendar-picker-indicator {
  background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwG6LVtdRI2rn6wpZL6qAMuM3ZzjDnaMW2fw&s');
  background-size: 20px 20px;
  background-position: center;
  background-repeat: no-repeat;
  width: 20px;
  height: 20px;
  margin-right: 10px;
  cursor:pointer;
}

#date-input:focus {
  outline: none;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

#date-input::-webkit-datetime-edit-text {
  color: #666;
}

#date-input::-webkit-datetime-edit-field {
  padding: 0 10px;
}

#date-input::-webkit-datetime-edit-day-field {
  width: 40px;
}

#date-input::-webkit-datetime-edit-month-field {
  width: 40px;
}

#date-input::-webkit-datetime-edit-year-field {
  width: 60px;
}

h4{
  color:lightgray;
  text-align:left;
  font-size:10px;
  margin-top: 130%;
}

.close-btn{
    position: absolute;
    right:20px;
    top:20px;
    width: 30px;
    height:30px;
    background: #222;
    color:#fff;
    font-size:25px;
    font-weight:600;
    line-height: 30px;
    text-align: center;
    border-radius: 50%;
    cursor:pointer;
}

input[type="text"]{
  text-decoration: none;
  border:none;
  font-weight:bold;
}

.kalender{
  background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width:80.5%;
    margin-left:19%;
    margin-top: -60px;
    position:relative;
    margin-bottom: 10px;
}

.btn-aturan{
  float:left;
  background-color: maroon;
  color:lightgrey;
  border:none;
  padding:10px 20px;
  font-weight: bold;
  border-radius: 3px;
  transition:0.3s;
}

.btn-aturan:hover{
  float:left;
  background-color: red;
  color:white;
  border:none;
  padding:10px 20px;
  font-weight: bold;
  border-radius: 3px;
}

.popup .overlay{
    position:fixed;
    top:0px;
    left:0px;
    width:100vw;
    height:100vh;
    background: rgba(0,0,0,0.5);
    z-index:1;
    display: none;
}

.popup .content{
    position:fixed;
    top:50%;
    left:50%;
    transform: translate(-50%, -50%) scale(0);
    background: #fff;
    width:450px;
    height:65%;
    z-index:2;
    padding:20px;
    box-sizing: border-box;
    text-align: center;
    border-radius:4px;
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
}

.popup .close-btn{
    position: absolute;
    right:20px;
    top:20px;
    width: 30px;
    height:30px;
    background: #222;
    color:#fff;
    font-size:25px;
    font-weight:600;
    line-height: 30px;
    text-align: center;
    border-radius: 50%;
    cursor:pointer;
}

.popup.active .overlay{
    display:block;
}

.popup.active .content{
    transition: all 300ms ease-in-out;
    transform: translate(-50%, -50%) scale(1);
}

table{
  width:100%;
  text-align:center;
  position:relative;
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

.list{
  background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width:80.5%;
    margin-left:19%;
    height:100%;
    resize:none;
    scrollbar-width:none;
    position:relative;
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

.list{
  background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width:80.5%;
    margin-left:19%;
    height:100%;
    position:relative;
    margin-bottom:75px;
}

.ajuan{
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



    </style>
</head>
<body>
    <header>
    <h1>Pengajuan Cuti</h1>
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
        <img src="../img/new_logo.png" class="img-hdr"></a>
    <h2><?php echo $_SESSION['nama']; ?></h2>
    <ul>
    <li><a href="../dashboardatc.php?page=<?=  md5($_SESSION['role']);?>"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
  <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
</svg>Home</a></li>
<li><a href="#" class="dropdown-toggle"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
</svg>Data Kepegawaian</a></li>
<ul class="dropdown" style="margin-top:-15px;">
    <li><a href="#" class="buka-toggle"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-calendar-fill" viewBox="0 0 16 16">
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5"/>
</svg> Cuti</a><svg xmlns="http://www.w3.org/2000/svg" style="margin-left:5px;" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
</svg>
<ul class="buka">
  <li><a href="cuti.php?page=1"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-calendar-plus-fill" viewBox="0 0 16 16">
  <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2M8.5 8.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5a.5.5 0 0 1 1 0"/>
</svg>Ajukan Cuti</a></li>
  <li><a href="../edit-cuti.php?page=a3ac61932ac17091f7b6c0b56618a5b4"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg>Edit Cuti</a></li>
</ul>
</li>
</ul>
    <li><a href="../settings.php?page=<?= md5($_SESSION['role'])?>"> <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
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
      <div id="initialerror" style="color:red; margin-top:-20px; margin-bottom: 10px; font-weight:bold;"><?php echo $msg ?></div>
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
              <span class="info-box-icon bg-danger elevation-1"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-calendar-range-fill" viewBox="0 0 16 16">
  <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 7V5H0v5h5a1 1 0 1 1 0 2H0v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9h-6a1 1 0 1 1 0-2z"/>
</svg></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Cuti tersedia hari ini</span>
                <span class="info-box-number">12
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
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <div class="list">
        <h2>Jumlah Personil Cuti</h2>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Initial</th>
                    <th>Mulai Tanggal</th>
                    <th>Sampai Tanggal</th>
            </thead>
            <tbody>
              <?php
              include_once ('../function/koneksi.php');
                if(isset($_GET['page'])){

                  $page = $_GET['page'];
                
                }else{
                  $page = 1;
                }
                
                $num_per_page = 10;
                $start_from = (int)($page-1)*10;

              $query = mysqli_query($koneksi, "SELECT * FROM cuti ORDER by id_user limit $start_from,$num_per_page");
              $i = 1;
              while($row = mysqli_fetch_assoc($query)){
                ?>

                <tr>
                <td><?=htmlspecialchars($row['id_user'])?></td>
                <td><?=htmlspecialchars($row['nama'])?></td>
                <td><?=htmlspecialchars($row['username'])?></td>
                <td><?=htmlspecialchars($row['datestart'])?></td>
                <td><?=htmlspecialchars($row['dateend'])?></td>
                </tr>
                <?php
              }
              ?>
            </tbody>
        </table>
        <?php

                $pr_query = "SELECT * FROM cuti";
                $pr_result = mysqli_query($koneksi, $pr_query);
                $total_record = mysqli_num_rows($pr_result);
                
                $total_page = ceil($total_record/$num_per_page);
                
                for($i=1;$i<=$total_page;$i++){
                  
                  echo "<a href='cuti.php?page=".$i."' class='btn-1' style='margin-right:10px'>$i</a>";
                }
                ?>
        </div>
        <div class="popup" id="popup-1">
    <div class="overlay"></div>
    <div class="content">
        <div class="close-btn" onclick="togglePopup()">&times;</div>
        <h2>Aturan Cuti</h2>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM komen");
        while($rows = mysqli_fetch_array($query)){
        ?>
        <p><?=$rows['teks']?></p>
        <?php
        }
        ?>
    </div>
</div>
    <div class="kalender">
        <h2>Cuti yang Tersedia</h2>
        <button class="btn-aturan" onclick="togglePopup()">Aturan Cuti</button>
        <button class="btn" onclick="toggleThepopup()">Ajukan Cuti</button>
        
</div>

<div class="ajuan">
  <h2>Ajuan Cuti Anda</h2>
  <?php
  include_once('../function/koneksi.php');
  
    $query = mysqli_query($koneksi, "SELECT * FROM cuti WHERE id_user = ".$_SESSION['id_user']."");
    if(mysqli_num_rows($query) > 0){

echo
  "<table>
    <thead>
      <th>Nama</th>
      <th>Initial</th>
      <th>Mulai Tanggal</th>
      <th>Sampai Tanggal</th>
      <th>Waktu Pengajuan</th>
    </thead>
    <tbody>";
?>
<?php
        while($row = mysqli_fetch_array($query)){
          ?>
      <td><?php echo $row['nama'];?></td>
      <td><?php echo $row['username'];?></td>
      <td><?php echo $row['datestart'];?></td>
      <td><?php echo $row['dateend'];?></td>
      <td><?php echo $row['time']?></td>
    </tbody>
  </table>
  <br>
  <a href="edit-cuti.php?page=<?= md5($_SESSION['role'])?>">
    <button class="btn-1">Edit</button></a>
    <?php
        }
  }else{
    echo "<p style='color: red; text-align: center; font-weight: bold;'>Anda belum mengajukan cuti</p>";
  }
  ?>
</div>
<form method="post" action="">
<div class="popup" id="popup-2">
  <div class="overlay"></div>
  <div class="content">
  <div class="close-btn" onclick="toggleThepopup()" id="close-popup">&times;</div>
    <h2>Ajuan Cuti</h2>
    <p>Nama:</p>
    <p style='font-weight: bold;'><?php echo $_SESSION['nama']?><p>
    <p>Initial:</p>
    <p style="font-weight:bold;"><?php echo $_SESSION['username']?></p>
    <p>Cuti dari tanggal:</p>
    <input type="date" id="date-input" name="datestart">
    <p>Sampai tanggal:</p>
    <input type="date" id="date-input" name="dateend"> <br> <br>
    <input type="hidden" name="id" value="<?php echo $_SESSION['id_user']?>">
    <input type="submit" name="kirim" class="btn-1" value="Kirim" id="btn"7>
    </form>
</div>
</div>

<script>
    function togglePopup(){
    document.getElementById("popup-1").classList.toggle("active");
}
</script>
<script>
    function toggleThepopup(){
    document.getElementById("popup-2").classList.toggle("active");
}
</script>


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
    const bukaToggle = document.querySelector('.buka-toggle');
    const bukaMenu = document.querySelector('.buka');

    bukaToggle.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default anchor click behavior
        bukaMenu.style.display = bukaMenu.style.display === 'block' ? 'none' : 'block';
    });
});
</script>

<?php
if(isset($_POST['kirim'])){
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $datestart = $_POST['datestart'];
  $dateend = $_POST['dateend'];
  
  $query = mysqli_query($koneksi, "INSERT INTO cuti(id_user,nama,username,datestart,dateend) values('$id','$nama','$username','$datestart','$dateend')");
  
  //$row['role'] = $_SESSION['role'];
  
  if($query){
    echo "<script>
    Swal.fire({
        title: 'Ajuan cuti berhasil!',
        text: 'Selamat berlibur...',
        icon: 'success',
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = 'cuti.php?page=1';
        }
      });
      </script>";
  }
  }
?>  