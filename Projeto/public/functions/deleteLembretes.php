<?php
include '../database.php';
$id = mysqli_escape_string($connect, $_GET['id']);
if ($id != '') {
  $sql = "DELETE FROM lembretes WHERE id_lembrete = $id";
  if (mysqli_query($connect, $sql)) {
    header('Location:../../html/suasReservas.php');
  } else {
    echo 'Erro!';
  }
} else {
  echo 'Erro!';
}
