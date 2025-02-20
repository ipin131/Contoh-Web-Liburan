<?php
require_once('function/helper.php');
require_once('function/koneksi.php');
?>
<?php
include "function/koneksi.php";

$msg = "";

?>
<html>
    <head>
    <meta charset="UTF-8">
        <title>Daftar</title>
        <link rel="icon" href="img/logo_airnavsub.png">
        <script src="dist/sweetalert2.all.min.js"></script>
        <style>
            body{
            background-color:darkblue;
            font-family: Calibri , sans-serif;
            }

            h1{
                color:white;
                font-size:xx-large;
                text-transform:300;
                text-align:center;
                margin-top:100px;
            }

            header{
                background-color:darkblue;
                color:white;
                padding:10px;
                position:fixed;
                top:0;
                left:0;
                width:100%;
            }

            section {
            background-color: #fff;
            padding: 30px 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin:80px auto;
            width:30%;
            border-radius:3px;
            margin-top:10px;
            }

            .img{
                margin:0 auto;
                display:block;
                max-width:200px;
            }

            .input-group{
                position:relative;
            }

            .input{
                border:solid 1.5px #9e9e9e;
                border-radius:3px;
                background:none;
                padding:15px;
                font-size:18px;
                color:black;
                text-decoration:none;
                margin-bottom:20px;
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

            input[type="checkbox"]{
                cursor:pointer;
                width:4%;
                height:4%;
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

            p{
                font-size:15px;
                margin-top:20px;
                margin-bottom:0px;
                font-size:18px;
            }

            .show-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #fff;
            border: none;
            padding: 5px;
            cursor: pointer;
            }

            .show-password:hover {
                background-color: #ccc;
            }

            .show-password:active {
                background-color: #aaa;
            }

            .teks{
                text-decoration:underline;
                text-align:center;
                color:blue;
                font-size:18px;
            }

            .p-ftr{
                color:lightgray;
                text-align:right;
                font-size:12px;
                align-items:flex-end;
                margin-top:-5%;
            }

            h2{
                font-size:17px;
                margin-bottom:1px;
                margin-top:-10px;
                text-decoration: none;
                font-weight: normal;
            }

            </style>
            </head>
            <body>
                <header>
                <a href="">
                <img src="img/new_logo.png" class="img">
                </a>
                </header>
                <h1> Silahkan DAFTAR </h1>
                <section>
                    <?php
                            if(isset($_POST['send'])){
                                $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
                                $username = $_POST['username'];
                                $password = md5($_POST['password']);
                                $role = $_POST['role'];
                            
                                $user = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' ");
                                $result = mysqli_num_rows($user);
                                if($result>0){
                                    $msg = "Initial ini telah terpakai, silahkan gunakan initial lainnya...!";
                            
                                }else{
                                    $query = mysqli_query($koneksi, "INSERT INTO user(nama,username,password,role) values('$nama','$username','$password','$role')");
                                if($query){
                            
                                    echo "<script src='dist/sweetalert2.all.min.js'></script>";
                                    echo "<script>
                                Swal.fire({
                                    title: 'Daftar akun berhasil!',
                                    text: 'Silahkan login!',
                                    icon: 'success',
                                    }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = 'index.php';
                                    }
                                    });
                            </script>";
                            }
                                }
                            
                                
                            }
                    ?>
                <form method="post" action="">
                    <div id="initialerror" style="color:red; margin-top:-20px; margin-bottom: 10px; font-weight:bold;"><?php echo $msg ?></div>
                    <div class="input-group">
                    <input type="text" name="nama" class="input"autocomplete="off" required>
                    <label class="label">Nama lengkap</label>
                    </div>
                    <div class="input-group">
                    <input type="text" name="username" class="input" autocomplete="off" required>
                    <label class="label">Initial</label>
                    </div>
                    <div class="input-group">
                    <input type="password" name="password" class="input" autocomplete="off" required>
                    <label class="label">Password</label>
                    </div>
                    <h2>Bagian</h2>
                    <select name="role" id="role">
                        <option>ATC</option>
                    </select>
                    <input type="submit" class="tombol-login" name="send" value="Daftar">
                    <p>Sudah buat akun? Silahkan <a href="index.php" class="teks">Login</a></p>
                </form>
        </section>
        <p class="p-ftr">© Copyright 2024 by AirNav Cabang Surabaya</p>
        </body>
        </html>
