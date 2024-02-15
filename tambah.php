<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'function.php';

if( isset($_POST["submit"]) ) {
    //Cek apakah data berhasil dimasukkan atau gagal
    if( tambah($_POST) > 0 ) {
        echo "
        <script>
        alert('Data berhasil ditambahkan!');
        document.location.href = 'tambah.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Data gagal ditambahkan!');
        document.location.href = 'tambah.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data siswa</title>
</head>
<body>

<a href="admin_depan.php" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">Kembali</a>

<div style="max-width: 400px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <h1 style="text-align: center;">Tambah data siswa</h1>

    <form action="" method="post">
        <ul style="list-style: none; padding: 0; margin: 0;">
            <li style="margin-bottom: 15px;">
                <label for="name" style="display: block; margin-bottom: 5px;">NAMA:</label>
                <input type="text" name="name" id="name" required style="width: calc(100% - 10px); padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </li>
            <li style="margin-bottom: 15px;">
                <label for="nim" style="display: block; margin-bottom: 5px;">NIM:</label>
                <input type="text" name="nim" id="nim" required style="width: calc(100% - 10px); padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </li>
            <li style="margin-bottom: 15px;">
                <label for="city" style="display: block; margin-bottom: 5px;">KOTA:</label>
                <input type="text" name="city" id="city" required style="width: calc(100% - 10px); padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </li>
            <li style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px;">EMAIL:</label>
                <input type="text" name="email" id="email" required style="width: calc(100% - 10px); padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </li>
            <li>
                <button type="submit" name="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">KIRIM</button>
            </li>
        </ul>
    </form>
</div>

</body>
</html>
