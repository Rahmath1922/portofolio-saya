<?php
require 'function.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query data ke tabel
    $query = "SELECT * FROM keterangan_siswa WHERE id = $id";
    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>





