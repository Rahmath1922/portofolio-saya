<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'function.php';

//Data url
$id = $_GET["id"];

//QUERY data siswa berdasarkan id
$mhs = query("SELECT * FROM data_siswa WHERE id = $id")[0];

if( isset($_POST["submit"]) ) {
//Cek apakah data berhasil diubah atau gagal
if( edit($_POST) > 0 ) {
    echo "
    <script>
    alert('Data berhasil diubah!');
    document.location.href = 'admin_depan.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('Data gagal diubah!');
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
    <title>Edit data siswa</title>
</head>
<body>

<a href="admin_depan.php" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">Kembali</a>


    <h1 style="text-align: center;">Edit data siswa</h1>

    <form action="" method="post" style="max-width: 400px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <div style="margin-bottom: 10px;">
            <label for="name" style="display: inline-block; width: 100px;"> Name :</label>
            <input type="text" name="name" id="name" style="width: calc(100% - 110px); padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required value="<?= $mhs["name"]; ?>">
        </div>
        <div style="margin-bottom: 10px;">
            <label for="nim" style="display: inline-block; width: 100px;"> NIM :</label>
            <input type="text" name="nim" id="nim" style="width: calc(100% - 110px); padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required value="<?= $mhs["nim"]; ?>">
        </div>
        <div style="margin-bottom: 10px;">
            <label for="city" style="display: inline-block; width: 100px;"> CITY :</label>
            <input type="text" name="city" id="city" style="width: calc(100% - 110px); padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required value="<?= $mhs["city"]; ?>">
        </div>
        <div style="margin-bottom: 10px;">
            <label for="email" style="display: inline-block; width: 100px;"> EMAIL :</label>
            <input type="text" name="email" id="email" style="width: calc(100% - 110px); padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required value="<?= $mhs["email"]; ?>">
        </div>
        <button type="submit" name="submit" style="background-color: #4CAF50; color: white; border: none; border-radius: 5px; padding: 10px 20px; cursor: pointer; width: 100%;">EDIT</button>
    </form>
</body>
</html>
