<?php $painelAtual = 'Admin'; ?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Histórico do aluno</title>
    <?php require_once '../../resources/php/action/connection.php'?>
    <?php require_once '../../resources/php/action/config.php'?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../public/images/books.png">
</head>
<body>
    <?php
    $credencials = [
        'id' => base64_decode($_GET['id']),
    ];
    $sqls = [
        'dados' => "SELECT * FROM estudantes WHERE id='{$credencials['id']}'",
    ];
    $results = [
        'dados' => mysqli_query($connection, $sqls['dados']),
    ];
    $dados = mysqli_fetch_assoc($results['dados']);
    ?>
    <div class="container mt-3">
        <a href="estudantes.php?pg=estudantes" class="btn btn-info text-white fw-bold">Voltar para a tela de alunos</a>
        <h2 class="text-secondary mt-3">Dados do(a) aluno(a)</h2>
        <table class="table table-striped mt-3 align-middle">
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
                <td class="fw-bold">Curso:</td>
                <td class="fw-bold">Turno:</td>
                <td class="fw-bold">Mensalidade:</td>
            </tr>
            <tr>
                <td><?=$dados['curso']?></td>
                <td><?=$dados['turno']?></td>
                <td><?=$dados['mensalidade']?></td>
            </tr>

            <tr>
                <td class="fw-bold">Mãe:</td>
                <td class="fw-bold">Pai:</td>
                <td class="fw-bold">Celular:</td>
            </tr>
            <tr>
                <td><?=$dados['mae']?></td>
                <td><?=$dados['pai']?></td>
                <td><?=$dados['celular']?></td>
            </tr>

            <tr>
                <td class="fw-bold">Atendimento especial:</td>
                <td class="fw-bold">Telefone cobrança:</td>
                <td class="fw-bold">Data de nascimento:</td>
            </tr>
            <tr>
                <td><?=$dados['tel_residencial']?></td>
                <td><?=$dados['tel_cobranca']?></td>
                <td><?=$dados['nascimento']?></td>
            </tr>

            <tr>
                <td class="fw-bold">Estado:</td>
                <td class="fw-bold">Cidade:</td>
                <td class="fw-bold">Bairro:</td>
            </tr>
            <tr>
                <td><?=$dados['estado']?></td>
                <td><?=$dados['cidade']?></td>
                <td><?=$dados['bairro']?></td>
            </tr>
        </table>
    </div>
</body>
</html>