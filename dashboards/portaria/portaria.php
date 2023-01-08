<?php $painelAtual = 'Portaria'; ?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="public/images/books.png">
    <?php require_once '../../resources/php/action/config.php'?>
    <?php require_once '../../resources/php/action/connection.php'?>
</head>
<body>

    <div class="container mt-5 rounded-2" style="border: 2px solid #0891b2; width: 500px">
        <div class="p-3">
            <div class="row justify-content-between" style="display: flex; align-items: center;">
                <div class="row col-6 w-75" style="margin-top: 12px;">
                    <p class="fw-bold col-auto">Seu código é: </p>
                    <p class="col-auto"><?= $code ?></p>
                </div>
                <a href="../../resources/php/action/config.php?acao=quebra" class="btn btn-danger w-25 col-6 fw-bold">Sair</a>
            </div>
            <div class="text-center">
                <img src="../../public/images/logo.png" alt="Logo" style="width: 200px">
            </div>
            <div class="container text-ce">
                <form class="row g-2 w-100 justify-content-between" method="post" enctype="multipart/form-data">
                    <div class="col-auto w-75">
                        <input type="text" class="form-control" name="cpf" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-info mb-3 text-white fw-bold" name="send">Buscar</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['send'])) {
                    @$_GET['pg'] = '';
                    $search = $_POST['cpf'];

                    $sql = "SELECT * FROM estudantes WHERE cpf='{$search}' OR code='{$search}' OR nome='{$search}'";
                    $result = mysqli_query($connection, $sql);

                    if (mysqli_num_rows($result) <= 0) {
                        print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3'>Nenhum aluno foi encotrado. Verifique as informações inseridas</h2>";
                    } else {
                        while ($res_1 = mysqli_fetch_assoc($result)) {
                            $nome = $res_1['nome'];
                            $code_aluno = $res_1['code'];
                            $rg = $res_1['rg'];
                ?>

                <div class="mt-2 rounded-2 border border-2 p-2" style="">
                    <div class="row">
                        <p class="fw-bold col-auto">Aluno: </p>
                        <p class="col-auto"><?= $nome ?></p>
                    </div>
                    <div class="row">
                        <p class="fw-bold col-auto">N° de matrícula: </p>
                        <p class="col-auto"><?= $code_aluno ?></p>
                    </div>
                    <div class="row">
                        <p class="fw-bold col-auto">RG: </p>
                        <p class="col-auto"><?= $rg ?></p>
                    </div>

                    <a href="portaria.php?pg=confirma&code_a=<?=$code_aluno?>" style="text-decoration: none">
                        <img src="../../public/images/confirma.png" alt="Confirmar" style="width: 25px">
                    </a>
                    <a href="portaria.php" style="text-decoration: none" class="ms-3">
                        <img src="../../public/images/lixeira.png" alt="Cancelar" style="width: 25px">
                    </a>
                </div>
                <?php
                        }
                    }
                }
                ?>

                <?php
                if (@$_GET['pg'] == 'confirma') {
                    $data = date("d/m/Y H:i:s");
                    $date = date("d/m/Y");

                    $code_a = $_GET['code_a'];

                    $sql = "INSERT INTO confirma_entrada_de_alunos (date, data_hoje, porteiro, code_aluno) VALUES ('{$data}', '{$date}', '{$code}', '{$code_a}')";
                    mysqli_query($connection, $sql);

                    print "<script language='JavaScript'>window.alert('Entrada do aluno registrada com sucesso');</script>";
                }
                ?>
            </div>
        </div>
    </div>

</body>
</html>