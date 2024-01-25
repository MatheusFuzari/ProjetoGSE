<?php
require_once('database.php');
var_dump($_POST, $_GET);
$id = mysqli_escape_string($connect, $_GET['id']);
$pass = mysqli_escape_string($connect, $_POST['pass']);
$passConfirm  = mysqli_escape_string($connect, $_POST['passConfirm']);
$id = str_replace('.php', '', $id);
echo $id;
if ($pass == $passConfirm) {
  $sql = "UPDATE professores SET pass_prof = md5('$pass') WHERE id_prof = $id";
  if (mysqli_query($connect, $sql)) {
    header("Location:../html/index.html");
  } else {
    echo mysqli_error($connect);
  }
} else {
  header("Location:../html/esqueceusenha2.html?id=$id&error=124");
}
