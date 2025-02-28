<?php
require_once('../function/koneksi.php');

// Ambil tanggal saat ini
$current_date = date('Y-m-d');

// Query untuk menghapus cuti yang sudah terlewat
$query = mysqli_query($koneksi, "DELETE FROM cuti WHERE dateend < '$current_date'");

?>