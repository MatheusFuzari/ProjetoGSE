<?php
include '../public/database.php';
session_start();
date_default_timezone_set('America/Sao_Paulo');
$dia = date('Y-m-d');
$hora = date('H:i:sa');
$datehora = $dia . " " . $hora;
if (strpos($datehora, 'am')) {
  $datehora = str_replace('am', '', $datehora);
} else if (strpos($datehora, 'pm') !== false) {
  $datehora = str_replace('pm', '', $datehora);
};
$sql = "SELECT * FROM professores WHERE id_prof = $_SESSION[id]";
$dados = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_array($dados)) {
?>
  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <title>GSE</title>
    <link rel="stylesheet" href="../css/reservas.css">
    <link rel="icon" href="../img/logo3.png">
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/fontawesome.css" />
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/brands.css" />
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/solid.css" />
  </head>

  <body onload="getError()">
    <header>
      <div class="box">
        <ul>
          <div class="dropdown">
            <a class="dropdownTitle" href=""><img id="logo" src="../img/logo4.png"></a>
            <div class="dropdown-content">
              <li onclick="document.getElementById('perfil').style.display = 'block'">
                <img id="teacher" src="./../public/getImage.php?picNum=<?php echo $row['id_prof']; ?>">
                <p class="name-teacher"><?php echo $row['name_prof']; ?></p>
              </li>
              <div class="modal" id='perfil'>
                <div class="perfil">
                  <form action="./../public/gravar.php" method="post" enctype="multipart/form-data">
                    <span class='fechar' onclick="document.getElementById('perfil').style.display = 'none';">&times;</span>
                    <input type="submit" value="Salvar" class="btnSalvar">
                    <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id">
                    <div class="conteiner">
                      <div class='imgConteiner'>
                        <img src="./../public/getImage.php?picNum=<?php echo $row['id_prof']; ?>" class="imgPerfil" />
                        <div class="inputImg"> <!-- Deixar bem pequeno mas clicavel -->
                          <label for="file-upload" class="custom-file-upload">
                            <i class="fa-regular fa-camera-rotate"></i>
                          </label>
                          <input id="file-upload" type="file" accept="image/jpeg,image/png,image/webp" name="imagem" />
                        </div>
                      </div>
                      <div class="nomeInput">
                        <input type="text" name="nome" class="nome" value="<?php echo $row['name_prof']; ?>" />
                        <span class="nomeSpan">Nome</span>
                      </div>
                      <div class="emailInput">
                        <input type="text" name="email" class="email" value="<?php echo $row['email_prof'] ?>" />
                        <span class="emailSpan">E-mail</span>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </ul>
      <?php } ?>
      <nav>
        <ul>
          <li><a href="./menu.php">MAPA</a></li>
        </ul>
      </nav>
      </div>
      <div class="about">
        <h1>Olá Seja Bem-Vindo <br> Aqui você pode ver suas agendas</h1>
      </div>
      <img id="astronauta" src="../img/astronauta.png">
    </header>
    <div class="reservaGrid">
      <p>Lembrete</p>
      <p>Reserva</p>
      <p>Sala</p>
      <p>Status</p>
      <p>Inicio</p>
      <p>Fim</p>
      <p></p>
    </div>
    <hr style="margin-bottom: 25px">
    <div class='reservaGrid'>
      <?php
      $anot = [];
      $sql = "SELECT * FROM reservas r join prof_turma pt on r.id_prof_turma_fk = pt.id_pro_tur join salas s on r.id_sala_fk = s.id_sala WHERE pt.id_prof_fk = $_SESSION[id] and 
    r.time_reserva_end>now() and r.reserva_canela is null";
      $sqlAnot = "SELECT * from lembretes l join reservas r on l.id_reserva_fk = r.id_reserva join salas s on r.id_sala_fk = s.id_sala WHERE s.name_sala LIKE 'A-%' AND 
    r.time_reserva_end>now()";
      $dadosA = mysqli_query($connect, $sqlAnot);
      while ($a = mysqli_fetch_array($dadosA)) {
        array_push($anot, $a['id_reserva_fk'], $a['text_lembrete'], $a['id_lembrete']);
      };
      $dados = mysqli_query($connect, $sql);
      $i = 0;
      $a = 0;
      while ($row = mysqli_fetch_array($dados)) {
        if (in_array($row['id_reserva'], $anot)) {
          $i = array_search($row['id_reserva'], $anot); // SEMPRE VAI SER INDEX+1
          echo "
        <textarea readonly style='resize: none;'>" . $anot[($i + 1)] . "</textarea>
          <p>$row[id_reserva] </p> 
          <p>$row[name_sala] </p> <p>";
          if ($row['time_reserva_init'] > $datehora) {
            echo "Inativa";
          } else {
            echo "Ativa";
          };
          echo "</p>
          <p>$row[time_reserva_init] </p> 
          <p>$row[time_reserva_end]</p>
         
        <div class='div-flex'>
          <button onclick=" . "document.getElementById('modal$a').style.display='block'" . ">Adicionar Lembrete</button>
          <button><a href='./../public/functions/deleteLembretes.php?id=" . $anot[($i + 2)] . "'>Deletar Lembrete</a></button>
          <button onclick=" . "document.getElementById('modalC$a').style.display='block'" . ">Cancelar</button>
        </div>
            
        ";
        } else {
          echo "
          <p></p>
          <p>$row[id_reserva] </p>
          <p>$row[name_sala] </p>";
          if ($row['time_reserva_init'] > $datehora) {
            echo "Inativa";
          } else {
            echo "Ativa";
          };
          echo "
          <p>$row[time_reserva_init] </p>
          <p> $row[time_reserva_end]</p>
          <div class='div-flex'>
          <button onclick=" . "document.getElementById('modal$a').style.display='block'" . ">Adicionar Lembrete</button>
          <button onclick=" . "document.getElementById('modalC$a').style.display='block'" . ">Cancelar</button>
          </div>
        ";
        };
        echo "
      <div id='modal$a' class='modal' style='display: none;'>
        <div class='modal-content'>
          <span onclick=" . "document.getElementById" . "('modal$a').style.display='none'>&times;</span>
          <form action='../public/functions/lembretes.php' method='post'>
            <input type='hidden' value='$row[id_reserva]' name='id_reserva'>
            <h3>Adicionar Lembrete!</h3>
            <p>Digite aqui:</p>
            <textarea id='freeform' name='text' rows='4' cols='50' style='resize: none;'></textarea>
            <br>
            <button type='submit'>Enviar</button>
          </form>
        </div>
      </div>
      <div id='modalC$a' class='modal' style='display: none;'>
        <div class='modal-content'>
          <span onclick=" . "document.getElementById" . "('modalC$a').style.display='none'>&times;</span>
          <form action='../public/functions/cancelReserva.php' method='post'>
            <input type='hidden' value='$row[id_reserva]' name='id_reserva'>
            <h3>Cancelar Reserva!</h3>
            <p>Deseja mesmo cancelar esta reserva?</p>
            <br>
            <button type='submit'>Sim</button>
            <button onclick=" . "document.getElementById('modalC$a').style.display='none'" . " type='button'>Não</button>
          </form>
        </div>
      </div>";
        $i += 1;
        $a += 1;
      };
      ?>
    </div>
    <hr>
  </body>