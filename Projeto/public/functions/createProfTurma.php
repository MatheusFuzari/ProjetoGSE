<?php
include '../database.php';
var_dump($_POST);
$prof = mysqli_escape_string($connect, $_POST['prof']);
$turma = mysqli_escape_string($connect, $_POST['tur']);
$teste = "SELECT * FROM prof_turma WHERE id_prof_fk = $prof and id_turma_fk = $turma";
$data = mysqli_query($connect, $teste);
if (mysqli_num_rows($data) >= 1) {
    header('Location:../../html/admin.php?set=profTur');
} else {
    if ($_POST['send'] == 'Criar') {
        $sql = "INSERT INTO `prof_turma`(`id_prof_fk`, `id_turma_fk`) VALUES ($prof,$turma)";
        if (mysqli_query($connect, $sql)) {
            header('Location:../../html/admin.php?set=profTur');
        } else {
            echo 'Error';
        }
    } else {
        header('Location:../../html/admin.php?set=profTur');
    }
}
