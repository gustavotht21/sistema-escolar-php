<title>Turmas e alunos</title>

<?php require_once 'header_prof.php' ?>

<div class="container w-75 align-items-center bg-light mt-3 p-2 rounded-2" style="border: 2px solid #0e7490">
    <h2 class="text-secondary mt-3">Abaixo estão listados todos os seus cursos e os alunos deles</h2>

    <?php
    $sql = "SELECT * FROM disciplinas WHERE professor='{$code}'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) == 0) {
        print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>Você não ministra nenhum curso!</h2>";
    } else {
    ?>

    <table class="table table-striped align-middle">
        <tr>
            <td class="fw-bold">Disciplinas ministradas:</td>
            <td class="fw-bold">Total de alunos nessa disciplina:</td>
            <td></td>
        </tr>
        <?php while ($res = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td> <?=$res['disciplina']?> </td>
            <td> <?php
                $sqlAlunos = "SELECT * FROM estudantes WHERE curso = '{$res['curso']}'";
                $resultAlunos = mysqli_query($connection, $sqlAlunos);
                print mysqli_num_rows($resultAlunos);
                ?> </td>
            <td>
                <a href="fazer_chamada.php?curso=<?=base64_encode($res['curso'])?>&disciplina=<?=base64_encode($res['disciplina'])?>">
                    <img title="Fazer chamada" src="../../public/images/openBook.png" width="25" alt="Fazer chamada">
                </a>
            </td>
        </tr>
        <?php } }?>
    </table>
</div>
<?php require_once 'footer_profs.php' ?>