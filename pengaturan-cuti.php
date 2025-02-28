<?php
require_once('function/helper.php');
require_once('function/koneksi.php');

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
    <title>Pengaturan Cuti</title>
    <link rel="icon" href="img/logo_airnavsub.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dist/sweetalert2.all.min.js">
    <script src="dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="jquery/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.umd.js"></script>



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
    margin-bottom:80px;
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

.btn-edit-popup{
  background-color: #337ab7;
  color:lightgrey;
  font-weight:bold;
  border:none;
  padding:10px 20px;
  margin-top:5%;
  cursor:pointer;
  width:100%;
}

.btn-add{
  background-color: #337ab7;
  color:lightgrey;
  font-weight:bold;
  float:relative;
  border:none;
  padding:10px 20px;
  margin-bottom:1%;
  cursor:pointer;
  border-radius: 3px;
}

.btn:hover{
  background-color:blue;
  color:white;
  transition:0.3s;
}

.btn-add:hover{
  background-color:blue;
  color:white;
  transition:0.3s;
}

.input-group{
                position:relative;
            }

            .input{
                border:solid 1.5px #9e9e9e;
                border-radius:3px;
                background:none;
                padding:12px;
                font-size:18px;
                color:black;
                text-decoration:none;
                margin-top:20px;
                margin-bottom:10px;
                width:100%;
            }

            .label{
                position:absolute;
                left:15px;
                color:#9e9e9e;
                pointer-events:none;
                transform:translateY(15px);
                font-size:18px;
                transition:150ms cubic-bezier(0.4,0,0.2,1);
                margin-top:20px;
            }

            .label-1{
                position:absolute;
                transform:translateY(-40%);
                font-size:18px;
            }

            .input:focus, input:valid{
                outline:none;
                border:1.5px solid grey;
            }

            .input:focus ~ label, input:valid ~ label{
                transform:translateX(-10%) translateY(-50%) scale(0.9);
                background-color:white;
                padding:0.2em;
                color:black;
            }
            
            .tombol-login{
                color:white;
                border-radius:3px;
                background:#337ab7;
                font-size:13pt;
                width:100%;
                border:none;
                padding: 10px 10px;
                cursor:pointer;
                margin-top:10px;
                height:6%;
                font-weight:bold;
            }

            input[type="submit"] {
            background-color: #005ca1;
            color: lightgrey;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.2s, color 0.2s;
            }

            input[type="submit"]:hover {
            background-color: blue;
            color: #fff;
            }

            input[type="submit"]:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
            }

.hps{
  display:inline-block;
  background-color:darkred;
  color:lightgrey;
  font-weight:bold;
  float:right;
  border:none;
  padding:10px 10px;
  margin-bottom:1%;
  margin-left:20px;
  cursor:pointer;
  text-decoration:none;
  border-radius: 3px;
  font-size:medium;
}

.hps:hover{
  background-color: red;
  color:white;
  transition:0.3s;
}

h4{
  color:lightgray;
  text-align:left;
  font-size:10px;
  margin-top: 130%;
}

