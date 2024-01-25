<?php
include '../database.php';
$id = mysqli_escape_string($connect, $_POST['id']);
$name = mysqli_escape_string($connect, $_POST['nome']);
$send = mysqli_escape_string($connect, $_POST['send']);
if ($send == 'Atualizar') {
  $sql = "UPDATE turmas SET name_turma='$name' WHERE id_turma = '$id'";
  if (mysqli_query($connect, $sql)) {
    header('Location:../../html/admin.php?set=turma');
  } else {
    echo 'Erro ao atualizar!' + mysqli_error($connect);
  }
} else {
  echo 'Erro ao atualizar!';
}
