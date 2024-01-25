<?php
include_once('../database.php');
require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Firebase\JWT\JWT;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 3));
$dotenv->load();

var_dump($_POST);
if ($_POST['Submited'] == 'Solicitar') {
  $sql = "SELECT * FROM reservas WHERE id_sala_fk = $_POST[reserva] and time_reserva_init<now() AND time_reserva_end>now()";
  $dados = mysqli_query($connect, $sql);
  $idReserva = '';
  while ($row = mysqli_fetch_array($dados)) {
    var_dump($row);
    if ($row['id_prof_turma_fk'] == $_POST['id']) {
      header("Location:./../../html/menu.php?e=2");
    } else {
      $idReserva = $row['id_reserva'];
    }
  };
  $sql = "SELECT * FROM professores p join prof_turma t on p.id_prof = t.id_prof_fk join reservas r on t.id_pro_tur = r.id_prof_turma_fk WHERE id_reserva = $idReserva";
  $dados = mysqli_query($connect, $sql);
  $email = '';
  while ($row = mysqli_fetch_array($dados)) {
    $email = $row['email_prof'];
  };
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->SMTPDebug = 0;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Host = "smtp.gmail.com";
  $mail->Username = "gsepasschange@gmail.com";
  $mail->Password = "naocucbuhxriaamm"; // Gmail app naocucbuhxriaamm // Gmail account AHBFSYF@&*(%&(@*%&JHGFUAFGAUHFGFU&@#%*@%&
  $mail->Port = 587;
  $mail->setFrom('gsepasschange@gmail.com', 'Sistema GSE');
  $mail->addAddress($email);
  $mail->Subject = "Sobreposição de Reserva"; //assunto
  $payload = [
    "exp" => time() + 1800,
    "iat" => time(),
    "id" => $_POST['id'],
    "reserva" => $idReserva
  ];
  $encode = JWT::encode($payload, $_ENV['KEY'], 'HS256');
  $mail->Body = "Um professor está pedindo sua reserva, responda a ele: \nhttp://localhost/Projeto/html/sobreReserva?jwt=$encode.php";
  $mail->send();
  echo $mail->ErrorInfo;
} else {
  echo '...';
};
