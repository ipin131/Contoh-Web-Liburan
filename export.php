<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="img/logo_airnavsub.png">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
</head>
<body>
    <a href="list-cuti.php?page=21232f297a57a5a743894a0e4a801fc3"><- Back</a>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Initial</th>
                <th>Mulai Tanggal</th>
                <th>Sampai Tanggal</th>
                <th>Waktu Pengajuan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once('function/koneksi.php');
            $query = mysqli_query($koneksi, "SELECT * FROM cuti ORDER by id_cuti");
            $i = 1;
            while($row = mysqli_fetch_assoc($query)){
                ?>
            <tr>
                <td><?=$i++?></td>
                <td><?=htmlspecialchars($row['nama'])?></td>
                <td><?=htmlspecialchars($row['username'])?></td>
                <td><?=date("d-m-Y",strtotime($row['datestart']))?></td>
                <td><?=date("d-m-Y",strtotime($row['dateend']))?></td>
                <td><?=date("d-m-Y H:i:s",strtotime($row['time']))?></td>
            </tr>
        <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Initial</th>
                <th>Mulai Tanggal</th>
                <th>Sampai Tanggal</th>
                <th>Waktu Pengajuan</th>
            </tr>
        </tfoot>
    </table>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>

    <script>
        new DataTable('#example', {
    layout: {
        topStart: {
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    }
});
    </script>

</body>
</html>