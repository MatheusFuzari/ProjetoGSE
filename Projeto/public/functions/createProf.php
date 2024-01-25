<?php
include '../database.php';
$nome = mysqli_escape_string($connect, $_POST['nome']);
$email = mysqli_escape_string($connect, $_POST['email']);
$senha = mysqli_escape_string($connect, $_POST['senha']);
if ($_POST['send'] == 'Criar') {
    $sql = "INSERT INTO `professores`(`name_prof`, `email_prof`, `pass_prof`) VALUES ('$nome','$email', md5('$senha'))";
    if (mysqli_query($connect, $sql)) {
        header('Location:../../html/admin.php?set=prof');
    } else {
        echo 'Error';
    }
} else {
    header('Location:../../html/admin.php?set=prof');
}
