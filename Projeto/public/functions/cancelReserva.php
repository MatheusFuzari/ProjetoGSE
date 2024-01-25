<?php
    include '../database.php';
    var_dump($_POST);
    $id = mysqli_escape_string($connect,$_POST['id_reserva']);
    $sql = "UPDATE reservas SET reserva_canela = 1 WHERE id_reserva = $id";
    if(mysqli_query($connect,$sql)){
        header("Location:../../html/suasReservas.php");
    }else{
        echo "Erro!";
    }