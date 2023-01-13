<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="public/images/books.png">

    <link rel="stylesheet" href="resources/css/style.css">

    <?php require_once "resources/php/action/connection.php"?>
</head>
<body class="bg-info-10">
    <div id="logo" class="mt-4">
        <img src="public/images/logo.png" alt="Logo">
    </div>

    <div class="container w-25 rounded-2" style="border: 2px solid #0891b2">

        <?php
        if (isset($_POST['submit'])) {
            $code = $_POST['code'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM login WHERE code='{$code}' and password='{$password}'";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($res_1 = mysqli_fetch_assoc($result)) {
                    $status = $res_1['status'];
                    $code = $res_1['code'];
                    $password = $res_1['password'];
                    $name = $res_1['name'];
                    $dashboard = $res_1['dashboard'];

                    if ($status == 'Inativo') {
                        print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3'>Você está inativo, procure a administração!</h2>";
                    } else {
                        session_start();
                        $_SESSION['code'] = $code;
                        $_SESSION['password'] = $password;
                        $_SESSION['name'] = $name;
                        $_SESSION['dashboard'] = $dashboard;

                        if ($dashboard == 'Admin') {
                            header('Location: /dashboards/admin/admin.php');
                        } else if ($dashboard == 'Aluno') {
                            header('Location: /dashboards/aluno/aluno.php');
                        } else if ($dashboard == 'Portaria') {
                            header('Location: /dashboards/portaria/portaria.php');
                        } else if ($dashboard == 'Professor') {
                            header('Location: /dashboards/professor/professores.php');
                        } else if ($dashboard == 'Tesouraria') {
                            header('Location: /dashboards/tesouraria/tesouraria.php');
                        }
                    }
                }

            } else {
                print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3'>Credenciais incorretas!</h2>";
            }

        }
        ?>

        <form action="" method="post" enctype="multipart/form-data" class="p-2 pt-3 pb-4">
            <div class="form-group mb-3">
                <label for="code" class="fw-semibold text-secondary mb-2" style="font-size: 15px">Insira o N° de cartão ou Código de acesso: </label>
                <input type="text" name="code" class="form-control bg-info-10" style="color: #0e7490" required>
            </div>
            <div class="form-group mb-3">
                <label for="password" class="fw-semibold text-secondary mb-2" style="font-size: 15px">Insira a sua senha: </label>
                <input type="password" name="password" class="form-control" style="color: #0e7490" required>
            </div>
            <div class="mt-3">
                <button type="submit" name="submit" class="btn btn-info w-50 text-white fw-bold">Entrar</button>
            </div>
        </form>
    </div>
</body>
</html>