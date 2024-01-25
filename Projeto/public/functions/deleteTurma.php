<?php
include '../database.php';
$id = mysqli_escape_string($connect, $_POST['id']);
if (isset($_POST['send']) and $_POST['send'] == 'Sim') {
  $sql = "DELETE FROM turmas WHERE id_turma = $id";
  if (mysqli_query($connect, $sql)) {
    header('Location:../../html/admin.php?set=turma');
  } else {
    mysqli_error($connect);
  }
} else {
  header('Location:../../html/admin.php?set=turma');
}
