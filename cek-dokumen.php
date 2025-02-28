<?php
require_once('function/helper.php');
require_once('function/koneksi.php');

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
    <title>Cek Dokumen</title>
    <link rel="icon" href="img/logo_airnavsub.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="jquery/jquery-3.7.1.min.js"></script>
<style>

  .hide{
    display:none;
  }

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
  margin-bottom:1%;
  cursor:pointer;
  position: relative;
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
                font-weight:none;
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
  background-color:darkred;
  color:lightgrey;
  font-weight:bold;
  border:none;
  padding:10px 10px;
  cursor:pointer;
  text-decoration:none;
  border-radius: 3px;
  font-size:medium;
  display:inline-flex;
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
    border:2px solid lightgrey;
    padding:10px;
    font-size:20px;
    position: relative;
}

td{
    border:2px solid lightgrey;
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
    background: rgba(0,0,0,0.4);
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
    height:68%;
    z-index:2;
    padding:20px;
    box-sizing: border-box;
    text-align: center;
    border-radius:3px;
    box-shadow:0 0 10px rgba(0,0,0,0.5);
}

.popup .content-2{
    position:fixed;
    top:50%;
    left:50%;
    transform: translate(-50%, -50%) scale(0);
    background: #fff;
    width:450px;
    height:58%;
    z-index:2;
    padding:20px;
    box-sizing: border-box;
    text-align: center;
    border-radius:3px;
    box-shadow:0 0 10px rgba(0,0,0,0.5);
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
  background-color: whitesmoke;
  color:black;
  float:right;
  border-radius:3px;
  justify-content: space-around;
  padding:5px;
}

.list{
  background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width:80.5%;
    margin-left:19%;
    height:100%;
    position:relative;
    margin-top:-80px;
}


select{
  background-color: color;
  padding:5px 10px;
  border-radius:3px;
  float:left;
  margin-top:5%;
}

.hide{
  display: none;
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
    <h1>User Dokumen</h1>
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
        <input type="text" name="search" id="search" class="srch" placeholder="Search..." autocomplete="off">
        <br>
        <br>
        <table class="table" id="myTable">
          <thead>
            <tr>
                <th>Nama</th>
                <th>License</th>
                <th>IELP</th>
                <th>Medex</th>
                <th>Rating</th>
            </tr>
            </thead>
            <tbody>
            <?php
    $query = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id_user");
    while ($row = mysqli_fetch_assoc($query)) {

        if ($row['role'] === 'admin') {
            continue;
        }
        ?>
    <tr>
        <td>
            <?= htmlspecialchars($row['nama']) ?>
        </td>
        <td>
            <?php
            $id_user = $row['id_user'];

            $license_query = mysqli_query($koneksi, "SELECT license FROM files WHERE id_user = " . $id_user);
            $result = mysqli_num_rows($license_query);

            if ($result > 0) {
                while ($file_row = mysqli_fetch_array($license_query)) {
                    $file_name = $file_row['license'];
                    if ($file_name !== null) { 
                        echo '<a href="' . htmlspecialchars($direktori . $file_name) . '" target="_blank">' . htmlspecialchars($file_name) . '</a>';
                    } else{
                      echo "File belum di upload";
                    }
                }
            } else {
                echo "File belum di upload";
            }
            ?>
        </td>

              <td>
              <?php
            $id_user = $row['id_user'];

            $ielp_query = mysqli_query($koneksi, "SELECT ielp FROM files WHERE id_user = " . $id_user);
            $result = mysqli_num_rows($license_query);

            if ($result > 0) {
                while ($file_row = mysqli_fetch_array($ielp_query)) {
                    $file_name = $file_row['ielp'];
                    if ($file_name !== null) { 
                        echo '<a href="' . htmlspecialchars($direktori . $file_name) . '" target="_blank">' . htmlspecialchars($file_name) . '</a>';
                    }else{
                      echo "File belum di upload";
                    }
                }
            } else {
                echo "File belum di upload";
            }
            ?>

              <td>
              <?php
            $id_user = $row['id_user'];

            $medex_query = mysqli_query($koneksi, "SELECT medex FROM files WHERE id_user = " . $id_user);
            $result = mysqli_num_rows($license_query);

            if ($result > 0) {
                while ($file_row = mysqli_fetch_array($medex_query)) {
                    $file_name = $file_row['medex']; 
                    if ($file_name !== null) {
                        echo '<a href="' . htmlspecialchars($direktori . $file_name) . '" target="_blank">' . htmlspecialchars($file_name) . '</a>';
                    }else{
                      echo "File belum di upload";
                    }
                }
            } else {
                echo "File belum di upload";
            }
            ?>

              <td>
              <?php
            $id_user = $row['id_user'];

            $rate_query = mysqli_query($koneksi, "SELECT rating FROM files WHERE id_user = " . $id_user);
            $result = mysqli_num_rows($license_query);

            if ($result > 0) {
                while ($file_row = mysqli_fetch_array($rate_query)) {
                    $file_name = $file_row['rating'];
                    if ($file_name !== null) {
                        echo '<a href="' . htmlspecialchars($direktori . $file_name) . '" target="_blank">' . htmlspecialchars($file_name) . '</a>';
                    }else{
                      echo "File belum di upload";
                    }
                }
            } else {
                echo "File belum di upload";
            }
            ?>
              </td>

              </tr>
              <?php
          }
          ?>
                 </tbody>
                </table>
              </div>
</body>
</html>

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