<?php
include '../database.php';
$id = mysqli_escape_string($connect, $_POST['id']);
$name = mysqli_escape_string($connect, $_POST['nome']);
$send = mysqli_escape_string($connect, $_POST['send']);
if ($send == 'Atualizar') {
  $sql = "UPDATE salas SET name_sala='$name' WHERE id_sala = '$id'";
  if (mysqli_query($connect, $sql)) {
    header('Location:../../html/admin.php?set=salas');
  } else {
    echo 'Erro ao atualizar!' + mysqli_error($connect);
  }
} else {
  echo 'Erro ao atualizar!';
}
