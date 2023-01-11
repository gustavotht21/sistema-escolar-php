<title>Cursos e disciplinas</title>

<?php $painelAtual = 'Admin'; ?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cursos e disciplinas</title>
    <?php require_once '../../resources/php/action/config.php'?>
    <?php require_once '../../resources/php/action/connection.php'?>
</head>
<body>
    <?php require_once 'header.php'?>

    <div class="container w-75 align-items-center bg-light mt-3 p-2 rounded-2" style="border: 2px solid #0e7490">
        <?php if (@$_GET['pg'] == 'curso') { ?>
            <!-- CADASTRO DE NOVOS CURSOS -->
            <a class="btn btn-success" href="cursos_e_disciplinas.php?pg=curso&cadastra=sim">Cadastrar Curso</a>
            <?php if(@$_GET['cadastra'] == 'sim'){?>
                <h3 class="text-secondary mt-3">Cadastrar curso</h3>
                <?php if(isset($_POST['cadastra'])){
                    $disciplina = $_POST['curso'];

                    $sqlInsertCurso = "INSERT INTO cursos (curso) VALUES ('{$disciplina}')";
                    $result = mysqli_query($connection, $sqlInsertCurso);
                    if ($result) {
                        print "<script language='JavaScript'>window.alert('Curso cadastrado com sucesso');</script>";
                        print "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";
                    } else {
                        print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>Ocorreu um erro ao cadastrar o curso: Curso já cadastrado!</h2>";
                    }

                }?>

                <form action="" class="d-flex" method="post">
                    <input type="text" class="form-control w-50 me-3" name="curso" placeholder="Nome do curso" required>
                    <button class="btn btn-info w-25 text-white fw-bold me-2" name="cadastra">Cadastrar</button>
                    <a class="btn btn-danger w-10 text-white fw-bold"  href="cursos_e_disciplinas.php?pg=curso">Cancelar</a></form>
            <?php }?>

            <!-- EXIBIÇÃO DOS CURSOS -->
            <?php
            $sqlCurs = "SELECT * FROM cursos";
            $resultCurs = mysqli_query($connection, $sqlCurs);

            if (mysqli_num_rows($resultCurs) == 0) {
                print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>Não há nenhum curso cadastrado</h2>";
            } else { ?>
                <h3 class="text-secondary mt-3">Cursos</h3>
                <table class="table table-striped table-secondary">
                    <tr>
                        <td class="fw-semibold">Curso:</td>
                        <td class="fw-semibold">Disciplinas:</td>
                        <td></td>
                    </tr>
                    <tr>
                    <?php while($res_1 = mysqli_fetch_assoc($resultCurs)){ ?>
                        <td><?= $disciplina = $res_1['curso']; ?></td>
                        <td><?php
                            $sqlNumberDiscOfCurs = "SELECT * FROM disciplinas WHERE curso = '{$disciplina}'";
                            $resultNumberDiscOfCurs = mysqli_query($connection, $sqlNumberDiscOfCurs);
                            print mysqli_num_rows($resultNumberDiscOfCurs); ?></td>
                        <td class="text-end">
                            <a href="cursos_e_disciplinas.php?pg=curso&deleta=sim&id=<?php print @$res_1['id']; ?>">
                                <img src="../../public/images/lixeira.png" width="25" alt="Excluir curso">
                            </a>
                        </td>
                    </tr>
                    <?php }?>
                </table>
            <?php } ?>

            <!-- DELEÇÃO DOS CURSOS -->
            <?php if(@$_GET['deleta'] == 'sim'){
                $id = $_GET['id'];

                $sqlDeleteCurs = "DELETE FROM cursos WHERE id = '$id'";
                mysqli_query($connection, $sqlDeleteCurs);

                print "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";

            } }?>
        <?php if(@$_GET['pg'] == 'disciplina'){?>
            <a class="btn btn-success" href="cursos_e_disciplinas.php?pg=disciplina&cadastra=sim">Cadastrar Disciplina</a>
            <?php if(@$_GET['cadastra'] == 'sim'){?>
            <h3 class="text-secondary mt-3">Cadastrar disciplina</h3>
            <?php if(isset($_POST['cadastra'])){

                $curso = $_POST['curso'];
                $disciplina = $_POST['disciplina'];
                $professor = $_POST['professor'];
                $sala = $_POST['sala'];
                $turno = $_POST['turno'];

                $sqlInsertDisc = "INSERT INTO disciplinas (curso, disciplina, professor, sala, turno) VALUES ('{$curso}', '{$disciplina}', '{$professor}', '{$sala}', '{$turno}')";

                $resultInsertDisc = mysqli_query($connection, $sqlInsertDisc);
                if ($resultInsertDisc) {

                } else {
                    print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>Ocorreu um erro ao cadastrar a disciplina!</h2>";
                }

            }?>

            <form action="" class="d-flex flex-wrap" method="post">

                <select class="form-select me-2" aria-label="Default select example" style="width: 180px" name="curso" required>
                    <?php
                    $sqlInsertDisc = "SELECT curso FROM cursos";
                    $result_curso = mysqli_query($connection, $sqlInsertDisc);

                    while($nomeCurso = mysqli_fetch_assoc($result_curso)){
                    ?>
                    <option value="<?=$nomeCurso['curso']?>"><?=$nomeCurso['curso']?></option>
                    <?php } ?>
                </select>

                <input type="text" class="form-control me-2" name="disciplina" placeholder="Nome da disciplina" required style="width: 180px">

                <select class="form-select me-2" aria-label="Default select example" style="width: 180px" name="professor" required>
                    <?php
                    $sqlInsertCurso = "SELECT * FROM professores";
                    $result_curso = mysqli_query($connection, $sqlInsertCurso);

                    while($nomeCurso = mysqli_fetch_assoc($result_curso)){
                        ?>
                        <option value="<?=$nomeCurso['code']?>"><?=$nomeCurso['nome']?></option>
                    <?php } ?>
                </select>

                <input type="number" class="form-control me-2" name="sala" placeholder="Sala" required style="width: 180px">

                <select class="form-select me-2" aria-label="Default select example" style="width: 180px" name="turno" required>
                    <option value="Manhã">Manhã</option>
                    <option value="Tarde">Tarde</option>
                    <option value="Noite">Noite</option>
                </select>
                <div class="mt-2 w-100">
                    <button class="btn btn-info text-white fw-bold w-25" name="cadastra">Cadastrar</button>
                    <a class="btn btn-danger text-white fw-bold w-10"  href="cursos_e_disciplinas.php?pg=disciplina">Cancelar</a>
                </div>

                </form>
        <?php } ?>
        <?php
        $sqlDisc = "SELECT * FROM disciplinas";
        $resultDisc = mysqli_query($connection, $sqlDisc);

        if (mysqli_num_rows($resultDisc) == 0) {
            print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>Não há nenhuma disciplina cadastrada</h2>";
        } else { ?>
            <h3 class="text-secondary mt-3">Disciplinas</h3>
            <table class="table table-striped table-secondary">
                <tr>
                    <td class="fw-semibold">Curso:</td>
                    <td class="fw-semibold">Disciplina:</td>
                    <td class="fw-semibold">Professor:</td>
                    <td class="fw-semibold">Código do professor:</td>
                    <td class="fw-semibold">Sala:</td>
                    <td class="fw-semibold">Turno:</td>
                    <td></td>
                </tr>
                <tr>
                    <?php while($res_1 = mysqli_fetch_assoc($resultDisc)){ ?>
                    <td>
                        <?= $res_1['curso']; ?>
                    </td>
                    <td>
                        <?= $res_1['disciplina']; ?>
                    </td>
                    <td>
                        <?php
                        $sqlSelectNameProfessor = "SELECT * FROM professores WHERE code = '{$res_1['professor']}'";
                        $result_ProfName = mysqli_query($connection, $sqlSelectNameProfessor);

                        while($professor = mysqli_fetch_assoc($result_ProfName)){
                            print $professor['nome'];
                        }
                         ?>
                    </td>
                    <td>
                        <?= $res_1['professor']; ?>
                    </td>
                    <td>
                        <?= $res_1['sala']; ?>
                    </td>
                    <td>
                        <?= $res_1['turno']; ?>
                    </td>
                    <td class="text-end">
                        <a href="cursos_e_disciplinas.php?pg=disciplina&deleta=sim&id=<?php print @$res_1['id']; ?>">
                            <img src="../../public/images/lixeira.png" width="25" alt="Excluir Disciplina">
                        </a>
                    </td>
                </tr>
                <?php }?>
            </table>
        <!-- DELEÇÃO DOS CURSOS -->
        <?php if(@$_GET['deleta'] == 'sim'){
            $id = $_GET['id'];

            $sqlDeleteDisc = "DELETE FROM disciplinas WHERE id = '$id'";
            mysqli_query($connection, $sqlDeleteDisc);

            print "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";

        } } }?>
        <?php if(@$_GET['pg'] == 'cursoedisciplinas'){
            $sqlSelec = "SELECT * FROM cursos";
            $resultSelect = mysqli_query($connection, $sqlSelec);

            if (mysqli_num_rows($resultSelect) == 0) {
                print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>Não há nenhum curso cadastrado</h2>";
            } else { ?>
                <h3 class="text-secondary mt-3">Cursos e disciplinas</h3>
                <table class="table table-striped table-secondary">
                    <tr>
                        <td class="fw-semibold">Curso:</td>
                        <td class="fw-semibold">Disciplinas:</td>
                    </tr>
                    <tr>
                    <?php while($res_1 = mysqli_fetch_assoc($resultSelect)){ ?>
                        <td><?= $disciplina = $res_1['curso']; ?></td>
                        <td>
                            <div class="bg-light p-2 rounded-2" style="max-width: 37.5rem; max-height: 5rem;">
                                <?php
                                $sqlDisc = "SELECT * FROM disciplinas WHERE curso = '{$disciplina}'";
                                $resultDisc = mysqli_query($connection, $sqlDisc);
                                while($res_2 = mysqli_fetch_assoc($resultDisc)){
                                    print $res_2['disciplina'] . '; ';
                                }?>
                            </div>
                            </td>
                    </tr>
                    <?php }?>
                </table>
        <?php

                    } }

        ?>
    </div>
    <?php require_once 'footer.php'?>
</body>
</html>