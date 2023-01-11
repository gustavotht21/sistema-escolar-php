<title>Professores</title>

<?php require_once 'header.php'?>

<div class="container w-75 align-items-center bg-light mt-3 p-2 rounded-2" style="border: 2px solid #0e7490">
    <?php if (@$_GET['pg'] == 'professores') { ?>
    <!-- CADASTRO DE NOVOS PROFESSORES -->
    <a class="btn btn-success" href="professores.php?pg=professores&cadastra=sim">Cadastrar Professor</a>
    <?php if(@$_GET['cadastra'] == 'sim'){?>
        <h3 class="text-secondary mt-3">Cadastrar professor</h3>
        <?php if(isset($_POST['cadastra'])){
            $cadastraProf = [
                'code' => $_POST['code_prof'],
                'status' => $_POST['status_prof'],
                'nome' => $_POST['nome_prof'],
                'cpf' => $_POST['cpf_prof'],
                'nascimento' => $_POST['nascimento_prof'],
                'formacao' => $_POST['formacao_prof'],
                'graduacao' => $_POST['graducao_prof'],
                'pos_graduacao' => $_POST['pos_graduacao_prof'],
                'mestrado' => $_POST['mestrado_prof'],
                'doutorado' => $_POST['doutorado_prof'],
                'salario' => $_POST['salario_prof'],
            ];
            $sqls = [
                    'code' => "SELECT * FROM login WHERE code='{$cadastraProf['code']}'",
                    'cpf' => "SELECT * FROM professores WHERE cpf='{$cadastraProf['cpf']}'",
            ];
            $results = [
                    'code' => mysqli_query($connection, $sqls['code']),
                    'cpf' => mysqli_query($connection, $sqls['cpf']),
            ];
            if (mysqli_num_rows($results['code']) > 0) {
                print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>O código inserido para este professor já existe. Por favor tente inserir outro</h2>";
            } else if (mysqli_num_rows($results['cpf']) > 0) {
                print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>O CPF inserido para este professor já existe. Por favor tente inserir outro</h2>";
            } else {
                $sqlInsertProf = "INSERT INTO professores (code, status, nome, cpf, nascimento, formacao, graduacao, pos_graduacao, mestrado, doutorado, salario) VALUES ('{$cadastraProf['code']}', '{$cadastraProf['status']}', '{$cadastraProf['nome']}', '{$cadastraProf['cpf']}', '{$cadastraProf['nascimento']}', '{$cadastraProf['formacao']}', '{$cadastraProf['graduacao']}', '{$cadastraProf['pos_graduacao']}', '{$cadastraProf['mestrado']}', '{$cadastraProf['doutorado']}', '{$cadastraProf['salario']}')";
                $result = mysqli_query($connection, $sqlInsertProf);
                if ($result) {
                    print "<script language='JavaScript'>window.alert('Professor cadastrado com sucesso');</script>";
                    print "<script language='javascript'>window.location='professores.php?pg=professores';</script>";
                } else {
                    print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>Ocorreu um erro ao cadastrar o professor</h2>";
                }
            }
        }?>

        <form action="" method="post">

            <div class="form-control mb-3">
                <label class="form-label" for="nome_prof">Insira o nome do(a) professor(a)</label>
                <input type="text" class="form-control" id="nome_prof" name="nome_prof" required>
            </div>

            <div class="form-control mb-3">
                <label class="form-label" for="code_prof">Insira o código do(a) professor(a)</label>
                <input type="number" class="form-control mb-2" id="code_prof" name="code_prof" required>
            </div>

            <div class="form-control mb-3">
                <label class="form-label" for="status_prof">Selecione o status do(a) professor(a)</label>
                <select class="form-select mb-2" aria-label="Default select example" id="status_prof" name="status_prof" required>
                    <option value="Ativo">Ativo</option>
                    <option value="Inativo">Inativo</option>
                </select>
            </div>

            <div class="form-control mb-3">
                <label class="form-label" for="cpf_prof">Insira o CPF do(a) professor(a)</label>
                <input type="text" class="form-control mb-2" id="cpf_prof" name="cpf_prof" required>
            </div>

            <div class="form-control mb-3">
                <label class="form-label" for="nascimento_prof">Insira a data de nascimento do(a) professor(a)</label>
                <input type="date" class="form-control mb-2" id="nascimento_prof" name="nascimento_prof" required>
            </div>

            <div class="form-control mb-3">
                <label class="form-label" for="formacao_prof">Insira a formação do(a) professor(a)</label>
                <select class="form-select mb-2" aria-label="Default select example" id="formacao_prof" name="formacao_prof" required>
                    <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
                    <option value="Ensino Médio Completo">Ensino Médio Completo</option>
                    <option value="Ensino Superior Incompleto">Ensino Superior Incompleto</option>
                    <option value="Ensino Superior Completo">Ensino Superior Completo</option>
                </select>
            </div>

            <div class="form-control mb-3">
                <label class="form-label" for="graducao_prof">Insira a graduação do(a) professor(a)</label>
                <input type="text" class="form-control mb-2" id="graducao_prof" name="graducao_prof" required>
            </div>

            <div class="form-control mb-3">
                <label class="form-label" for="pos_graduacao_prof">Insira a pós-graduação do(a) professor(a)</label>
                <input type="text" class="form-control mb-2" id="pos_graduacao_prof" name="pos_graduacao_prof" required>
            </div>

            <div class="form-control mb-3">
                <label class="form-label" for="mestrado_prof">Insira o mestrado do(a) professor(a)</label>
                <input type="text" class="form-control mb-2" id="mestrado_prof" name="mestrado_prof" required>
            </div>

            <div class="form-control mb-3">
                <label class="form-label" for="doutorado_prof">Insira o doutorado do(a) professor(a)</label>
                <input type="text" class="form-control mb-2" id="doutorado_prof" name="doutorado_prof" required>
            </div>

            <div class="form-control mb-3">
                <label class="form-label" for="salario_prof">Insira o salário do(a) professor(a)</label>
                <input type="number" class="form-control mb-2" id="salario_prof" name="salario_prof" required>
            </div>
            <div class="w-100">
                <button class="btn btn-info w-25 text-white fw-bold" name="cadastra">Cadastrar</button>
                <a class="btn btn-danger w-10 text-white fw-bold"  href="professores.php?pg=professores">Cancelar</a>
            </div>

        </form>
    <?php }?>

        <!-- EXIBIÇÃO DOS PROFESSORES -->
        <?php
        $sqlProfs = "SELECT * FROM professores";
        $resultProfs = mysqli_query($connection, $sqlProfs);

        if (mysqli_num_rows($resultProfs) == 0) {
            print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>Não há nenhum professor cadastrado</h2>";
        } else { ?>
            <h3 class="text-secondary mt-3">Professores</h3>
            <table class="table table-striped table-secondary">
                <tr>
                    <td class="fw-semibold">Nome:</td>
                    <td class="fw-semibold">Código:</td>
                    <td class="fw-semibold">Status:</td>
                    <td class="fw-semibold">N° de disciplinas:</td>
                    <td class="fw-semibold">Remuneração:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php while($res_1 = mysqli_fetch_assoc($resultProfs)){ ?>
                    <tr>
                    <td> <?= $res_1['nome'] ?> </td>
                    <td> <?= $res_1['code'] ?> </td>
                    <td> <?= $res_1['status'] ?> </td>
                    <td> <?php
                        $sqlDiscOfProf = "SELECT * FROM disciplinas WHERE professor='{$res_1['code']}'";
                        $resultDiscOfProf = mysqli_query($connection, $sqlDiscOfProf);
                        print mysqli_num_rows($resultDiscOfProf);
                        ?></td>
                    <td> <?= $res_1['salario'] ?> </td>
                    <td class="text-center">
                        <a href="professores.php?pg=professores&acao=edita&id=<?=$res_1['id']?>">
                            <img title="Editar professor" src="../../public/images/pencil.png" width="25" alt="Excluir curso">
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="professores.php?pg=professores&acao=deleta&id=<?=$res_1['id']?>">
                            <img title="Deletar professor" src="../../public/images/lixeira.png" width="25" alt="Excluir curso">
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="professores.php?pg=professores&<?=$res_1['status'] == 'Ativo' ? 'acao=inativa' : 'acao=ativa'?>&id=<?=$res_1['id']?>&code=<?=$res_1['code']?>">
                            <img title="<?=$res_1['status'] == 'Ativo' ? 'Desativar' : 'Ativar'?> professsor" src="../../public/images/<?= $res_1['status'] == 'Ativo' ? 'block' : 'confirma'?>.png" width="25" alt="Excluir curso">
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="professores.php?pg=professores&acao=historico">
                            <img title="Visualizar histórico do professor" src="../../public/images/olho.png" width="25" alt="Visualiza histórico professor">
                        </a>
                    </td>
                </tr>
                <?php }?>
            </table>
            <!-- DELEÇÃO DOS PROFESSORES -->
            <?php if(@$_GET['acao'] == 'deleta'){
                $id = $_GET['id'];

                $sqlDeleteProf = "DELETE FROM professores WHERE id = '{$id}'";
                mysqli_query($connection, $sqlDeleteProf);

                print "<script language='javascript'>window.location='professores.php?pg=professores';</script>";

            } } ?>
            <!-- EDIÇÃO DOS PROFESSORES-->
            <?php if(@$_GET['acao'] == 'edita') {
            $sqlSrcForEdit = "SELECT * FROM professores WHERE id = '{$_GET['id']}'";
            $resultSrcForEdit = mysqli_query($connection, $sqlSrcForEdit);
            $resultSrcForEdit = mysqli_fetch_assoc($resultSrcForEdit);

            ?>
            <h3 class="text-secondary mt-3">Edição de professor(a)</h3>
            <form action="" method="post">

                <div class="form-control mb-3">
                    <label class="form-label" for="nome_prof">Insira o nome do(a) professor(a)</label>
                    <input type="text" class="form-control" id="nome_prof" name="nome_prof" required value="<?=$resultSrcForEdit['nome']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="code_prof">Insira o código do(a) professor(a)</label>
                    <input type="number" class="form-control mb-2" id="code_prof" name="code_prof" required value="<?=$resultSrcForEdit['code']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="status_prof">Selecione o status do(a) professor(a)</label>
                    <select class="form-select mb-2" aria-label="Default select example" id="status_prof" name="status_prof" required>
                        <option <?=$resultSrcForEdit['status'] == 'Ativo' ? 'selected' : ''?> value="Ativo">Ativo</option>
                        <option <?=$resultSrcForEdit['status'] == 'Inativo' ? 'selected' : ''?> value="Inativo">Inativo</option>
                    </select>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="cpf_prof">Insira o CPF do(a) professor(a)</label>
                    <input type="text" class="form-control mb-2" id="cpf_prof" name="cpf_prof" required value="<?=$resultSrcForEdit['cpf']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="nascimento_prof">Insira a data de nascimento do(a) professor(a)</label>
                    <input type="date" class="form-control mb-2" id="nascimento_prof" name="nascimento_prof" required value="<?=$resultSrcForEdit['nascimento']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="formacao_prof">Insira a formação do(a) professor(a)</label>
                    <select class="form-select mb-2" aria-label="Default select example" id="formacao_prof" name="formacao_prof" required>
                        <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
                        <option <?=$resultSrcForEdit['formacao'] == 'Ensino Médio Completo' ? 'selected' : ''?> value="Ensino Médio Completo">Ensino Médio Completo</option>
                        <option <?=$resultSrcForEdit['formacao'] == 'Ensino Superior Incompleto' ? 'selected' : ''?> value="Ensino Superior Incompleto">Ensino Superior Incompleto</option>
                        <option <?=$resultSrcForEdit['formacao'] == 'Ensino Superior Completo' ? 'selected' : ''?> value="Ensino Superior Completo">Ensino Superior Completo</option>
                    </select>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="graducao_prof">Insira a graduação do(a) professor(a)</label>
                    <input type="text" class="form-control mb-2" id="graducao_prof" name="graducao_prof" required value="<?=$resultSrcForEdit['graduacao']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="pos_graduacao_prof">Insira a pós-graduação do(a) professor(a)</label>
                    <input type="text" class="form-control mb-2" id="pos_graduacao_prof" name="pos_graduacao_prof" required value="<?=$resultSrcForEdit['pos_graduacao']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="mestrado_prof">Insira o mestrado do(a) professor(a)</label>
                    <input type="text" class="form-control mb-2" id="mestrado_prof" name="mestrado_prof" required value="<?=$resultSrcForEdit['mestrado']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="doutorado_prof">Insira o doutorado do(a) professor(a)</label>
                    <input type="text" class="form-control mb-2" id="doutorado_prof" name="doutorado_prof" required value="<?=$resultSrcForEdit['doutorado']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="salario_prof">Insira o salário do(a) professor(a)</label>
                    <input type="number" class="form-control mb-2" id="salario_prof" name="salario_prof" required value="<?=$resultSrcForEdit['salario']?>">
                </div>
                <div class="w-100">
                    <button class="btn btn-info w-25 text-white fw-bold" name="salva">Salvar alterações</button>
                    <a class="btn btn-danger w-10 text-white fw-bold"  href="professores.php?pg=professores">Cancelar</a>
                </div>

            </form>
            <?php
            if (isset($_POST['salva'])) {
                $editaProf = [
                    'code' => $_POST['code_prof'],
                    'status' => $_POST['status_prof'],
                    'nome' => $_POST['nome_prof'],
                    'cpf' => $_POST['cpf_prof'],
                    'nascimento' => $_POST['nascimento_prof'],
                    'formacao' => $_POST['formacao_prof'],
                    'graduacao' => $_POST['graducao_prof'],
                    'pos_graduacao' => $_POST['pos_graduacao_prof'],
                    'mestrado' => $_POST['mestrado_prof'],
                    'doutorado' => $_POST['doutorado_prof'],
                    'salario' => $_POST['salario_prof'],
                ];
                $sqlExeForEdit = "UPDATE professores SET nome='{$editaProf['nome']}', code='{$editaProf['code']}', status='{$editaProf['status']}', cpf='{$editaProf['cpf']}', nascimento='{$editaProf['nascimento']}', formacao='{$editaProf['formacao']}', graduacao='{$editaProf['graduacao']}', pos_graduacao='{$editaProf['pos_graduacao']}', mestrado='{$editaProf['mestrado']}', doutorado='{$editaProf['doutorado']}', salario='{$editaProf['salario']}' WHERE id = '{$_GET['id']}'";

                $sqlLogin = "UPDATE login SET status='{$editaProf['status']}', code='{$editaProf['code']}', password='{$editaProf['code']}', name='{$editaProf['nome']}' WHERE code='{$resultSrcForEdit['code']}'";
                if (mysqli_query($connection, $sqlExeForEdit) && mysqli_query($connection, $sqlLogin)) {
                    print "<script language='JavaScript'>window.alert('Informações de professores editadas e salvas com sucesso');</script>";
                    print "<script language='javascript'>window.location='professores.php?pg=professores';</script>";
                } else {
                    print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>Ocorreu um erro ao tentar editar as informações do professor(a)</h2>";
                }

            }

            } }?>

            <?php if($_GET['acao'] == 'ativa') {
                $sqlEdit = "UPDATE professores SET status='Ativo' WHERE id='{$_GET['id']}'";
                mysqli_query($connection, $sqlEdit);
                $sqlEdit = "UPDATE login SET status='Ativo' WHERE code='{$_GET['code']}'";
                mysqli_query($connection, $sqlEdit);
                print "<script language='javascript'>window.location='professores.php?pg=professores';</script>";
            } else if ($_GET['acao'] == 'inativa') {
                $sqlEdit = "UPDATE professores SET status='Inativo' WHERE id='{$_GET['id']}'";
                mysqli_query($connection, $sqlEdit);
                $sqlEdit = "UPDATE login SET status='Inativo' WHERE code='{$_GET['code']}'";
                mysqli_query($connection, $sqlEdit);
                print "<script language='javascript'>window.location='professores.php?pg=professores';</script>";
            }?>
</div>

<?php require_once 'footer.php'?>