<?php
include_once('database.php');

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Firebase\JWT\JWT;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->load();


$sql = "SELECT * FROM professores WHERE email_prof = '$_POST[email]'";
$dados = mysqli_query($connect, $sql);

function testEmail($d)
{
  if ($id = mysqli_fetch_array($d)) {
    return $id['id_prof'];
  } else {
    return "Error352";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GSE</title>
  <link rel="stylesheet" href="../css/login.css" />
  <link rel="icon" href="../img/logo3.png" />
</head>

<body>
  <?php
  if (isset($_POST["send"])) {
    $id = testEmail($dados);
    if ($id != "Error352") {
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
      $mail->addAddress($_POST['email']);
      $mail->Subject = "Alteracao de senha!"; //assunto
      $payload = [
        "exp" => time() + 1800,
        "iat" => time(),
        "id" => $id
      ];
      $encode = JWT::encode($payload, $_ENV['KEY'], 'HS256');
      $mail->Body = "Aqui um link para alteração de sua senha!\nhttp://localhost/Projeto/html/esqueceusenha2?jwt=$encode.html";
      $mail->send();
  ?>
      <div id="login" class="login">
        <center><img class="logo1" src="../img/logo1.png" /></center>
        <div class="card-content">
          <center><h3 style="color: white;">Se atente ao email<br>Sua solicitação chegara a qualquer momento</h3></center>
        </div>
      </div>
  <?php
    } else {
      header('Location:../html/index.html?error=noemail');
    }
  }
  ?>
</body>

</html>