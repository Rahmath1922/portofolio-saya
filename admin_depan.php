<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'function.php';

// Tombol search 
if (isset($_POST["cari"])) {
    $data_siswa = cari($_POST["keyword"]);
} else {
    // Jika tidak ada pencarian, tampilkan semua data siswa
    $data_siswa = query("SELECT * FROM data_siswa");
}

// Proses penghapusan data jika ada permintaan dari AJAX
if (isset($_POST['hapus_terpilih']) && $_POST['hapus_terpilih'] == 1 && isset($_POST['ids'])) {
    $ids = explode(',', $_POST['ids']);
    foreach ($ids as $id) {
        hapus($id);
    }
    exit; // Keluar dari skrip PHP setelah penghapusan selesai
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>

<a href="logout.php" onclick="return confirm('Yakin ingin logout?')" style="display: inline-block; padding: 10px 20px; background-color: #dc3545; color: #fff; text-decoration: none; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">Logout</a>

<h1>Data Mahasiswa</h1>

<a href="tambah.php">
    <button style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">TAMBAH DATA MAHASISWA</button>
</a>
<br>    

<form action="" method="post" style="margin-top: 20px; margin-bottom: 20px;">
    <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan data yang ingin dicari..." autocomplete="off" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
    <button type="submit" name="cari" style="padding: 8px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">Cari</button>
</form>

<?php if(isset($_POST["cari"])): ?>
    <a href="admin_depan.php" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">Kembali</a>
<?php endif; ?>

<form action="" method="post">
    <button type="button" id="deleteButton" style="display: none; padding: 8px 20px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer; margin-bottom: 20px;">Hapus Terpilih</button>
    <button type="button" id="cancelButton" style="display: none; padding: 8px 20px; background-color: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; margin-bottom: 20px;">Batal</button>
</form>
<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-top: 20px; overflow-y: scroll;">
    <tr>
        <th style="background-color: #f2f2f2; padding: 8px; border-bottom: 1px solid #ddd;"><input type="checkbox" id="selectAll" /></th>
        <th style="background-color: #f2f2f2; padding: 8px; border-bottom: 1px solid #ddd;">NO</th>
        <th style="background-color: #f2f2f2; padding: 8px; border-bottom: 1px solid #ddd;">EDIT</th>
        <th style="background-color: #f2f2f2; padding: 8px; border-bottom: 1px solid #ddd;">NAMA</th>
        <th style="background-color: #f2f2f2; padding: 8px; border-bottom: 1px solid #ddd;">NIM</th>
        <th style="background-color: #f2f2f2; padding: 8px; border-bottom: 1px solid #ddd;">KOTA</th>
        <th style="background-color: #f2f2f2; padding: 8px; border-bottom: 1px solid #ddd;">EMAIL</th>
    </tr>

    <?php $a = 1; ?>   
    <?php foreach ($data_siswa as $row) : ?>   
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><input type="checkbox" name="checked_ids[]" value="<?= $row['id']; ?>"></td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?= $a; ?></td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                <a href="edit.php?id=<?= $row["id"]; ?>">
                    <button style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; border-radius: 3px; cursor: pointer;">Edit</button>
                </a>
                <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin ingin menghapus data?');">
                        <button style="padding: 5px 10px; background-color: #ffc107; color: #000; border: none; border-radius: 3px; cursor: pointer;">Hapus</button>
                </a>
            </td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?= $row["name"]; ?></td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?= $row["nim"]; ?></td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?= $row["city"]; ?></td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?= $row["email"]; ?></td>
        </tr>
        <?php $a++; ?>
    <?php endforeach; ?>
</table>


<script>
var konfirmasiMuncul = false;

document.getElementById('selectAll').addEventListener('change', function(event) {
    var checkboxes = document.querySelectorAll('input[name="checked_ids[]"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = event.target.checked;
    });
    toggleButtonVisibility();
});

document.querySelectorAll('input[name="checked_ids[]"]').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        toggleButtonVisibility();
    });
});

function toggleButtonVisibility() {
    var deleteButton = document.getElementById('deleteButton');
    var cancelButton = document.getElementById('cancelButton');
    var checkboxes = document.querySelectorAll('input[name="checked_ids[]"]');
    var checkedCount = Array.from(checkboxes).filter(function(checkbox) {
        return checkbox.checked;
    }).length;
    if (checkedCount > 0) {
        deleteButton.style.display = 'block';
        cancelButton.style.display = 'block';
    } else {
        deleteButton.style.display = 'none';
        cancelButton.style.display = 'none';
    }
}

document.getElementById('deleteButton').addEventListener('click', function() {
    if (!konfirmasiMuncul && !confirm('Apakah Anda yakin ingin menghapus data yang dipilih?')) {
        return;
    }
    konfirmasiMuncul = true;

    var checkboxes = document.querySelectorAll('input[name="checked_ids[]"]:checked');
    var ids = Array.from(checkboxes).map(function(checkbox) {
        return checkbox.value;
    });
    
    // Kirim permintaan AJAX untuk menghapus data langsung dari halaman ini
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'admin_depan.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Refresh halaman setelah data terhapus
            window.location.reload();
        } else {
            alert('Terjadi kesalahan saat menghapus data.');
        }
    };
    xhr.send('hapus_terpilih=1&ids=' + ids.join(','));
});

document.getElementById('cancelButton').addEventListener('click', function() {
    var checkboxes = document.querySelectorAll('input[name="checked_ids[]"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
    });
    toggleButtonVisibility();
});
</script>

</body>
</html>
