<?php 
$conn = mysqli_connect("localhost", "root", "", "data_mahasiswa"); 


function query($query) {
    global $conn;
    $resault = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($resault) ) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data) {
    global $conn;
    $name =htmlspecialchars($data["name"]);
    $nim = htmlspecialchars($data["nim"]);
    $city = htmlspecialchars($data["city"]);
    $email = htmlspecialchars($data["email"]);
  
$query = "INSERT INTO data_siswa
          VALUES
         ('', '$name', '$nim', '$city', '$email')";
mysqli_query($conn, $query); 

return mysqli_affected_rows($conn);
}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM data_siswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}


function edit($data) {
    global $conn;

    $id = $data["id"];
    $name =htmlspecialchars($data["name"]);
    $nim = htmlspecialchars($data["nim"]);
    $city = htmlspecialchars($data["city"]);
    $email = htmlspecialchars($data["email"]);
  
$query = "UPDATE data_siswa SET
         name = '$name',
         nim = '$nim',
         city = '$city',
         email = '$email'
         WHERE id = $id
         ";
mysqli_query($conn, $query); 

return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM data_siswa WHERE 
    name LIKE '%$keyword%' OR
    nim LIKE '%$keyword%' OR
    city LIKE '%$keyword%' OR
    email LIKE '%$keyword%'  
    ";

   return query($query);
}




?>