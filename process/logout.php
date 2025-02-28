<?php

require_once('../function/helper.php');
require_once('../function/koneksi.php');
session_start();

$_SESSION['logout_message'] = "Anda telah berhasil logout.";

unset($_SESSION['id_cuti']);
unset($_SESSION['id_user']);

header("Location: ../index.php");
exit();

?>
