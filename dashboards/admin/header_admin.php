<?php $painelAtual = 'Admin'; ?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="../../public/images/books.png">


    <link rel="stylesheet" href="header_admin.css">
    <?php require_once '../../resources/php/action/connection.php'?>

</head>
<body>
    <div class="container text-center justify-content-center w-75 mt-3">
        <div class="row d-flex align-items-center">
            <div class="col">
                <img src="../../public/images/logo.png" alt="Logo" width="200">
            </div>
            <div class="col">
                <form action="" class="d-flex">
                    <input type="text" class="form-control w-75 me-3" name="key">
                    <button class="btn btn-info w-25 text-white fw-bold" name="search">Buscar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="mt-2" style="display: flex; gap: 20px; justify-content: center; align-items: center;">
        <p class="fw-bold">Bem-vindo! O seu código de acesso é:</p>
        <p class=""><?= $_SESSION['code'] ?></p>
    </div>
    <div class="container text-center">
        <a href="../../resources/php/action/config.php?acao=quebra" class="btn btn-danger fw-bold" style="width: 120px;">Sair</a>
    </div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-info mt-3">
        <div class="container-fluid">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" aria-current="page" href="admin.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a type="button" class="bg-info border-0 dropdown-toggle text-white fw-bold nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" _msthash="1940757" _msttexthash="876850" style="text-decoration: none">
                            Cursos e disciplinas
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start" style="" _msthidden="3">
                            <li _msthidden="1">
                                <a class="dropdown-item" type="button" _msthash="2644486" _msttexthash="76466" _msthidden="1" href="cursos_e_disciplinas.php?pg=curso">
                                    Cadastrar curso
                                </a>
                            </li>
                            <li _msthidden="1">
                                <a class="dropdown-item" type="button" _msthash="2644733" _msttexthash="232752" _msthidden="1" href="cursos_e_disciplinas.php?pg=disciplina">
                                    Cadastrar disciplina
                                </a>
                            </li>
                            <li _msthidden="1">
                                <a class="dropdown-item" type="button" _msthash="2644980" _msttexthash="349791" _msthidden="1" href="cursos_e_disciplinas.php?pg=cursoedisciplinas">
                                    Cursos & disciplinas
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="professores.php?pg=professores">Professores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="estudantes.php?pg=estudantes">Estudantes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="setor_financeiro.php">Setor financeiro</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a type="button" class="bg-info border-0 dropdown-toggle text-white fw-bold nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" _msthash="1940757" _msttexthash="876850" style="text-decoration: none">
                            Relatórios
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start" style="" _msthidden="3">
                            <li _msthidden="1">
                                <a class="dropdown-item" type="button" _msthash="2644486" _msttexthash="76466" _msthidden="1" href="#">
                                    Alunos
                                </a>
                            </li>
                            <li _msthidden="1">
                                <a class="dropdown-item" type="button" _msthash="2644733" _msttexthash="232752" _msthidden="1" href="#">
                                    Professores
                                </a>
                            </li>
                            <li _msthidden="1">
                                <a class="dropdown-item" type="button" _msthash="2644980" _msttexthash="349791" _msthidden="1" href="#">
                                    Fluxo de caixa
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="suporte_tecnico.php">Suporte técnico</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a type="button" class="bg-info border-0 dropdown-toggle text-white fw-bold nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" _msthash="1940757" _msttexthash="876850" style="text-decoration: none">
                            Extras
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start" style="" _msthidden="3">
                            <li _msthidden="1">
                                <a class="dropdown-item" type="button" _msthash="2644486" _msttexthash="76466" _msthidden="1" href="funcionarios.php?pg=todos">
                                    Funcionários
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>