<?php
require_once("database.php");
session_start();
$_SESSION['logged'] = false;
$username = mysqli_escape_string($connect, $_POST['usuario']);
$password = mysqli_escape_string($connect, $_POST['password']);
$sql = "SELECT * FROM professores WHERE email_prof = '$username' AND pass_prof = md5('$password')";
$exec = mysqli_query($connect, $sql);
if (mysqli_num_rows($exec) == 1) {
    $_SESSION['logged'] = true;
    while ($xesque = mysqli_fetch_array($exec)) {
        $_SESSION['nome'] = $xesque['name_prof'];
        $_SESSION['id'] = $xesque['id_prof'];
        header('Location:./../html/menu.php');
    }
} else {
    $_SESSION['logged'] = false;
    header('Location:./../html/index.html?error=nologin');
}