table{
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

.popup .overlay{
    position:fixed;
    top:0px;
    left:0px;
    width:100vw;
    height:100vh;
    background: rgba(0,0,0,0.3);
    z-index:1;
    display: none;
}

.popup .content{
    position:absolute;
    top:50%;
    left:50%;
    transform: translate(-50%, -50%) scale(0);
    background: #fff;
    width:450px;
    height:60%;
    z-index:2;
    padding:20px;
    box-sizing: border-box;
    text-align: center;
}

.popup .content-2{
    position:absolute;
    top:50%;
    left:50%;
    transform: translate(-50%, -50%) scale(0);
    background: #fff;
    width:450px;
    height:55%;
    z-index:2;
    padding:20px;
    box-sizing: border-box;
    text-align: center;
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

.popup.active .content-2{
    transition: all 300ms ease-in-out;
    transform: translate(-50%, -50%) scale(1);
}

.srch{
  background-color: white;
  color:black;
  float:right;
}

select{
  background-color: color;
  padding:5px 10px;
  border-radius:3px;
  float:left;
  margin-top:5%;
}

.list{
  background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width:80.5%;
    margin-left:19%;
    height:100%;
    margin-top:-80px;
    position:relative;
}

.list-2{
  background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width:80.5%;
    margin-left:19%;
    height:100%;
    margin-top:1%;
    position:relative;
}

.srch{
  background-color: whitesmoke;
  color:black;
  float:right;
  border-radius:3px;
  justify-content: space-around;
  padding:5px;
}

input[type="date"],
input[type="number"] {
  padding: 5px;
  border: 2px solid lightgrey;
  border-radius: 5px;
  font-size: 16px;
  outline: none;
  background-color: whitesmoke;
}

input[type="date"]:focus,
input[type="number"]:focus{
  background-color: white;
  transition: 0.3s;
  border:2px solid blue;
}

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.periode-1{
  position:relative;
  padding-right: 10%;
  border-right: 1px solid lightgray;
  margin-right:10%;
}

.periode-2{
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
</style>
</head>
<body>
    <header>
    </a>
    <h1>Pengaturan Cuti</h1>
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
    <li><a href="settings.php?page=21232f297a57a5a743894a0e4a801fc3"> <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
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
      <h2>Aturan Cuti</h2>
      <?php
      
      $query = mysqli_query($koneksi, "SELECT * FROM komen WHERE id_teks = 1");
      while($rows = mysqli_fetch_array($query)){
        ?>
      <form method="post" action="">
        <textarea name="editor" cols="140" row="15" id="editor"><?=$rows['teks']?></textarea>
        <input type="submit" class="btn" name="kirim" value="Kirim">
        <input type="hidden" name="tanggal">
      </div>
      
      <?php
      }
      ?>
    </form>

    <?php

    $query = mysqli_query($koneksi, "SELECT * FROM slot WHERE id = 1");
    while($rows = mysqli_fetch_array($query)){
      ?>
    <div class="list-2">
      <h2>Slot Cuti</h2>
      <form action="" method="post">
        <div class="periode-1">
        <p>Periode:</p>
        <input type="date" name="mulai" value="<?php echo $rows['start_date']?>"> -
        <input type="date" name="sampai" value="<?php echo $rows['end_date']?>">
        <p>Jumlah Personil:</p>
        <input type="number" max="30" name="jumlah_personil" value="<?php echo $rows['day']?>">
        </div>
        <input type="submit" class="btn" name="send" value="Kirim">
        
        <?php
    }
    ?>
      </form>

    </div>
      </body>
      </html>
      
      <script>
    const {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Font,
        Paragraph
    } = CKEDITOR;

    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ]
        } )
        .then( /* ... */ )
        .catch( /* ... */ );
</script>


<?php

    if(isset($_POST['kirim'])){
    $teks = $_POST['editor'];

    $query = mysqli_query($koneksi, "UPDATE komen SET teks = '$teks'");
if($query){
    echo "<script>
    Swal.fire({
    title: 'Terkirim!',
    text: 'Aturan cuti berhasil diedit!',
    icon: 'success'
  }).then((result) => {
      if (result.isConfirmed) {
          window.location = 'pengaturan-cuti.php?page=21232f297a57a5a743894a0e4a801fc3';
      }
      });
</script>";
}else{
    echo "Failed: " . mysqli_error($koneksi);
}
}
?>

<?php

if(isset($_POST['send'])){

  $mulai = $_POST['mulai'];
  $sampai = $_POST['sampai'];
  $jumlah_personil = $_POST['jumlah_personil'];
  // $mulai1 = $_POST['mulai_1'];
  // $sampai1 = $_POST['sampai_1'];
  // $jumlah_personil_1 = $_POST['jumlah_personil_1'];

  $query = mysqli_query($koneksi, "UPDATE slot SET start_date = '$mulai', end_date = '$sampai', day = '$jumlah_personil'");
  
  if($query){
    echo
  "<script>
    Swal.fire({
    title: 'Terkirim!',
    text: 'Slot cuti terubah!',
    icon: 'success'
  }).then((result) => {
      if (result.isConfirmed) {
          window.location = 'pengaturan-cuti.php?page=21232f297a57a5a743894a0e4a801fc3';
      }
      });
</script>";
}else{
  echo "Failed: " . mysqli_error($koneksi);
}
}
?>
