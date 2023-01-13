<title>Fazer chamada</title>

<?php require_once 'header_prof.php' ?>

<div class="container w-75 align-items-center bg-light mt-3 p-2 rounded-2" style="border: 2px solid #0e7490">
<?php
$curso = base64_decode($_GET['curso']);
$disciplina = base64_decode($_GET['disciplina']);
$data = date('d/m/Y');
$datatime = date('d/m/Y H:i:s');

$sql = "SELECT * FROM estudantes WHERE curso='{$curso}'";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) == 0) {
    print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>Não existe nenhum aluno cadastrado nesta disciplina!</h2>";
} else {
?>
    <div class="d-flex mt-3">
        <h2 class="text-secondary me-1">Chamada da disciplina de</h2>
        <h2 class="text-secondary ms-1 text-info"><?=base64_decode($_GET['disciplina'])?></h2>
    </div>
    <div class="d-flex mt-2">
        <h4 class="text-secondary me-1">Data de hoje:</h4>
        <h4 class="text-secondary ms-1 text-info"><?= $data ?></h4>
    </div>
    <form action="" method="post">
        <table class="table table-striped mt-3 align-middle">
            <?php while ($res = mysqli_fetch_assoc($result)) {?>
                <tr>
                    <td class="fw-bold">Nome do aluno:</td>
                    <td class="fw-bold">Código:</td>
                    <td class="fw-bold">Marcar presença</td>
                    <td></td>
                </tr>
                <tr>
                    <td> <?=$res['nome']?> </td>
                    <td> <?=$res['code']?> </td>
                    <td>
                        <?php
                        $sqlChamadas = "SELECT * FROM chamadas_em_sala WHERE data_day = '{$data}' AND disciplina = '{$disciplina}' AND code_aluno = '{$res['code']}'";
                        $resultChamadas = mysqli_query($connection, $sqlChamadas);
                        if (mysqli_num_rows($resultChamadas) == 0) {?>
                            <input type="hidden" name="nome_alun" value="<?=$res['nome']?>">
                            <input type="hidden" name="code_alun" value="<?=$res['code']?>">
                            <label class="me-2">
                                <input type="radio" name="presenca" value="Presente" required>
                                Presente
                            </label>
                            <label class="me-2">
                                <input type="radio" name="presenca" value="Falta" required>
                                Falta
                            </label>

                            <label>
                                <input type="radio" name="presenca" value="Falta justificada" required>
                                Falta justificada
                            </label>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-info fw-semibold text-white" name="guarda">Guardar</button>
                        </td>
                    <?php } else {
                        print 'Indisponível';
                    }?>
                </tr>
                <tr>
                <?php
                if (isset($_POST['guarda'])) {
                    $code_alun = $_POST['code_alun'];
                    $nome_alun = $_POST['nome_alun'];
                    @$presenca = $_POST['presenca'];

                    $sqlConfirma = "SELECT * FROM confirma_entrada_de_alunos WHERE data_hoje='{$data}' AND code_aluno='{$code_alun}'";
                    $resultConfirma = mysqli_query($connection, $sqlConfirma);
                    if (mysqli_num_rows($resultConfirma) == 0 && $presenca == 'Presente') {
                        print "<script language='javascript'>window.alert('Impossível marcar presença para esse aluno, ele não passou pela portaria hoje!');</script>";
                    } else {
                        if (mysqli_num_rows($resultConfirma) >= 1 && $presenca == 'Falta' || $presenca == 'Falta justificada') {
                            ?>
                            <h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>O aluno <?=$nome_alun?> passou pela portaria hoje. Tem certeza que ele não está em sala de aula?</h2>
                            <a class="btn btn-danger fw-bold" href="fazer_chamada.php?curso=<?=base64_encode($curso)?>&disciplina=<?=base64_encode($disciplina)?>&confirma_falta=sim&code_alun=<?=$code_alun?>&presenca=<?=$presenca?>">
                                Confirmar falta
                            </a>
                            <a class="btn btn-info ms-2 fw-bold text-white" href="">
                                Cancelar
                            </a>
                            <?php
                        } else {
                            $sqlInsere = "INSERT INTO chamadas_em_sala (data, data_day, curso, disciplina, code_professor, code_aluno, presente) VALUES ('{$datatime}', '{$data}', '{$curso}', '{$disciplina}', '{$code}', '{$code_alun}', '{$presenca}')";
                            mysqli_query($connection, $sqlInsere);
                            print "<script language='javascript'>window.location='';</script>";
                        }?>
                </tr>
            <?php } } } } ?>
        </table>
    </form>

    <?php
    if ($_GET['confirma_falta'] == 'sim') {
        $code_alun = $_GET['code_alun'];
        $presenca = $_GET['presenca'];

        $sqlInsere = "INSERT INTO chamadas_em_sala (data, data_day, curso, disciplina, code_professor, code_aluno, presente) VALUES ('{$datatime}', '{$data}', '{$curso}', '{$disciplina}', '{$code}', '{$code_alun}', '{$presenca}')";
        mysqli_query($connection, $sqlInsere);
        $curso = $_GET['curso'];
        $disciplina = $_GET['disciplina'];
        print "<script language='javascript'>window.location='fazer_chamada.php?curso=$curso&disciplina=$disciplina';</script>";
    }?>

</div>

<?php require_once 'footer_profs.php' ?>