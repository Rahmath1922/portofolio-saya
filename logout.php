<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

header("location: login.php");
exit;

require 'function.php';
$id = $_GET["id"];

if( hapus($id) > 0) {
    echo "
    <script>
    alert('Data berhasil dihapus!');
    document.location.href = 'admin_depan.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('Data gagal dihapus!');
    document.location.href = 'admin_depan.php';
    </script>
    ";
}

?>