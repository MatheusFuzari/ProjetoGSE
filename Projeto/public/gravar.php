<?php
$imagem = $_FILES['imagem'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$id = $_POST['id'];
$host = "localhost";
$username = "root";
$password = "";
$dbname = "gse";
if ($imagem[0] != NULL) {
  $nomefinal = time() . ".jpg";
  if (move_uploaded_file($imagem['tmp_name'], $nomefinal)) {
    $tamanhoImg = filesize($nomefinal);
    $mysqlImg = addslashes(fread(fopen($nomefinal, "r"), $tamanhoImg));
    $sql = mysqli_connect($host, $username, $password, $dbname) or die("Não foi possível conectar ao banco");
    mysqli_query($sql, "UPDATE professores SET pic_prof = '$mysqlImg', name_prof = '$nome', email_prof='$email' WHERE id_prof = $id") or die(mysqli_error($sql));
    unlink($nomefinal);
    header("Location:./../html/menu.php");
  }
} else {
  $sql = mysqli_connect($host, $username, $password, $dbname) or die("Não foi possível conectar ao banco");
  mysqli_query($sql, "UPDATE professores SET name_prof = '$nome', email_prof='$email' WHERE id_prof = $id") or die(mysqli_error($sql));
  header("Location:./../html/menu.php");
}
