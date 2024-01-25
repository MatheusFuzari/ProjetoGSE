<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "gse";
$picNum = $_GET['picNum'];
$sql = mysqli_connect($host, $username, $password, $dbname) or die("Não foi possível conectar ao banco");
$result = mysqli_query($sql, "SELECT * FROM professores WHERE id_prof=$picNum");
$row = mysqli_fetch_object($result);
header("Content-Type: image/gif");
echo $row->pic_prof;
