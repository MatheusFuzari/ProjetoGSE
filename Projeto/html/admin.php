<?php
require('../public/database.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSE Admin</title>
    <link rel='icon' href="../img/logo3.png">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/fontawesome.css" />
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/brands.css" />
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/solid.css" />

</head>

<body>
    <header>
        <div class="box">
            <nav>
                <a href="admin.php?set=prof" class='btnMidia' id='a'><i class="fa-regular fa-graduation-cap"></i></a>
                <a href="admin.php?set=profTur" class='btnMidia' id='b'><i class="fa-solid fa-hands"></i></a>
                <a href="admin.php?set=turmas" class='btnMidia' id='c'><i class="fa-regular fa-users-line"></i></a>
                <a href="admin.php?set=salas" class='btnMidia' id='d'><i class="fa-regular fa-house"></i></a>
                <a href="admin.php?set=reservas" class='btnMidia' id='e'><i class="fa-solid fa-clock-rotate-left"></i></a>
                <a href="menu.php" class='btnMidiaM'><i class="fa-regular fa-right-to-bracket"></i></a>
            </nav>
        </div>
    </header>
    <?php
    if ($_SESSION['id'] != '6') {
    ?>
        <center><i style='font-size:42px;margin-top:50px;' class='fa-solid fa-lock'></i><br>
            <h2>Admin não reconhecido!</h2>
        </center>
    <?php
    } else {
    ?>
        <?php
        $i = 0;
        $set = $_GET['set'];
        if ($set == 'prof') {
            $sql = "SELECT * FROM PROFESSORES";
            $dados = mysqli_query($connect, $sql);
            echo "
                <div class='table-prof'>
                <p>Id</p>
                <p>Nome</p>
                <p>E-mail</p>
                <p>Senha</p>
                <input type='button' class = 'addBtn' value='Adicionar' onclick=" . "document.getElementById('modalN').style.display='block'" . ">
                </div>
                <hr>
                <div class='table-prof'>";
            while ($row = mysqli_fetch_array($dados)) {
                echo "
                <p>" . $row['id_prof'] . "</p>
                <p>" . $row['name_prof'] . "</p>
                <p>" . $row['email_prof'] . "</p>
                <p>" . $row['pass_prof'] . "</p>
                <input type='button' value='Alterar' onclick=" . "document.getElementById('modal$i').style.display='block'" . ">
                <input type='button' value='Excluir' onclick=" . "document.getElementById('modalC$i').style.display='block'" . ">
                <div id='modal$i' class='modal-containter'>
                    <div class='modal-content'>
                        <span onclick=" . "document.getElementById" . "('modal$i').style.display='none'>&times;</span>
                        <h3>Alterar Professor: $row[name_prof]</h3>
                        <form action='./../public/functions/upgradeProf.php' method='post'>
                            <input type='hidden' value='$row[id_prof]' name='id'>
                            <label for='nome'>Name: </label><br>
                            <input type='text' value='$row[name_prof]' name='nome'><br><br>
                            <label for='email'>E-mail: </label><br>
                            <input type='text' value='$row[email_prof]' name='email'><br><br>
                            <label for='senha'>Senha: </label><br>
                            <input type='text' name='senha' value='' placeholder='Deixar vazio, caso deseje manter a mesma senha'><br><br>
                            <input type='submit' value='Atualizar' name='send'>
                        </form>
                    </div>
                </div>
                <div id='modalC$i' class='modal-containter'>
                    <div class='modal-content'>
                        <span onclick=" . "document.getElementById" . "('modalC$i').style.display='none'>&times;</span>
                        <form action='./../public/functions/deleteProf.php' method='post'>
                            <input type='hidden' value='$row[id_prof]' name='id'>
                            <h3>Você está prestes a deletar o professor: $row[name_prof]</h3>
                            <br><br>
                            <p>Esta ação não pode ser revertida uma vez feita. Tem certeza disto?</p>
                            <br>
                            <input type='submit' value='Sim' name='send' class='send'>
                            <input type='submit' value='Não' name='send' class='cancel'>
                        </form>
                    </div>
                </div>";
                $i++;
            }
            echo "</div>
                <div id='modalN' class='modal-containter'>
                    <div class='modal-content'>
                        <span onclick=" . "document.getElementById" . "('modalN').style.display='none'>&times;</span>
                        <h3>Adicionar Professor!</h3>
                        <form action='./../public/functions/createProf.php' method='post'>
                            <label for='nome'>Name: </label><br>
                            <input type='text' value='' name='nome'><br><br>
                            <label for='email'>E-mail: </label><br>
                            <input type='text' value='' name='email'><br><br>
                            <label for='senha'>Senha: </label><br>
                            <input type='text' name='senha' value=''><br><br>
                            <input type='submit' value='Criar' name='send'>
                        </form>
                    </div>
                </div>";
        } else if ($set == 'turmas') {
            $sql = "SELECT * FROM turmas";
            $dados = mysqli_query($connect, $sql);
            echo "
                <div class='table-tur'>
                    <p>ID</p>
                    <p>Nome</p>
                    <input type='button' class = 'addBtnT' value='Adicionar' onclick=" . "document.getElementById('modalN').style.display='block'" . ">
                </div>
                <hr>
                <div class='table-tur'>";
            while ($row = mysqli_fetch_array($dados)) {
                echo "
                    <p>" . $row['id_turma'] . "</p>
                    <p>" . $row['name_turma'] . "</p>
                    <input type='button' value='Alterar' onclick=" . "document.getElementById('modal$i').style.display='block'" . ">
                    <input type='button' value='Excluir' onclick=" . "document.getElementById('modalC$i').style.display='block'" . ">
                    <div id='modal$i' class='modal-containter'>
                        <div class='modal-content'>
                            <span onclick=" . "document.getElementById" . "('modal$i').style.display='none'>&times;</span>
                            <h3>Alterar Turma: $row[name_turma]</h3>
                            <form action='./../public/functions/upgradeTurma.php' method='post'>
                                <input type='hidden' value='$row[id_turma]' name='id'>
                                <label for='nome'>Nome:</label><br>
                                <input type='text' value='$row[name_turma]' name='nome'>
                                <br><br>
                                <input type='submit' value='Atualizar' name='send'>
                            </form>
                        </div>
                    </div>
                    <div id='modalC$i' class='modal-containter'>
                        <div class='modal-content'>
                            <span onclick=" . "document.getElementById" . "('modalC$i').style.display='none'>&times;</span>
                            <form action='./../public/functions/deleteTurma.php' method='post'>
                                <input type='hidden' value='$row[id_turma]' name='id'>
                                <p>Você está prestes a deletar a turma $row[name_turma]</p><br><br>
                                <p>Esta ação não pode ser revertida uma vez feita. Tem certeza disto?</p>
                                <br>
                                <input type='submit' value='Sim' name='send' class='send'>
                                <input type='submit' value='Não' name='send' class='cancel'>
                            </form>
                        </div>
                    </div>";
                $i++;
            }
            echo "</div>
                <div id='modalN' class='modal-containter'>
                    <div class='modal-content'>
                        <span onclick=" . "document.getElementById" . "('modalN').style.display='none'>&times;</span>
                        <form action='./../public/functions/createTurma.php' method='post'>
                            <label for='nome'>Nome:</label><br>
                            <input type='text' value='' name='nome'>
                            <br><br>
                            <input type='submit' value='Criar' name='send'>
                        </form>
                    </div>
                </div>
                ";
        } else if ($set == 'salas') {
            $sql = "SELECT * FROM SALAS";
            $dados = mysqli_query($connect, $sql);
            echo "
                <div class='table-tur'>
                    <p>ID</p>
                    <p>Nome</p>
                </div>
                <hr>
                <div class='table-tur'>";
            while ($row = mysqli_fetch_array($dados)) {
                echo "
                    <p>" . $row['id_sala'] . "</p>
                    <p>" . $row['name_sala'] . "</p>
                    <input type='button' value='Alterar' onclick=" . "document.getElementById('modal$i').style.display='block'" . ">
                    <input type='button' value='Excluir' onclick=" . "document.getElementById('modalC$i').style.display='block'" . ">
                    <div id='modal$i' class='modal-containter'>
                        <div class='modal-content'>
                        <span onclick=" . "document.getElementById" . "('modal$i').style.display='none'>&times;</span>
                        <h3>Alterar Sala: $row[name_sala]</h3>
                            <form action='./../public/functions/upgradeSala.php' method='post'>
                                <input type='hidden' value='$row[id_sala]' name='id'>
                                <label for='nome'>Nome:</label><br>
                                <input type='text' value='$row[name_sala]' name='nome'>
                                <br><br>
                                <input type='submit' value='Atualizar' name='send'>
                            </form>
                        </div>
                    </div>
                    <div id='modalC$i' class='modal-containter'>
                        <div class='modal-content'>
                        <span onclick=" . "document.getElementById" . "('modalC$i').style.display='none'>&times;</span>
                            <form action='./../public/functions/deleteSala.php' method='post'>
                                <input type='hidden' value='$row[id_sala]' name='id'>
                                <p>Você está prestes a deletar a sala $row[name_sala]</p>
                                <Br><br>
                                <p>Esta ação não pode ser revertida uma vez feita. Tem certeza disto?</p>
                                <br>
                                <input type='submit' value='Sim' name='send' class='send'>
                                <input type='submit' value='Não' name='send' class='cancel'>
                            </form>
                        </div>
                    </div>";
                $i++;
            }
            echo "</div>";
        } else if ($set == 'reservas') {
            $sql = "SELECT * FROM reservas r JOIN salas s on r.id_sala_fk = s.id_sala JOIN prof_turma pt on r.id_prof_turma_fk = pt.id_pro_tur JOIN professores p on pt.id_prof_fk = p.id_prof JOIN turmas t on pt.id_turma_fk = t.id_turma WHERE r.time_reserva_end>now()";
            $dados = mysqli_query($connect, $sql);
        ?>
            <div class="table-prof">
                <p></p>
                <p>Sala</p>
                <p>Professor</p>
                <p>Turma</p>
                <p>Inicio</p>
                <p>Fim</p>
            </div>
            <hr>
            <div class="table-prof">
                <?php
                while ($row = mysqli_fetch_array($dados)) {
                ?>
                    <p></p>
                    <p><?php echo $row['name_sala'] ?></p>
                    <p><?php echo $row['name_prof'] ?></p>
                    <p><?php echo $row['name_turma'] ?></p>
                    <p><?php echo $row['time_reserva_init'] ?></p>
                    <p><?php echo $row['time_reserva_end'] ?></p>
                <?php
                };
                ?>
            </div>
        <?php
        } else if ($set == 'profTur') {
            $sql = "SELECT * FROM prof_turma pt JOIN turmas t on pt.id_turma_fk = t.id_turma JOIN professores p on p.id_prof = pt.id_prof_fk";
            $dados = mysqli_query($connect, $sql);
            $i = 0;
            $listaP = array();
            $ListaT = array();
            $dP = mysqli_query($connect, "SELECT id_prof,name_prof FROM PROFESSORES");
            $dT = mysqli_query($connect, "SELECT id_turma, name_turma FROM TURMAS");
            while ($p = mysqli_fetch_array($dP)) {
                array_push($listaP, $p['id_prof'], $p['name_prof']);
            };
            while ($t = mysqli_fetch_array($dT)) {
                array_push($ListaT, $t['id_turma'], $t['name_turma']);
            };
        ?>
            <div class="table-tur">
                <p>Id</p>
                <p>Nome do Professor</p>
                <p>Turma referente</p>
                <p><input type='button' class='addBtnT' value='Adicionar' onclick="document.getElementById('modalN').style.display='block'"></p>
            </div>
            <hr>
            <div class="table-tur">
                <?php while ($row = mysqli_fetch_array($dados)) { ?>
                    <p><?php echo $row['id_pro_tur']; ?></p>
                    <p><?php echo $row['name_prof']; ?></p>
                    <p><?php echo $row['name_turma']; ?></p>
                    <input type='button' value='Excluir' onclick="document.getElementById('<?php echo 'modalC' . $i; ?>').style.display='block'">
                    <div id='<?php echo 'modalC' . $i; ?>' class='modal-containter'>
                        <div class='modal-content'>
                            <span onclick="document.getElementById('<?php echo 'modalC' . $i; ?>').style.display='none'">&times;</span>
                            <form action='./../public/functions/deleteProfTurma.php' method='post'>
                                <input type='hidden' value='<?php echo $row['id_pro_tur']; ?>' name='id'>
                                <p>Você está prestes a deletar a relação <?php echo $row['id_pro_tur']; ?></p>
                                <Br><br>
                                <p>Esta ação não pode ser revertida uma vez feita. Tem certeza disto?</p>
                                <br>
                                <input type='submit' value='Sim' name='send' class='send'>
                                <input type='submit' value='Não' name='send' class='cancel'>
                            </form>
                        </div>
                    </div>
                <?php $i++;
                }; ?>
            </div>
            <div id='modalN' class='modal-containter'>
                <div class='modal-content'>
                    <span onclick="document.getElementById('modalN').style.display='none'">&times;</span>
                    <form action='./../public/functions/createProfTurma.php' method='post'>
                        <label for='prof'>Professor:</label><br>
                        <select name="prof">
                            <?php
                            for ($a = 0; $a < count($listaP); $a += 2) {
                                echo "<option value='$listaP[$a]'>" . $listaP[($a + 1)] . "</option>";
                            };
                            ?>
                        </select>
                        <br><br>
                        <label for='tur'>Turma:</label><br>
                        <select name="tur">
                            <?php
                            for ($a = 0; $a < count($ListaT); $a += 2) {
                                echo "<option value='$ListaT[$a]'>" . $ListaT[($a + 1)] . "</option>";
                            };
                            ?>
                        </select>
                        <br><br>
                        <input type='submit' value='Criar' name='send'>
                    </form>
                </div>
            </div>
        <?php
        }
        ?>
        </div>
    <?php
    }
    ?>
</body>

</html>