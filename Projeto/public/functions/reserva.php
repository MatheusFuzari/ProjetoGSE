<?php
session_start();
include '../database.php';
$type = mysqli_escape_string($connect, $_POST['type']);
$date = mysqli_escape_string($connect, $_POST['date_reserva']);
$init = mysqli_escape_string($connect, $_POST['time_reserva_init']);
$end = mysqli_escape_string($connect, $_POST['time_reserva_end']);
$sala = mysqli_escape_string($connect, $_POST['id_sala']);
$pro_tur = mysqli_escape_string($connect, $_POST['pro_turma']);
$init = str_replace('T', ' ', $init);
$init = $init . ':00';
$end = str_replace('T', ' ', $end);
$end = $end . ':00';
$dayofweek = date('w', strtotime($init));
var_dump($dayofweek);
$Teste1 = false;
$Teste2 = false;
$Teste3 = false;
$sqlQuery = "SELECT * FROM reservas WHERE time_reserva_init = '$init' and id_sala_fk = $sala and reserva_canela is null and id_sala_fk = $sala";
$daw = mysqli_query($connect, $sqlQuery);
if (mysqli_num_rows($daw) >= 1) {
     $Teste1 = false;
} else {
     $Teste1 = true;
};
$sqlQuery2 = "SELECT * FROM reservas WHERE id_sala_fk = $sala and reserva_canela is null and time_reserva_init BETWEEN '$init' and '$end'";
$daw2 = mysqli_query($connect, $sqlQuery2);
if (mysqli_num_rows($daw2) >= 1) {
     $Teste2 = false;
} else {
     $Teste2 = true;
};
if (round((strtotime($date) - strtotime($init)) / 3600, 1) <= -48) { // date diff
     $Teste3 = true;
};
if (isset($_POST['Submited']) and $Teste1 and $Teste2 and $Teste3) {
     if ($type == 0) {
          $sql = "INSERT into reservas(`type_reserva`, `date_reserva`, `time_reserva_init`, `time_reserva_end`, `id_sala_fk`, `id_prof_turma_fk`) values 
          ('0','$date','$init','$end','$sala','$pro_tur'),";
          $start_date = $init;
          $stop_date = $end;
          for ($a = intval($dayofweek); $a < 5; $a += 1) {
               $start_date = date('Y-m-d H:i:s', strtotime($start_date . ' +1 day'));
               $stop_date = date('Y-m-d H:i:s', strtotime($stop_date . ' +1 day'));
               if ($a == 4) {
                    $sql = $sql . " ('0','$date','$start_date','$stop_date','$sala','$pro_tur')";
               } else {
                    $sql = $sql . " ('0','$date','$start_date','$stop_date','$sala','$pro_tur'),";
               }
          };
          echo $sql;
          if (mysqli_query($connect, $sql)) {
               header('Location:../../html/menu.php');
          } else {
               echo 'Erro';
               mysqli_error($connect);
          }
     } else {
          $sqlQuery = "SELECT * FROM reservas WHERE time_reserva_init = '$init' and id_sala_fk = $sala";
          $daw = mysqli_query($connect, $sqlQuery);
          $sql = "INSERT INTO reservas(`type_reserva`, `date_reserva`, `time_reserva_init`, `time_reserva_end`, `id_sala_fk`, `id_prof_turma_fk`) 
          VALUES ('$type','$date','$init','$end','$sala','$pro_tur')";
          if (mysqli_query($connect, $sql)) {
               header('Location:../../html/menu.php');
          } else {
               echo 'Erro';
               mysqli_error($connect);
          }
     }
} else {
     header('Location:../../html/menu.php?e=1');
}
