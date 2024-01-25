<?php
include '../database.php';
$id = mysqli_escape_string($connect, $_POST['id']);
if (isset($_POST['send']) and $_POST['send'] == 'Sim') {
  $sql = "DELETE FROM salas WHERE id_sala = $id";
  if (mysqli_query($connect, $sql)) {
    header('Location:../../html/admin.php?set=salas');
  } else {
    mysqli_error($connect);
  }
} else {
  header('Location:../../html/admin.php?set=salas');
}
