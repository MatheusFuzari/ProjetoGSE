<?php
include '../database.php';
var_dump($_POST);
$nome = mysqli_escape_string($connect, $_POST['nome']);
if ($_POST['send'] == 'Criar') {
    $sql = "INSERT INTO `turmas`(`name_turma`) VALUES ('$nome')";
    if (mysqli_query($connect, $sql)) {
        header('Location:../../html/admin.php?set=turmas');
    } else {
        echo 'Error';
    }
} else {
    header('Location:../../html/admin.php?set=turmas');
}
