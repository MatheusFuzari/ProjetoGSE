<?php

session_start();
if ($_SESSION['logged'] == true) {
    include '../public/database.php';
    $dale = "SELECT * FROM prof_turma pt join turmas t on pt.id_turma_fk = t.id_turma WHERE pt.id_prof_fk = $_SESSION[id]";
    $tenta = mysqli_query($connect, $dale);
    $arrNome = array();
    $arrId = array();
    while ($turma = mysqli_fetch_array($tenta)) {
        array_push($arrNome, $turma['name_turma']);
        array_push($arrId, $turma['id_pro_tur']);
    };
} else {
    header('Location:./../html/index.html?error=nologin');
};
date_default_timezone_set('America/Sao_Paulo');
$sql = "SELECT * FROM professores WHERE id_prof = $_SESSION[id]";
$dados = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_array($dados)) {
?>


    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <title>GSE</title>
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/index.css">
        <link rel="stylesheet" href="../css/blocoaoriginal.css">
        <link rel="icon" href="../img/logo3.png">
        <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/fontawesome.css" />
        <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/brands.css" />
        <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/solid.css" />
    </head>

    <body>
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
                            <div class="modal-content" id='perfil'>
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
                                                <input type="text" name="nome" autocomplete="off" class="nome" value="<?php echo $row['name_prof']; ?>" />
                                                <span class="nomeSpan">Nome</span>
                                            </div>
                                            <div class="emailInput">
                                                <input type="text" name="email" autocomplete="off" class="email" value="<?php echo $row['email_prof'] ?>" />
                                                <span class="emailSpan">E-mail</span>
                                            </div>
                                            <center><a onclick="document.getElementById('senha').style.display = 'block'" style="cursor: pointer;text-decoration: underline;color: #5183c4;">Alterar senha?</a></center>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-content" id='senha'>
                                <div class="perfil">
                                    <form action="./../public/functions/trocarSenha.php" method="post">
                                        <span class='fechar' onclick="document.getElementById('senha').style.display = 'none';">&times;</span>
                                        <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id">
                                        <center>
                                            <h1 style="color: white;font-size: 22px;">Troca de senha!</h1>
                                        </center>
                                        <div class="nomeInput">
                                            <input type="password" name="senha" autocomplete="off" class="nome" value="" />
                                            <span class="nomeSpan">Senha atual:</span>
                                        </div>
                                        <div class="emailInput">
                                            <input type="password" name="newSenha" autocomplete="off" class="email" value="" />
                                            <span class="emailSpan">Nova senha:</span>
                                        </div>
                                        <center><input type="submit" value="Trocar" name='submitSenha' style="background-color: white;color: black;width: 150px; border: none;border-radius: 25px;height: 35px;cursor: pointer;"></center>
                                    </form>
                                </div>
                            </div>
                </ul>
            <?php
        }
            ?>
            <nav>
                <ul>
                    <li><a href="">MAPA</a></li>
                    <li><a href="./suasReservas.php">RESERVA</a></li>
                    <li><a href="./admin.php?set=prof">ADMIN</a></li>
                    <li><a href="./../public/destroy.php">SAIR</a></li>
                </ul>
            </nav>
            </div>
            <div class="about">
                <div class="frase">
                    <h1>Olá Seja Bem-Vindo Ao Nosso Site</h1>
                    <h3>Aqui você pode agendar sua sala em segundos</h3><br>
                    <!------- SELECT------->
                    <select class="select" name="valor" onchange="SelBloco(this.value)">
                        <option value="" hidden selected disabled>Selecione o Bloco</option>
                        <option value="A">Bloco A</option>
                        <option value="B">Bloco B</option>
                    </select>
                    <img id="astronauta" src="../img/astronauta.png">
                </div>
            </div>
        </header>
        <main>
            <?php
            if (isset($_GET['e'])) {
                if ($_GET['e'] == '1') {
                    echo "
                <div id='modal' class='modal-content' style='display: block;'>
                    <div class='modal-container'>
                    <span onclick=" . "document.getElementById" . "('modal').style.display='none' style='cursor:pointer;'>&times;</span>
                        <center>
                            <h3>Atenção!</h3>
                            <p>Ocorreu um erro ao tentar executar esta ação!</p>
                        </center>
                    </div>
                </div>
                ";
                } else if ($_GET['e'] == '2') {
                    echo "
                    <div id='modal' class='modal-content' style='display: block;'>
                        <div class='modal-container'>
                        <span onclick=" . "document.getElementById" . "('modal').style.display='none' style='cursor:pointer;'>&times;</span>
                            <center>
                                <h3>Atenção!</h3>
                                <p>Você não pode sobrepor sua própria reserva!</p>
                            </center>
                        </div>
                    </div>
                    ";
                }
            };
            ?>
            <!-- Bloco A -->
            <div id="blocoa" style="display: block;">
                <div class="flex">
                    <?php
                    $i = 1;
                    $a = 0;
                    $ocup = [];
                    $anot = [];
                    $lista = [];
                    $dia = date('Y-m-d');
                    $hora = date('H:i:sa');
                    $datehora = $dia . " " . $hora;
                    if (strpos($datehora, 'am')) {
                        $datehora = str_replace('am', '', $datehora);
                    } else if (strpos($datehora, 'pm') !== false) {
                        $datehora = str_replace('pm', '', $datehora);
                    }
                    $sqlAnot = "SELECT * from lembretes l join reservas r on l.id_reserva_fk = r.id_reserva join salas s on r.id_sala_fk = s.id_sala WHERE s.name_sala LIKE 'A-%' and r.time_reserva_init<now() AND r.time_reserva_end>now()";
                    $sql = "SELECT s.* FROM salas s WHERE s.name_sala like 'A-%' GROUP BY s.name_sala order by s.id_sala asc";
                    $sqlT = "SELECT r.* from reservas r join salas s on r.id_sala_fk = s.id_sala WHERE s.name_sala LIKE 'A-%' and r.time_reserva_init<now() AND r.time_reserva_end>now() and r.reserva_canela is null";
                    $dadosT = mysqli_query($connect, $sqlT);
                    $dadosA = mysqli_query($connect, $sqlAnot);
                    $dados = mysqli_query($connect, $sql);
                    while ($as = mysqli_fetch_array($dadosA)) {
                        array_push($anot, $as['id_sala_fk'], $as['text_lembrete']);
                    };
                    while ($tes = mysqli_fetch_array($dadosT)) {
                        array_push($ocup, $tes['id_sala_fk']);
                    };
                    while ($row = mysqli_fetch_array($dados)) {
                        if (in_array($row['id_sala'], $ocup)) {
                            echo "
                        <div class='sala$i' id='sala$i' onclick=document.getElementById" . "('modal$i').style.display='block';sobrereservas($i) " . " style=background-color:" . "red" . ";";
                            echo ">" . $row['name_sala'] . "</div>
                            <div id='modal$i' class='modal-content' style='display: none;'>
                                <div class='modal-container'>
                                    <span onclick=" . "document.getElementById" . "('modal$i').style.display='none'>&times;</span>
                                    <button type='button' onclick=" . "sobrereservas('a',$i)" . " class='btnSobreReserva'>Sobrepor Reservar</button>
                                    <button type='button' onclick=" . "reservas('a',$i)" . " class='btnReservas'>Reservar</button>
                                    <button type='button' id='btnLR' onclick=" . "listaReserva('a',$i)" . " class='btnListaReservas'>Lista de Reservas</button>
                                    <center>
                                    <div id='sobreReservaa$i'>
                                        <form action='../public/functions/sobrereserva.php' method='post'>
                                            <input type='hidden' value='$row[id_sala]' name='reserva'>
                                            <h1>Esta sala já está reservada!!!</h1>
                                            <p>Se você deseja tentar sobrescrever está reserva???</p>
                                            <p>Caso sim, por favor selecione qual turma você lecionará</p>
                                            <label for='id'>Suas Turmas:</label>
                                            <select class='slTurma' name='id'>
                                            ";
                            for ($a = 0; $a < count($arrId); $a++) {
                                echo "<option value='$arrId[$a]'>$arrNome[$a]</option>";
                            };
                            echo "
                                            </select><br><br>
                                            <input type='submit' value='Solicitar' name='Submited'>                   
                                        </form>
                                    </div>
                                </center>
                                    ";
                            if (in_array($row['id_sala'], $anot)) {
                                $index = array_search($row['id_sala'], $anot); // SEMPRE VAI SER INDEX+1
                                echo "<H2>LEMBRETE</H2><BR><p>" . $anot[($index + 1)] . "</p>";
                            };
                            echo "
                                    <div class='modal-info' id='Reservara$i' style='display: none;'>
                                        <form action='../public/functions/reserva.php' method='post'>
                                            <div class='txtCL'>
                                                <input type='hidden' name='id_sala' value='$row[id_sala]'>
                                                <input type='hidden' name='date_reserva' value=" . $dia . ">
                                                <label for='time_reserva_init' class='lbResInit'>Data de inicio da reserva? </label><br>
                                                <input type='datetime-local' name='time_reserva_init' class='inptResInit' id='time_reserva_init$i' min='" . substr($datehora, 0, (strlen($datehora) - 3)) . "'><br><br>
                                                <label for='time_reserva_end' class='lbResEnd'>Data de fim da reserva? </label><br>
                                                <input type='datetime-local' name='time_reserva_end' class='inptResEnd'><br><br>
                                                <label for='pro_turma' class='lbTurma'>Qual turma? </label><br>
                                                <select name='pro_turma' class='slTurma'>";
                            for ($a = 0; $a < count($arrId); $a++) {
                                echo "<option value='$arrId[$a]'>$arrNome[$a]</option>";
                            };
                            echo "
                                                </select><br><br>
                                                <label for='type' class='lbTipo '>Que tipo? </label><br>
                                                <select name='type' class='slTipo'>
                                                    <option value='1'>Diária</option>
                                                    <option value='0'>Fixa</option>
                                                </select><br><br>
                                                <input type='submit' value='Reservar' name='Submited' class='btnSubmit'>   
                                            </div>                
                                        </form>
                                    </div>
                                    <div class='modal-info-list' id='ListaReservaa$i' style='display: none;'>
                                        <div class='grid-lista'>
                                            <p>Reserva</p>
                                            <p>Nome do professor</p>
                                            <p>Nome da turma</p>
                                            <p>Início</p>
                                            <p>Fim</p>
                                        </div>
                                        <hr>
                                        <div class='grid-lista1'>
                                        ";
                            $sqlLista = "SELECT * from reservas r join salas s on r.id_sala_fk=s.id_sala join prof_turma pt on r.id_prof_turma_fk = pt.id_pro_tur join professores p on pt.id_prof_fk=p.id_prof join turmas t on t.id_turma = pt.id_turma_fk WHERE s.id_sala = $row[id_sala] and r.time_reserva_init >=now() and r.time_reserva_end>now() order by r.time_reserva_end desc";
                            $dadosL = mysqli_query($connect, $sqlLista);
                            while ($dl = mysqli_fetch_array($dadosL)) {
                                echo
                                "
                                                <p>$dl[id_reserva]</p>
                                                <p>$dl[name_prof]</p>
                                                <p>$dl[name_turma]</p>
                                                <p>$dl[time_reserva_init]</p>
                                                <p>$dl[time_reserva_end]</p>";
                            };
                            echo "
                                        </div>                
                                    </div>
                                <img src='../img/astronauta.png' id='astroModala$i' class='astroModal' style='display:none;'>
                            </div>
                        </div>";
                            $i += 1;
                        } else {
                            echo "
                        <div class='sala$i' id='sala$i' onclick=" . "document.getElementById" . "('modal$i').style.display='block' ";
                            echo ">" . $row['name_sala'] . "</div>
                            <div id='modal$i' class='modal-content' style='display: none;'>
                                <div class='modal-container'>
                                    <span onclick=" . "document.getElementById" . "('modal$i').style.display='none'>&times;</span>
                                    <button type='button' onclick=" . "reservas('a',$i)" . " class='btnReservas'>Reservar</button>
                                    <button type='button' id='btnLR' onclick=" . "listaReserva('a',$i)" . " class='btnListaReservas'>Lista de Reservas</button>
                                    <div class='modal-info' id='Reservara$i'>
                                        <form action='../public/functions/reserva.php' method='post'>
                                            <div class='txtCL'>
                                                <input type='hidden' name='id_sala' value='$row[id_sala]'>
                                                <input type='hidden' name='date_reserva' value=" . $dia . ">
                                                <label for='time_reserva_init' class='lbResInit'>Data de inicio da reserva? </label><br>
                                                <input type='datetime-local' name='time_reserva_init' class='inptResInit' min='" . substr($datehora, 0, (strlen($datehora) - 3)) . "'><br><br>
                                                <label for='time_reserva_end' class='lbResEnd'>Data de fim da reserva? </label><br>
                                                <input type='datetime-local' name='time_reserva_end' class='inptResEnd'><br><br>
                                                <label for='pro_turma' class='lbTurma'>Qual turma? </label><br>
                                                <select name='pro_turma' class='slTurma'>";
                            for ($a = 0; $a < count($arrId); $a++) {
                                echo "<option value='$arrId[$a]'>$arrNome[$a]</option>";
                            };
                            echo "
                                                </select><br><br>
                                                <label for='type' class='lbTipo '>Que tipo? </label><br>
                                                <select name='type' class='slTipo'>
                                                    <option value='1'>Diária</option>
                                                    <option value='0'>Fixa</option>
                                                </select><br><br>
                                                <input type='submit' value='Reservar' name='Submited' class='btnSubmit'>   
                                            </div>                
                                        </form>
                                    </div>
                                    <div class='modal-info-list' id='ListaReservaa$i' style='display: none;'>
                                        <div class='grid-lista'>
                                            <p>Reserva</p>
                                            <p>Nome do professor</p>
                                            <p>Nome da turma</p>
                                            <p>Início</p>
                                            <p>Fim</p>
                                        </div>
                                        <hr>
                                        <div class='grid-lista1'>
                                        ";
                            $sqlLista = "SELECT * from reservas r join salas s on r.id_sala_fk=s.id_sala join prof_turma pt on r.id_prof_turma_fk = pt.id_pro_tur join professores p on pt.id_prof_fk=p.id_prof join turmas t on t.id_turma = pt.id_turma_fk WHERE s.id_sala = $row[id_sala] and r.time_reserva_init >=now() and r.time_reserva_end>now() order by r.time_reserva_end asc";
                            $dadosL = mysqli_query($connect, $sqlLista);
                            while ($dl = mysqli_fetch_array($dadosL)) {
                                echo
                                "
                                                <p>$dl[id_reserva]</p>
                                                <p>$dl[name_prof]</p>
                                                <p>$dl[name_turma]</p>
                                                <p>$dl[time_reserva_init]</p>
                                                <p>$dl[time_reserva_end]</p>";
                            };
                            echo "
                                        </div>
                                    </div>        
                                    <img src='../img/astronauta.png' id='astroModala$i' class='astroModal'>
                                </div>
                            </div>
                        ";
                            $i += 1;
                        };
                    };
                    ?>
                </div>
            </div>
            <!-- Bloco B -->
            <div style="display: none;" id="blocob">
                <div class="flex">
                    <?php
                    $i = 1;
                    $a = 0;
                    $ocup = [];
                    $anot = [];
                    $lista = [];
                    $dia = date('Y-m-d');
                    $hora = date('H:i:sa');
                    $datehora = $dia . " " . $hora;
                    if (strpos($datehora, 'am')) {
                        $datehora = str_replace('am', '', $datehora);
                    } else if (strpos($datehora, 'pm') !== false) {
                        $datehora = str_replace('pm', '', $datehora);
                    }
                    $sqlAnot = "SELECT * from lembretes l join reservas r on l.id_reserva_fk = r.id_reserva join salas s on r.id_sala_fk = s.id_sala WHERE s.name_sala LIKE 'B-%' and r.time_reserva_init<now() AND r.time_reserva_end>now()";
                    $sql = "SELECT s.* FROM salas s WHERE s.name_sala like 'B-%' GROUP BY s.name_sala order by s.id_sala asc";
                    $sqlT = "SELECT r.* from reservas r join salas s on r.id_sala_fk = s.id_sala WHERE s.name_sala LIKE 'B-%' and r.time_reserva_init<now() AND r.time_reserva_end>now() and r.reserva_canela is null";
                    $sqlLista = "SELECT * from reservas r join salas s r.id_sala_fk=s.id_sala join prof_turma pt on r.id_prof_turma_fk = pt.id_pro_tur join professores p on pt.id_prof_fk=p.id_prof WHERE s.name_sala LIKE 'B-%' and r.time_reserva_init >=now()";
                    $dadosT = mysqli_query($connect, $sqlT);
                    $dadosA = mysqli_query($connect, $sqlAnot);
                    $dadosL = mysqli_query($connect, $sqlLista);
                    $dados = mysqli_query($connect, $sql);
                    while ($as = mysqli_fetch_array($dadosA)) {
                        array_push($anot, $as['id_sala_fk'], $as['text_lembrete']);
                    };
                    while ($tes = mysqli_fetch_array($dadosT)) {
                        var_dump($tes);
                        array_push($ocup, $tes['id_sala_fk']);
                    };
                    while ($row = mysqli_fetch_array($dados)) {
                        if (in_array($row['id_sala'], $ocup)) {
                            echo "
                        <div class='salab$i' id='sala$i' onclick=document.getElementById" . "('modalb$i').style.display='block' " . " style=background-color:" . "red" . ";";
                            echo ">" . $row['name_sala'] . "</div>
                            <div id='modalb$i' class='modal-content' style='display: none;'>
                                <div class='modal-container'>
                                    <span onclick=" . "document.getElementById" . "('modalb$i').style.display='none'>&times;</span>
                                    <button type='button' onclick=" . "sobrereservas('b',$i)" . " class='btnSobreReserva'>Sobrepor Reservar</button>
                                    <button type='button' onclick=" . "reservas('b',$i)" . " class='btnReservas'>Reservar</button>
                                    <button type='button' id='btnLR' onclick=" . "listaReserva('b',$i)" . " class='btnListaReservas'>Lista de Reservas</button>
                                    <center>
                                        <div id='sobreReservab$i'>
                                            <form action='../public/functions/sobrereserva.php' method='post'>
                                                <input type='hidden' value='$row[id_sala]' name='reserva'>
                                                <h1>Esta sala já está reservada!!!</h1>
                                                <p>Se você deseja tentar sobrescrever está reserva???</p>
                                                <p>Caso sim, por favor selecione qual turma você lecionará</p>
                                                <label for='id'>Suas Turmas:</label>
                                                <select class='slTurma' name='id'>
                                            ";
                            for ($a = 0; $a < count($arrId); $a++) {
                                echo "<option value='$arrId[$a]'>$arrNome[$a]</option>";
                            };
                            echo "
                                                </select><br><br>
                                                <input type='submit' value='Solicitar'      name='Submited'>                 
                                            </form>
                                        </div>
                                    </center>
                                    ";
                            if (in_array($row['id_sala'], $anot)) {
                                $index = array_search($row['id_sala'], $anot); // SEMPRE VAI SER INDEX+1
                                echo "<H2>LEMBRETE</H2><BR><p>" . $anot[($index + 1)] . "</p>";
                            };
                            echo "
                            <div class='modal-info' id='Reservarb$i' style='display: none;'>
                                <form action='../public/functions/reserva.php' method='post'>
                                    <div class='txtCL'>
                                        <input type='hidden' name='id_sala' value='$row[id_sala]'>
                                        <input type='hidden' name='date_reserva' value=" . $dia . ">
                                        <label for='time_reserva_init' class='lbResInit'>Data de inicio da reserva? </label><br>
                                        <input type='datetime-local' name='time_reserva_init' class='inptResInit' id='time_reserva_init$i' min='" . substr($datehora, 0, (strlen($datehora) - 3)) . "'><br><br>
                                        <label for='time_reserva_end' class='lbResEnd'>Data de fim da reserva? </label><br>
                                        <input type='datetime-local' name='time_reserva_end' class='inptResEnd'><br><br>
                                        <label for='pro_turma' class='lbTurma'>Qual turma? </label><br>
                                        <select name='pro_turma' class='slTurma'>";
                            for ($a = 0; $a < count($arrId); $a++) {
                                echo "<option value='$arrId[$a]'>$arrNome[$a]</option>";
                            };
                            echo "
                                        </select><br><br>
                                        <label for='type' class='lbTipo '>Que tipo? </label><br>
                                        <select name='type' class='slTipo'>
                                            <option value='1'>Diária</option>
                                            <option value='0'>Fixa</option>
                                        </select><br><br>
                                        <input type='submit' value='Reservar' name='Submited' class='btnSubmit'>   
                                    </div>                
                                </form>
                            </div>
                            <div class='modal-info-list' id='ListaReservab$i' style='display: none;'>
                                <div class='grid-lista'>
                                    <p>Reserva</p>
                                    <p>Nome do professor</p>
                                    <p>Nome da turma</p>
                                    <p>Início</p>
                                    <p>Fim</p>
                                </div>
                                <hr>
                                <div class='grid-lista1'>
                                ";
                            $sqlLista = "SELECT * from reservas r join salas s on r.id_sala_fk=s.id_sala join prof_turma pt on r.id_prof_turma_fk = pt.id_pro_tur join professores p on pt.id_prof_fk=p.id_prof join turmas t on t.id_turma = pt.id_turma_fk WHERE s.id_sala = $row[id_sala] and r.time_reserva_init >=now() and r.time_reserva_end>now() order by r.time_reserva_end desc";
                            $dadosL = mysqli_query($connect, $sqlLista);
                            while ($dl = mysqli_fetch_array($dadosL)) {
                                echo
                                "
                                        <p>$dl[id_reserva]</p>
                                        <p>$dl[name_prof]</p>
                                        <p>$dl[name_turma]</p>
                                        <p>$dl[time_reserva_init]</p>
                                        <p>$dl[time_reserva_end]</p>";
                            };
                            echo "
                                </div>                
                            </div>
                        <img src='../img/astronauta.png' id='astroModalb$i' class='astroModal' style='display:none;'>
                    </div>
                </div>";
                            $i += 1;
                        } else {
                            echo "
                <div class='salab$i' id='sala$i' onclick=" . "document.getElementById" . "('modalb$i').style.display='block' ";
                            echo ">" . $row['name_sala'] . "</div>
                    <div id='modalb$i' class='modal-content' style='display: none;'>
                        <div class='modal-container'>
                            <span onclick=" . "document.getElementById" . "('modalb$i').style.display='none'>&times;</span>
                            <button type='button' onclick=" . "reservas('b',$i)" . " class='btnReservas'>Reservar</button>
                            <button type='button' id='btnLR' onclick=" . "listaReserva('b',$i)" . " class='btnListaReservas'>Lista de Reservas</button>
                            <div class='modal-info' id='Reservarb$i'>
                                <form action='../public/functions/reserva.php' method='post'>
                                    <div class='txtCL'>
                                        <input type='hidden' name='id_sala' value='$row[id_sala]'>
                                        <input type='hidden' name='date_reserva' value=" . $dia . ">
                                        <label for='time_reserva_init' class='lbResInit'>Data de inicio da reserva? </label><br>
                                        <input type='datetime-local' name='time_reserva_init' class='inptResInit' min='" . substr($datehora, 0, (strlen($datehora) - 3)) . "'><br><br>
                                        <label for='time_reserva_end' class='lbResEnd'>Data de fim da reserva? </label><br>
                                        <input type='datetime-local' name='time_reserva_end' class='inptResEnd'><br><br>
                                        <label for='pro_turma' class='lbTurma'>Qual turma? </label><br>
                                        <select name='pro_turma' class='slTurma'>";
                            for ($a = 0; $a < count($arrId); $a++) {
                                echo "<option value='$arrId[$a]'>$arrNome[$a]</option>";
                            };
                            echo "
                                        </select><br><br>
                                        <label for='type' class='lbTipo '>Que tipo? </label><br>
                                        <select name='type' class='slTipo'>
                                            <option value='1'>Diária</option>
                                            <option value='0'>Fixa</option>
                                        </select><br><br>
                                        <input type='submit' value='Reservar' name='Submited' class='btnSubmit'>   
                                    </div>                
                                </form>
                            </div>
                            <div class='modal-info-list' id='ListaReservab$i' style='display: none;'>
                                <div class='grid-lista'>
                                    <p>Reserva</p>
                                    <p>Nome do professor</p>
                                    <p>Nome da turma</p>
                                    <p>Início</p>
                                    <p>Fim</p>
                                </div>
                                <hr>
                                <div class='grid-lista1'>
                                ";
                            $sqlLista = "SELECT * from reservas r join salas s on r.id_sala_fk=s.id_sala join prof_turma pt on r.id_prof_turma_fk = pt.id_pro_tur join professores p on pt.id_prof_fk=p.id_prof join turmas t on t.id_turma = pt.id_turma_fk WHERE s.id_sala = $row[id_sala] and r.time_reserva_init >=now() and r.time_reserva_end>now() order by r.time_reserva_end asc";
                            $dadosL = mysqli_query($connect, $sqlLista);
                            while ($dl = mysqli_fetch_array($dadosL)) {
                                echo
                                "
                                        <p>$dl[id_reserva]</p>
                                        <p>$dl[name_prof]</p>
                                        <p>$dl[name_turma]</p>
                                        <p>$dl[time_reserva_init]</p>
                                        <p>$dl[time_reserva_end]</p>";
                            };
                            echo "
                                </div>
                            </div>        
                            <img src='../img/astronauta.png' id='astroModalb$i' class='astroModal'>
                        </div>
                    </div>";
                            $i += 1;
                        };
                    }
                    ?>
                </div>
            </div>
        </main>
        <footer>
        </footer>
        <script src="../js/bloco.js"></script>
    </body>

    </html>