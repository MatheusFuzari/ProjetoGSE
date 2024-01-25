<?php
include '../database.php';
$id = mysqli_escape_string($connect, $_POST['id']);
$senha = mysqli_escape_string($connect, $_POST['senha']);
$nSenha = mysqli_escape_string($connect, $_POST['newSenha']);
if (isset($_POST['submitSenha']) == 'Trocar') {
  $sql = "SELECT * FROM professores WHERE id_prof = $id AND pass_prof = md5('$senha')";
  $retorno = mysqli_query($connect, $sql);
  if (mysqli_num_rows($retorno) != 1) {
    header('Location:../../html/menu.php?e=3');
  } else {
    $sql = "UPDATE `professores` SET pass_prof = md5('$nSenha') WHERE id_prof = $id";
    $retorno = mysqli_query($connect, $sql);
    header('Location:../../html/menu.php');
  }
}
