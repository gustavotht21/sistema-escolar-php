<?php $painelAtual = 'Admin'; ?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Histórico do professor</title>
    <?php require_once '../../resources/php/action/connection.php'?>
    <?php require_once '../../resources/php/action/config.php'?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../public/images/books.png">
</head>
<body>
    <?php
    $credencials = [
            'id' => base64_decode($_GET['id']),
            'code' => base64_decode($_GET['code']),
    ];
    $sqls = [
      'dados' => "SELECT * FROM professores WHERE id='{$credencials['id']}'",
      'disciplinas' => "SELECT * FROM disciplinas WHERE professor='{$credencials['code']}'",
    ];
    $results = [
      'dados' => mysqli_query($connection, $sqls['dados']),
      'disciplinas' => mysqli_query($connection, $sqls['disciplinas']),
    ];
    $dados = mysqli_fetch_assoc($results['dados']);
    ?>
    <div class="container mt-3">
        <a href="professores.php?pg=professores" class="btn btn-info text-white fw-bold">Voltar para a tela de professores</a>
        <h2 class="text-secondary mt-3">Dados do(a) professor(a)</h2>
        <table class="table table-striped mt-3">
            <tr>
                <td class="fw-bold">Nome:</td>
                <td class="fw-bold">Código:</td>
                <td class="fw-bold">CPF:</td>
            </tr>
            <tr>
                <td><?=$dados['nome']?></td>
                <td><?=$dados['code']?></td>
                <td><?=$dados['cpf']?></td>
            </tr>
            <tr>
                <td class="fw-bold">Status:</td>
                <td class="fw-bold">Nascimento:</td>
                <td class="fw-bold">Salário:</td>
            </tr>
            <tr>
                <td><?=$dados['status']?></td>
                <td><?=$dados['nascimento']?></td>
                <td><?=$dados['salario']?></td>
            </tr>
            <tr>
                <td class="fw-bold">Formação:</td>
                <td class="fw-bold">Graduação:</td>
                <td class="fw-bold">Pós Graduação:</td>
            </tr>
            <tr>
                <td><?=$dados['formacao']?></td>
                <td><?=$dados['graduacao']?></td>
                <td><?=$dados['pos_graduacao']?></td>
            </tr>
            <tr>
                <td class="fw-bold">Mestrado:</td>
                <td class="fw-bold">Doutorado:</td>
                <td></td>
            </tr>
            <tr>
                <td><?=$dados['mestrado']?></td>
                <td><?=$dados['doutorado']?></td>
                <td></td>
            </tr>
        </table>
        <h2 class="text-secondary mt-3">Disciplinas que o(a) professor(a) ministra</h2>
        <table class="table table-striped mt-3">
            <tr>
                <td class="fw-bold">Nome da disciplina:</td>
                <td class="fw-bold">Curso da disciplina:</td>
                <td class="fw-bold">Sala da disciplina:</td>
                <td class="fw-bold">Turno da disciplina:</td>
            </tr>
            <?php while ($disciplinas = mysqli_fetch_assoc($results['disciplinas'])) {?>
            <tr>
                <td><?=$disciplinas['disciplina']?></td>
                <td><?=$disciplinas['curso']?></td>
                <td><?=$disciplinas['sala']?></td>
                <td><?=$disciplinas['turno']?></td>
            </tr>
            <?php }?>
        </table>
    </div>
</body>
</html>