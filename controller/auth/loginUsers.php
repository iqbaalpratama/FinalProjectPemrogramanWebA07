<?php
    include 'dbConnection.php';
    session_start();

    if(mysqli_num_rows(loginUsers(isset($_POST['Submit']))) == 1){
        $_SESSION["username"] = true;
        $_SESSION["role"] = "Users";
        header('Location: ../../index.php');
    }else {
        $_SESSION["gagal"] = "Gagal melakukan login";
        header('Location: ../../dashboard/auth/page-register-users.php');
    }
    exit();
?>