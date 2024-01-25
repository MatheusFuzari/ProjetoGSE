<?php
include_once('../database.php');
if ($_POST['btn'] == 'Aceito') {
  //troca o id da reserva // ?? será?
  $sql = "UPDATE reservas SET id_prof_turma_fk = $_GET[id] where id_reserva = $_GET[re]";
  if (mysqli_query($connect, $sql)) {
    header('Location:../../html/menu.php');
  } else {
    echo 'Erro!';
  }
} else {
  //xesque dele do dale
}
