<?php

require_once('../function/helper.php');
require_once('../function/koneksi.php');
session_start();
unset($_SESSION['id_cuti']);
unset($_SESSION['id_user']);
session_unset();
session_destroy();
header("Location: ../index.php");
?>
