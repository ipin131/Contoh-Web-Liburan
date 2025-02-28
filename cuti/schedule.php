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
<?php require_once('../function/koneksi2.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuti</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="fullcalendar/lib/main.min.css">
    <script src="jscal/jquery-3.6.0.min.js"></script>
    <script src="jscal/bootstrap.min.js"></script>
    <script src="fullcalendar/lib/main.min.js"></script>

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
        font-size:20px;
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
  /* display: none; */
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

.btn{
    background-color: #337ab7;
    color:lightgray;
    cursor:pointer;
    font-weight:bold;
    float:right;
    padding:10px 20px;
    border:none;
    transition:0.3s;
    margin-bottom:1%;
}

.btn:hover{
    background-color: blue;
    color:white;
    cursor:pointer;
    font-weight:bold;
    float:right;
    padding:10px 20px;
    border:none;
    margin-bottom:1%;
    border-radius:3px;
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

.popup .content2{
    position:fixed;
    top:50%;
    left:50%;
    transform: translate(-50%, -50%) scale(0);
    background: #fff;
    width:450px;
    height:73%;
    z-index:2;
    padding:20px;
    box-sizing: border-box;
    text-align: center;
    border-radius:4px;
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
    align-items:left;
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

.popup.active .content2{
    transition: all 300ms ease-in-out;
    transform: translate(-50%, -50%) scale(1);
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

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
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
    </style>
</head>

<body class="bg-light">
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
  <li><a href="schedule.php?page=1"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-calendar-plus-fill" viewBox="0 0 16 16">
  <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2M8.5 8.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5a.5.5 0 0 1 1 0"/>
</svg>Ajukan Cuti</a></li>
  <li><a href="../edit-cuti.php?page=a3ac61932ac17091f7b6c0b56618a5b4"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg>Edit Cuti</a></li>
</ul>
</li>
<li><a href="../upload-file.php?page=a3ac61932ac17091f7b6c0b56618a5b4"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
  <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/>
</svg>Upload File</a></li>
</ul>
    <li><a href="../settings.php?page=<?= md5($_SESSION['role'])?>"> <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
</svg>Pengaturan Akun</a></li>
    <li><a href="../process/logout.php"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
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
                if(isset($_GET['page'])){

                  $page = $_GET['page'];
                
                }else{
                  $page = 1;
                }
                
                $num_per_page = 10;
                $start_from = (int)($page-1)*10;

              $query = mysqli_query($koneksi, "SELECT * FROM cuti ORDER by id_cuti limit $start_from,$num_per_page");
              $i = 1;
              while($row = mysqli_fetch_assoc($query)){
                ?>

                <tr>
                <td><?=$i++?></td>
                <td><?=htmlspecialchars($row['nama'])?></td>
                <td><?=htmlspecialchars($row['username'])?></td>
                <td><?=date("d-m-Y",strtotime($row['datestart']))?></td>
                <td><?=date("d-m-Y",strtotime($row['dateend']))?></td>
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
                  
                  echo "<a href='schedule.php?page=".$i."' class='btn-1' style='margin-right:10px'>$i</a>";
                }
                ?>
        </div>
        
        <div class="kalender">
          <h2>Cuti yang Tersedia</h2>
        <button class="btn-aturan" onclick="togglePopup()">Aturan Cuti</button>
        <button class="btn" onclick="toggleThepopup()">Ajukan Cuti</button>
        <br> <br>
        <div id="calendar" style="margin-left:110px;"></div>
        <!-- Modal untuk Menampilkan Informasi Tanggal -->
<div class="modal fade" id="date-modal" tabindex="-1" aria-labelledby="date-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="date-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda telah mengklik tanggal ini.</p>
                <p>Silakan tambahkan event atau lihat detail lainnya.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="alert('Tambahkan Event')">Tambah Event</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
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

<div class="ajuan">
  <h2>Ajuan Cuti Anda</h2>
  <?php
  
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
      <td><?=date("d-m-Y",strtotime($row['datestart']))?></td>
      <td><?=date("d-m-Y",strtotime($row['dateend']))?></td>
      <td><?=date("d-m-Y H:i:s",strtotime($row['time']))?></td>
    </tbody>
  </table>
  <br>
  <a href="../edit-cuti.php?page=<?= md5($_SESSION['role'])?>">
    <button class="btn-1">Edit</button></a>
    <?php
        }
  }else{
    echo "<p style='color: red; text-align: center; font-weight: bold;'>Anda belum mengajukan cuti</p>";
  }
  ?>
</div>

<?php
$query = mysqli_query($koneksi, "SELECT * FROM slot");
while(mysqli_fetch_array($query)){
?>

<form method="post" action="">
<div class="popup" id="popup-2">
  <div class="overlay"></div>
  <div class="content2">
  <div class="close-btn" onclick="toggleThepopup()" id="close-popup">&times;</div>
    <h2>Ajuan Cuti</h2>
    <p>Nama:</p>
    <input type="text" style="margin-left:-37vh;" name="nama" value="<?php echo $_SESSION['nama']?>" readonly>
    <p>Initial:</p>
    <input type="text" style="margin-left:-37vh;" name="username" value="<?php echo $_SESSION['username']?>" readonly>
    <p>Cuti dari tanggal:</p>
    <input type="date" style="margin-left:-30vh;" id="date-input" name="datestart" required>
    <p>Sampai tanggal:</p>
    <input type="date" style="margin-left:-30vh;" id="date-input" name="dateend" required> <br> <br>
    <input type="hidden" name="id" value="<?php echo $_SESSION['id_user']?>">
    <input type="submit" name="kirim" class="btn-1" value="Kirim" id="btn">
  </div>
</div>
</form>
<?php
}
?>

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

                
<?php 
$schedules = $koneksi->query("SELECT * FROM cuti");
$sched_res = [];
foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
    $row['sdate'] = date("F d, Y h:i A",strtotime($row['datestart']));
    $row['edate'] = date("F d, Y h:i A",strtotime($row['dateend']));
    $sched_res[$row['id_cuti']] = $row;
}
?>
<?php 
if(isset($conn)) $conn->close();
?>
</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
<script src="jscal/script.js"></script>

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
$sql = mysqli_query($koneksi, "SELECT * FROM slot WHERE id = 1");
$row = mysqli_fetch_array($sql);

if ($row) {
    $batas_input = $row['day'];
    $start_date = $row['start_date'];
    $end_date = $row['end_date'];
}

if (isset($_POST['kirim'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $datestart = $_POST['datestart'];
    $dateend = $_POST['dateend'];

    $id = intval($id);

    $tanggal_mulai = strtotime($start_date);
    $tanggal_sekarang = strtotime(date('Y-m-d'));
    $tanggal_pengajuan_mulai = strtotime($datestart);
    $tanggal_pengajuan_akhir = strtotime($dateend);

    // Cek apakah pengguna sudah mengajukan cuti sebelumnya
    $cekPengajuan = mysqli_query($koneksi, "SELECT * FROM cuti WHERE username = '$username'");
    $batas_submit = mysqli_num_rows($cekPengajuan);

    // Menghitung jumlah hari dalam rentang tanggal
    $startDate = new DateTime($datestart);
    $endDate = new DateTime($dateend);
    $endDate->modify('+1 day');

    $slotTersedia = true; // Flag untuk mengecek ketersediaan slot

    // Periksa apakah tanggal pengajuan berada dalam rentang yang diizinkan
    if ($tanggal_pengajuan_mulai < $tanggal_mulai || $tanggal_pengajuan_akhir > strtotime($end_date)) {
        echo "<script>
        Swal.fire({
            title: 'Tanggal tidak valid!',
            text: 'Anda tidak dapat mengajukan cuti di luar tanggal yang ditentukan.',
            icon: 'error'
        }).then((result) =>{
            if(result.isConfirmed) {
                window.location = 'schedule.php?page=1';
            }
        });
        </script>";
    } else {
        // Periksa setiap tanggal dalam rentang
        for ($date = $startDate; $date < $endDate; $date->modify('+1 day')) {
            $tanggal = $date->format('Y-m-d'); // Format tanggal

            // Hitung jumlah pengajuan cuti untuk tanggal ini
            $slot = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM cuti WHERE datestart <= '$tanggal' AND dateend >= '$tanggal'");
            $rowSlot = mysqli_fetch_assoc($slot);
            $jumlahPengajuan = $rowSlot['jumlah'];

            // Jika jumlah pengajuan sudah mencapai batas, set flag menjadi false
            if ($jumlahPengajuan >= $batas_input) {
                $slotTersedia = false;
                break; // Keluar dari loop jika slot tidak tersedia
            }
        }

        if ($tanggal_sekarang > $tanggal_pengajuan_mulai) {
            echo "<script>
            Swal.fire({
                title: 'Tanggal tidak valid!',
                text: 'Anda tidak dapat mengajukan cuti pada tanggal yang sudah lewat.',
                icon: 'error'
            }).then((result) =>{
                if(result.isConfirmed) {
                    window.location = 'schedule.php?page=1';
                }
            });
            </script>";
        } elseif ($batas_submit > 0) {
            echo "<script>
            Swal.fire({
                title: 'Pengajuan sudah ada!',
                text: 'Anda hanya dapat mengajukan cuti satu kali.',
                icon: 'error'
            }).then((result) =>{
                if(result.isConfirmed) {
                    window.location = 'schedule.php?page=1';
                }
            });
            </script>";
        } elseif (!$slotTersedia) {
            echo "<script>
            Swal.fire({
                title: 'Slot terpenuhi!',
                text: 'Silahkan ajukan pada hari lain!',
                icon: 'error'
            }).then((result) =>{
                if(result.isConfirmed) {
                    window.location = 'schedule.php?page=1';
                }
            });
            </script>";
        } else {
            $query = mysqli_query($koneksi, "INSERT INTO cuti(id_user, nama, username, datestart, dateend) VALUES('$id', '$nama', '$username', '$datestart', '$dateend')");

            if ($query) {
                echo "<script>
                Swal.fire({
                    title: 'Ajuan cuti berhasil!',
                    text: 'Selamat berlibur...',
                    icon: 'success',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'schedule.php?page=1';
                    }
                });
                </script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
            }
        }
    }
}
?>

