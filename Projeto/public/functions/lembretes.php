<?php
include '../database.php';
$id_reserva = mysqli_escape_string($connect, $_POST['id_reserva']);
$text = mysqli_escape_string($connect, $_POST['text']);
$sql = "INSERT INTO `lembretes`(`text_lembrete`, `id_reserva_fk`) VALUES ('$text','$id_reserva')";
$teste = "SELECT * FROM `lembretes` WHERE id_reserva_fk = $id_reserva";
$dTeste = mysqli_query($connect, $teste);
if (mysqli_num_rows($dTeste) >= 1) {
  header('Location:../../html/suasReservas.php');
} else {
  if (mysqli_query($connect, $sql)) {
    header('Location:../../html/menu.php');
  } else {
    echo 'Erro! ' . mysqli_error($connect);
  }
}
