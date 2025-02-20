<?php
include('koneksi.php');

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'edit':
            edit();
            break;
        case 'hapus':
            hapus();
            break;
    }
}

function edit() {
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id'");
    exit;
}

function hapus() {
    echo "The insert function is called.";
    exit;
}
?>
