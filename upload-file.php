<?php
include_once('function/koneksi.php');
session_start();

$direktori = "uploads/";


$page = isset($_GET['page']) ? ($_GET['page']) : false;
if($_SESSION['id_user'] == null){
  header("location: " . BASE_URL);
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
    <link rel="icon" href="img/logo_airnavsub.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dist/sweetalert2.all.min.js">
    <script src="dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
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
    margin-bottom:85px;
    position:relative;
    }

    .list{
  background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width:80.5%;
    margin-left:19%;
    height:100%;
    margin-top:-80px;
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
  margin-bottom:1%;
  cursor:pointer;
}

.btn:hover{
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
  padding:15px;
  font-size:21px;
  color:black;
  text-decoration:none;
  margin-top:20px;
  margin-bottom:20px;
  width:90%;
}

.input-den{
  border:solid 1.5px #9e9e9e;
  border-radius:3px;
  background:lightgrey;
  padding:15px;
  font-size:21px;
  color:black;
  text-decoration:none;
  margin-top:20px;
  margin-bottom:20px;
  width:90%;
  cursor:not-allowed;
}

.label{
  position:absolute;
  transform:translateY(-50%);
  font-size:18px;
}

.hps{
  background-color:darkred;
  color:lightgrey;
  font-weight:bold;
  float:left;
  border:none;
  padding:10px 20px;
  cursor:pointer;
  text-decoration:none;
  border-radius: 3px;
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

.file{
  background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width:80.5%;
    margin-left:19%;
    height:100%;
    margin-top:-80px;
}

table{
  text-align:center;
  position:relative;
  width:100%;
}

th{
    border:2px solid lightgrey;
    padding:5px;
    font-size:20px;
    position: relative;
}

td{
    border:2px solid lightgrey;
    padding:5px;
    font-size:20px;
    position: relative;
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
    height:80%;
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

input[type="text"]{
  text-decoration: none;
  border:none;
  font-weight:bold;
}
</style>
</head>
<body>
    <header>
    </a>
    <h1>Upload File</h1>
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
          echo "Error 404";
        }

        ?>
        </li>
    <li><a href="settings.php?page=<?php md5($_SESSION['role']);?>"> <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
</svg>Pengaturan Akun</a></li>
    <li><a href="process/logout.php"><svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px;" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
  <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
</svg>Logout</a></li>
    </ul>
    <h4>© Copyright 2024 by AirNav Cabang Surabaya</h4>
    </nav>

      
<div class="file">

  <table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>License</th>
            <th>IELP</th>
            <th>MEDEX</th>
            <th>Rating</th>
            <th>Action</th>            
        </tr>
    </thead>
    <tbody>
      <input type="hidden" name="id" value="<?php echo $_SESSION['id_user']?>">
            <tr>
                <td><?php echo $_SESSION['nama'];?></td>
                <td>
                <?php
$license = mysqli_query($koneksi, "SELECT license FROM files WHERE id_user = " . $_SESSION['id_user']);
$result = mysqli_num_rows($license);

if ($result > 0) {
    while ($row = mysqli_fetch_array($license)) {
        $file_name = $row['license']; // Pastikan kolom yang diambil sesuai
        if ($file_name !== null) { // Memastikan $file_name tidak null
            echo '<a href="' . $direktori . $file_name . '" target="_blank">' . htmlspecialchars($file_name) . '</a>';
        } else {
          echo "File belum di upload";
        }
    }
  } else{
    echo "File belum di upload";
  }
?>

              <td>
              <?php
$ielp = mysqli_query($koneksi, "SELECT ielp FROM files WHERE id_user = " . $_SESSION['id_user']);
$result = mysqli_num_rows($ielp);

if ($result > 0) {
    while ($row = mysqli_fetch_array($ielp)) {
        $file_name = $row['ielp']; // Pastikan kolom yang diambil sesuai
        if ($file_name !== null) { // Memastikan $file_name tidak null
            echo '<a href="' . $direktori . $file_name . '" target="_blank">' . htmlspecialchars($file_name) . '</a>';
        } else {
          echo "File belum di upload";
        }
    }
} else{
  echo "File belum di upload";
}
?>

              <td>
              <?php
$medex = mysqli_query($koneksi, "SELECT medex FROM files WHERE id_user = " . $_SESSION['id_user']);
$result = mysqli_num_rows($medex);

if ($result > 0) {
    while ($row = mysqli_fetch_array($medex)) {
        $file_name = $row['medex']; // Pastikan kolom yang diambil sesuai
        if ($file_name !== null) { // Memastikan $file_name tidak null
            echo '<a href="' . $direktori . $file_name . '" target="_blank">' . htmlspecialchars($file_name) . '</a>';
        } else {
          echo "File belum di upload";
        }
    }
} else{
  echo "File belum di upload";
}
?>

              <td>
              <?php
$rate = mysqli_query($koneksi, "SELECT rating FROM files WHERE id_user = " . $_SESSION['id_user']);
$result = mysqli_num_rows($rate);

if ($result > 0) {
    while ($row = mysqli_fetch_array($rate)) {
        $file_name = $row['rating']; // Pastikan kolom yang diambil sesuai
        if ($file_name !== null) { // Memastikan $file_name tidak null
            echo '<a href="' . $direktori . $file_name . '" target="_blank">' . htmlspecialchars($file_name) . '</a>';
        } else {
          echo "File belum di upload";
        }
    }
}else{
  echo "File belum di upload";
}
?>
              </td>

              <td>
              <button class="btn" onclick="togglePopup()">Edit</button>
            </td>
            </tr>
    </tbody>
</table>
</div>
<form action="" method="post" enctype="multipart/form-data">
<div class="popup" id="popup-1">
  <div class="overlay"></div>
  <div class="content">
  <div class="close-btn" onclick="togglePopup()" id="close-popup">&times;</div>
    <h2>Upload File</h2>
    <p>Nama:</p>
    <input type="text" style="margin-left:-37vh;" name="nama" value="<?php echo $_SESSION['nama']?>" readonly>
    <p>License</p>
    <input type="file" style="margin-left:-20vh;" name="license" accept=".pdf"> 
    <p>IELP</p>
    <input type="file" style="margin-left:-20vh;" name="ielp" accept=".pdf"> 
    <p>MEDEX</p>
    <input type="file" style="margin-left:-20vh;" name="medex" accept=".pdf"> 
    <p>Rating</p>
    <input type="file" style="margin-left:-20vh;" name="rate" accept=".pdf"> 
    <br> <br>
    <input type="hidden" name="id" value="<?php echo $_SESSION['id_user']?>">
    <input type="submit" name="kirim" class="btn" value="Kirim" id="btn">
  </div>
</div>
</form>

</body>
</html>

<?php
if (isset($_POST['kirim'])) { // Perbaiki di sini
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $direktori = "uploads/";

    // Array untuk menyimpan nama file
    $files = [
        'license' => $_FILES['license'],
        'ielp' => $_FILES['ielp'],
        'medex' => $_FILES['medex'],
        'rate' => $_FILES['rate']
    ];

    // Menyimpan nama file
    $file_names = [];
    foreach ($files as $key => $file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $file_name = basename($file['name']);
            $file_path = $direktori . $file_name;

            // Cek apakah file sudah ada dan hapus jika ada
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            // Pindahkan file ke direktori tujuan
            if (move_uploaded_file($file['tmp_name'], $file_path)) {
                $file_names[$key] = $file_name; // Simpan nama file
            } else {
                echo "Gagal mengunggah file " . $file_name;
            }
        } else {
            // Jika tidak ada file yang diunggah, tetap simpan nilai kosong
            $file_names[$key] = null;
        }
    }

    // Cek apakah file sudah ada di database
    $cek = mysqli_query($koneksi, "SELECT * FROM files WHERE id_user = '$id'");
    $hasil = mysqli_num_rows($cek);

    if ($hasil > 0) {
        // Jika sudah ada, lakukan update
        $update_query = "UPDATE files SET ";
        $update_fields = [];

        // Hanya tambahkan kolom yang memiliki file baru
        if (isset($file_names['license'])) {
            $update_fields[] = "license = '{$file_names['license']}'";
        }
        if (isset($file_names['ielp'])) {
            $update_fields[] = "ielp = '{$file_names['ielp']}'";
        }
        if (isset($file_names['medex'])) {
            $update_fields[] = "medex = '{$file_names['medex']}'";
        }
        if (isset($file_names['rate'])) {
            $update_fields[] = "rating = '{$file_names['rate']}'";
        }

        // Gabungkan semua field yang akan diupdate
        $update_query .= implode(", ", $update_fields);
        $update_query .= " WHERE id_user = '$id'";

        $replace = mysqli_query($koneksi, $update_query);

        if ($replace) {
            echo "<script>
            Swal.fire({
                title: 'Sukses!',
                text: 'File berhasil di update! ',
                icon: 'success',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'upload-file.php?page=a3ac61932ac17091f7b6c0b56618a5b4';
                }
            }); 
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'File gagal di update! " . mysqli_error($koneksi) . "',
                icon: 'error',
            });
            </script>";
        }
    } else {
        // Jika belum ada, lakukan insert
        $query = $koneksi->prepare("INSERT INTO files (id_user, nama, license, ielp, medex, rating, upload_time) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $query->bind_param("isssss", $id, $nama, $file_names['license'], $file_names['ielp'], $file_names['medex'], $file_names['rate']);

        if ($query->execute()) {
            echo "<script>
            Swal.fire({
                title: 'Sukses!',
                text: 'File berhasil di upload! ',
                icon: 'success',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'upload-file.php?page=a3ac61932ac17091f7b6c0b56618a5b4';
                }
            }); 
            </script>";
        } else {
            echo "Gagal menyimpan data ke database: " . $query->error;
        }
    }
}
?>
<script>
    function togglePopup(){
    document.getElementById("popup-1").classList.toggle("active");
}
</script>