<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'function.php';

// Periksa apakah ada ID yang dikirim dari permintaan POST
if (isset($_POST['ids']) && !empty($_POST['ids'])) {
    // Pisahkan ID yang dipilih menjadi array
    $ids = explode(',', $_POST['ids']);
    
    // Loop melalui setiap ID dan hapus data yang sesuai
    foreach ($ids as $id) {
        // Hapus data menggunakan fungsi hapus yang telah Anda tentukan sebelumnya
        hapus($id);
    }
    
    // Beri respons bahwa penghapusan berhasil
    http_response_code(200);
    echo "Data berhasil dihapus.";
} else {
    // Beri respons bahwa tidak ada ID yang dikirim
    http_response_code(400);
    echo "Tidak ada ID yang dikirim untuk dihapus.";
}
?>
