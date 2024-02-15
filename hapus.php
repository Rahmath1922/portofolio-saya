<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'function.php';

// Periksa apakah parameter id diset dan bukan null
if (isset($_GET["id"]) && $_GET["id"] !== "") {
    $id = $_GET["id"];

    // Panggil fungsi hapus dengan id yang diberikan
    if (hapus($id) > 0) {
        echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = 'admin_depan.php';
            </script>";
        exit;
    } else {
        echo "<script>
            alert('Data gagal dihapus!');
            document.location.href = 'admin_depan.php';
            </script>";
        exit;
    }
} else {
    echo "<script>
        alert('ID tidak valid!');
        document.location.href = 'admin_depan.php';
        </script>";
    exit;
}
?>
