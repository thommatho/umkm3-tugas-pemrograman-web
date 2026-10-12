<?php
include '../koneksi.php';

$dari = $_GET['dari'] ?? '';
$sampai = $_GET['sampai'] ?? '';

$where = "";
if (!empty($dari) && !empty($sampai)) {
    $where = "WHERE tanggal BETWEEN '$dari' AND '$sampai'";
}

$query = mysqli_query($conn, "
    SELECT 
        tanggal,
        COALESCE(SUM(jumlah),0) as total
    FROM v_laporan_pembelian
    $where
    GROUP BY tanggal
    ORDER BY tanggal ASC
");

$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);