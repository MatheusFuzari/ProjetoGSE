<?php
include '../database.php';
$id = mysqli_escape_string($connect, $_POST['id']);
$name = mysqli_escape_string($connect, $_POST['nome']);
$email = mysqli_escape_string($connect, $_POST['email']);
$senha = mysqli_escape_string($connect, $_POST['senha']);
$send = mysqli_escape_string($connect, $_POST['send']);
if ($send == 'Atualizar') {
    if ($senha != '') {
        $sql = "UPDATE professores SET name_prof='$name', email_prof='$email', pass_prof = md5('$senha') WHERE id_prof = '$id'";
        if (mysqli_query($connect, $sql)) {
            header('Location:../../html/admin.php?set=prof');
        } else {
            echo 'Erro ao atualizar!' + mysqli_error($connect);
        }
    } else {
        $sql = "UPDATE professores SET name_prof='$name', email_prof='$email' WHERE id_prof = '$id'";
        if (mysqli_query($connect, $sql)) {
            header('Location:../../html/admin.php?set=prof');
        } else {
            echo 'Erro ao atualizar!' + mysqli_error($connect);
        }
    }
} else {
    echo 'Erro ao atualizar!';
}
