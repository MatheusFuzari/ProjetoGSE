<?php
include '../database.php';
var_dump($_POST);
$nome = mysqli_escape_string($connect, $_POST['nome']);
if ($_POST['send'] == 'Criar') {
    $sql = "INSERT INTO `salas`(`name_sala`) VALUES ('$nome')";
    if (mysqli_query($connect, $sql)) {
        header('Location:../../html/admin.php?set=salas');
    } else {
        echo 'Error';
    }
} else {
    header('Location:../../html/admin.php?set=salas');
}
