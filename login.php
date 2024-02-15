<?php
session_start();
if( isset($_SESSION["login"]) ){
    header("Location: admin_depan.php");
    exit;
}

require ("variable.php");
$username = "";
$password = ""; 
$err = "";

if (isset($_POST['login'])){    
    $username = $_POST['username'];
    $password = $_POST['password'];
    if($username === '' or $password === ''){
        $err .= "<div style='color: #ff0000; background-color: #ffebee; padding: 10px; border: 1px solid #ff0000; border-radius: 5px; margin-bottom: 10px;'>Silahkan masukkan username dan password</div>";
    }   
    
    if (empty($err)){
        $sql1 = "SELECT * FROM admin WHERE username = '$username'";
        $q1 = mysqli_query($koneksi,$sql1);
        $r1 = mysqli_fetch_array($q1);
        if (!empty($r1)) {
            if ($r1['password'] != md5($password)){
                $err .="<div style='color: #ff0000; background-color: #ffebee; padding: 10px; border: 1px solid #ff0000; border-radius: 5px; margin-bottom: 10px;'>Akun tidak ditemukan atau password salah</div>";          
            } else {
                $_SESSION['admin_username'] = $username;
                $_SESSION["login"] = true;
                header("location:admin_depan.php");
                exit();
            }
        } else {
            $err .="<div style='color: #ff0000; background-color: #ffebee; padding: 10px; border: 1px solid #ff0000; border-radius: 5px; margin-bottom: 10px;'>Akun tidak ditemukan</div>";      
        }
    }
    
    if(empty($err)){
        $_SESSION['admin_username'] = $username;
        $_SESSION["login"] = true;
        header("location:admin_depan.php");
        exit();
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="app">
        <h1>Halaman Login</h1>
        <?php
        if($err){
            echo "<ul>$err</ul>";
        } 
        ?>
        <form action="" method="post">
            <input type="text" value="<?php echo $username ?>" name="username" class="input" placeholder="Isikan username..." /><br>
            <input type="password" name="password" class="input" placeholder="Masukan password..." /><br>
            <button type="submit" name="login" value="Login" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">Login</button>

        </form>
    </div>
</body>
</html>