<?php
include '../database.php';
$id = mysqli_escape_string($connect, $_POST['id']);
if (isset($_POST['send']) and $_POST['send'] == 'Sim') {
  $sql = "DELETE FROM prof_turma WHERE id_pro_tur = $id";
  if (mysqli_query($connect, $sql)) {
    header('Location:../../html/admin.php?set=profTur');
  } else {
    mysqli_error($connect);
  };
} else {
  header('Location:../../html/admin.php?set=profTur');
}
