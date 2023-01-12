<title>Alunos</title>

<?php require_once 'header_admin.php' ?>

<div class="container w-75 align-items-center bg-light mt-3 p-2 rounded-2" style="border: 2px solid #0e7490">
    <?php if (@$_GET['pg'] == 'estudantes') { ?>
        <!-- CADASTRO DE NOVOS ESTUDANTES -->
        <a class="btn btn-success" href="estudantes.php?pg=estudantes&cadastra=sim">Cadastrar Estudante</a>
        <?php if(@$_GET['cadastra'] == 'sim'){?>
            <h3 class="text-secondary mt-3">Cadastrar estudante</h3>
            <div class="bg-secondary w-50" style="height: 2px;"></div>
            <?php if(isset($_POST['cadastra'])){
                $cadastraAlun = [
                    'nome' => $_POST['nome_alun'],
                    'code' => $_POST['code_alun'],
                    'status' => $_POST['status_alun'],
                    'cpf' => $_POST['cpf_alun'],
                    'rg' => $_POST['rg_alun'],
                    'nascimento' => $_POST['nascimento_alun'],
                    'mae' => $_POST['mae_alun'],
                    'pai' => $_POST['pai_alun'],
                    'estado' => $_POST['estado_alun'],
                    'cidade' => $_POST['cidade_alun'],
                    'bairro' => $_POST['bairro_alun'],
                    'endereco' => $_POST['endereco_alun'],
                    'complemento' => $_POST['complemento_alun'],
                    'cep' => $_POST['cep_alun'],
                    'tel_residencial' => $_POST['tel_residencial_alun'],
                    'celular' => $_POST['celular_alun'],
                    'curso' => $_POST['curso_alun'],
                    'turno' => $_POST['turno_alun'],
                    'atendimento_especial' => $_POST['atendimento_especial_alun'],
                    'mensalidade' => $_POST['mensalidade_alun'],
                    'vencimento' => $_POST['vencimento_alun'],
                ];
                $sqls = [
                    'code' => "SELECT * FROM login WHERE code='{$cadastraAlun['code']}'",
                    'cpf' => "SELECT * FROM estudantes WHERE cpf='{$cadastraAlun['cpf']}'",
                ];
                $results = [
                    'code' => mysqli_query($connection, $sqls['code']),
                    'cpf' => mysqli_query($connection, $sqls['cpf']),
                ];
                if (mysqli_num_rows($results['code']) > 0) {
                    print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>O código inserido para este aluno já existe. Por favor, tente inserir outro</h2>";
                } else if (mysqli_num_rows($results['cpf']) > 0) {
                    print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>O CPF inserido para este aluno já existe. Por favor, tente inserir outro</h2>";
                } else if ($cadastraAlun['code'] == 0) {
                    print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>O campo de Código não pode ser negativo</h2>";
                } else {
                    $sql = "SELECT id FROM estudantes ORDER BY id DESC";
                    $result = mysqli_query($connection, $sql);
                    $result = mysqli_fetch_assoc($result);
                    $result['id'] += 1;
                    $matricula = "{$cadastraAlun['code']}{$result['id']}";
                    $dataCobranca = [
                            'data_cheia' => date('Y-m-d'),
                            'data_dia' => date('d'),
                            'data_mes' => date('m'),
                            'data_ano' => date('Y'),
                    ];
                    $sqls = [
                        'estudantes' => "INSERT INTO estudantes (code, status, nome, cpf, rg, nascimento, mae, pai, estado, cidade, bairro, endereco, complemento, cep, tel_residencial, celular, curso, turno, atendimento_especial, mensalidade, vencimento, tel_cobranca) VALUES ('{$cadastraAlun['code']}', '{$cadastraAlun['status']}', '{$cadastraAlun['nome']}', '{$cadastraAlun['cpf']}', '{$cadastraAlun['rg']}', '{$cadastraAlun['nascimento']}', '{$cadastraAlun['mae']}', '{$cadastraAlun['pai']}', '{$cadastraAlun['estado']}', '{$cadastraAlun['cidade']}', '{$cadastraAlun['bairro']}', '{$cadastraAlun['endereco']}', '{$cadastraAlun['complemento']}', '{$cadastraAlun['cep']}', '{$cadastraAlun['tel_residencial']}', '{$cadastraAlun['celular']}', '{$cadastraAlun['curso']}', '{$cadastraAlun['turno']}', '{$cadastraAlun['atendimento_especial']}', '{$cadastraAlun['mensalidade']}', '{$cadastraAlun['vencimento']}', '{$cadastraAlun['tel_cobranca']}')",

                        'login' => "INSERT INTO login (status, code, password, name, dashboard) VALUES ('{$cadastraAlun['status']}', '{$cadastraAlun['code']}', '{$cadastraAlun['code']}', '{$cadastraAlun['nome']}', 'Aluno')",

                        'mensalidades' => "INSERT INTO mensalidades (code, matricula, d_cobranca, vencimento, valor, status, dia, mes, ano, dia_pagamento, data_pagamento, d_p, m_p, a_p, metodo_pagamento) VALUES ('{$cadastraAlun['code']}', '{$matricula}', '{$dataCobranca['data_cheia']}', '{$cadastraAlun['vencimento']}', '{$cadastraAlun['mensalidade']}', 'Aguardando pagamento', '{$dataCobranca['data_dia']}', '{$dataCobranca['data_mes']}', '{$dataCobranca['data_ano']}', '', '', '', '', '', '')",
                    ];
                    $results = [
                        'estudantes' => mysqli_query($connection, $sqls['estudantes']),
                        'login' => mysqli_query($connection, $sqls['login']),
                        'mensalidades' => mysqli_query($connection, $sqls['mensalidades'])
                    ];
                    if ($results['estudantes'] && $results['login'] && $results['mensalidades']) {
                        print "<script language='JavaScript'>window.alert('Aluno cadastrado com sucesso');</script>";
                        print "<script language='javascript'>window.location='estudantes.php?pg=estudantes';</script>";
                    } else {
                        print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>Ocorreu um erro ao cadastrar o aluno</h2>";
                    }
                }
            }?>

            <form action="" method="post">

                <h4 class="text-secondary mt-3">Informações pessoais</h4>
                <div class="bg-secondary w-25 mb-3" style="height: 2px;"></div>

                <div class="form-control mb-3">
                    <label class="form-label" for="nome_alun">Insira o nome do(a) aluno(a)</label>
                    <input type="text" class="form-control" id="nome_alun" name="nome_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="code_alun">Insira o código do(a) aluno(a)</label>
                    <input type="number" class="form-control mb-2" id="code_alun" name="code_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="status_alun">Selecione o status do(a) aluno(a)</label>
                    <select class="form-select mb-2" aria-label="Default select example" id="status_alun" name="status_alun" required>
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="cpf_alun">Insira o CPF do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="cpf_alun" name="cpf_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="rg_alun">Insira o RG do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="rg_alun" name="rg_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="nascimento_alun">Insira a data de nascimento do(a) aluno(a)</label>
                    <input type="date" class="form-control mb-2" id="nascimento_alun" name="nascimento_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="mae_alun">Insira o nome da mãe do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="mae_alun" name="mae_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="pai_alun">Insira do pai do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="pai_alun" name="pai_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="estado_alun">Insira o estado do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="estado_alun" name="estado_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="cidade_alun">Insira a cidade do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="cidade_alun" name="cidade_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="bairro_alun">Insira o bairro do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="bairro_alun" name="bairro_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="endereco_alun">Insira o endereço do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="endereco_alun" name="endereco_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="complemento_alun">Insira o complemento do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="complemento_alun" name="complemento_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="cep_alun">Insira o CEP do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="cep_alun" name="cep_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="tel_residencial_alun">Insira o telefone residencial do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="tel_residencial_alun" name="tel_residencial_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="celular_alun">Insira o celular do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="celular_alun" name="celular_alun" required>
                </div>

                <h4 class="text-secondary">Informações técnicas</h4>
                <div class="bg-secondary w-25 mb-3" style="height: 2px;"></div>

                <div class="form-control mb-3">
                    <label class="form-label" for="curso_alun">Insira o curso do(a) aluno(a)</label>
                    <select class="form-select me-2" aria-label="Default select example" id="curso_alun" name="curso_alun" required>
                        <?php
                        $sqlSrcCurs = "SELECT curso FROM cursos";
                        $result_curso = mysqli_query($connection, $sqlSrcCurs);

                        while($nomeCurso = mysqli_fetch_assoc($result_curso)){
                            ?>
                            <option value="<?=$nomeCurso['curso']?>"><?=$nomeCurso['curso']?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="turno_alun">Insira o turno do(a) aluno(a)</label>
                    <select class="form-select mb-2" aria-label="Default select example" id="turno_alun" name="turno_alun" required>
                        <option value="Manhã">Manhã</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Noite">Noite</option>
                    </select>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="atendimento_especial_alun">Insira a necessidade especial do(a) aluno(a)</label>
                    <select class="form-select mb-2" aria-label="Default select example" id="atendimento_especial_alun" name="atendimento_especial_alun" required>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="mensalidade_alun">Insira a mensalidade do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="mensalidade_alun" name="mensalidade_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="vencimento_alun">Insira a data de vencimento do(a) aluno(a)</label>
                    <input type="date" class="form-control mb-2" id="vencimento_alun" name="vencimento_alun" required>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="tel_cobranca_alun">Insira o número de cobrança do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="tel_cobranca_alun" name="tel_cobranca_alun" required>
                </div>

                <div class="w-100">
                    <button class="btn btn-info w-25 text-white fw-bold" name="cadastra">Cadastrar</button>
                    <a class="btn btn-danger w-10 text-white fw-bold"  href="estudantes.php?pg=estudantes">Cancelar</a>
                </div>

            </form>
        <?php }?>

        <!-- EXIBIÇÃO DOS ESTUDANTES -->
        <?php
        $sqlProfs = "SELECT * FROM estudantes";
        $resultProfs = mysqli_query($connection, $sqlProfs);

        if (mysqli_num_rows($resultProfs) == 0) {
            print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>Não há nenhum aluno cadastrado</h2>";
        } else { ?>
            <h3 class="text-secondary mt-3">Estudantes</h3>
            <table class="table table-striped table-secondary">
                <tr>
                    <td class="fw-semibold">Nome:</td>
                    <td class="fw-semibold">Código:</td>
                    <td class="fw-semibold">Status:</td>
                    <td class="fw-semibold">Curso:</td>
                    <td class="fw-semibold">Turno:</td>
                    <td class="fw-semibold">Mensalidade:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php while($res_alun = mysqli_fetch_assoc($resultProfs)){ ?>
                    <tr>
                        <td> <?= $res_alun['nome'] ?> </td>
                        <td> <?= $res_alun['code'] ?> </td>
                        <td> <?= $res_alun['status'] ?> </td>
                        <td> <?= $res_alun['curso'] ?> </td>
                        <td> <?= $res_alun['turno'] ?> </td>
                        <td> <?= $res_alun['mensalidade'] ?> </td>
                        <td class="text-center">
                            <a href="estudantes.php?pg=estudantes&acao=deleta&id=<?=base64_encode($res_alun['id'])?>&code=<?=base64_encode($res_alun['code'])?>">
                                <img title="Deletar aluno" src="../../public/images/lixeira.png" width="25" alt="Excluir curso">
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="estudantes.php?pg=estudantes&<?=$res_alun['status'] == 'Ativo' ? 'acao=inativa' : 'acao=ativa'?>&id=<?=$res_alun['id']?>&code=<?=$res_alun['code']?>">
                                <img title="<?=$res_alun['status'] == 'Ativo' ? 'Desativar' : 'Ativar'?> professsor" src="../../public/images/<?= $res_alun['status'] == 'Ativo' ? 'block' : 'confirma'?>.png" width="25" alt="Excluir curso">
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="dados_aluno.php?id=<?=base64_encode($res_alun['id'])?>&code=<?=base64_encode($res_alun['code'])?>">
                                <img class="bg-light rounded-circle" title="Visualizar dados do aluno" src="../../public/images/olho.png" width="25" alt="Visualizar dados aluno">
                            </a>
                        </td>
                    </tr>
                <?php }?>
            </table>
            <!-- DELEÇÃO DOS ESTUDANTES -->
            <?php if(@$_GET['acao'] == 'deleta'){
                $id = base64_decode($_GET['id']);
                $code = base64_decode($_GET['code']);

                $sqlDeleteAlun = "DELETE FROM estudantes WHERE id = '{$id}'";
                mysqli_query($connection, $sqlDeleteAlun);
                $sqlDeleteAlun = "DELETE FROM login WHERE code = '{$code}'";
                mysqli_query($connection, $sqlDeleteAlun);

                print "<script language='javascript'>window.location='estudantes.php?pg=estudantes';</script>";

            } } ?>
        <!-- EDIÇÃO DOS ESTUDANTES-->
        <?php if(@$_GET['acao'] == 'edita') {
            $sqlSrcForEdit = "SELECT * FROM estudantes WHERE id = '{$_GET['id']}'";
            $resultSrcForEdit = mysqli_query($connection, $sqlSrcForEdit);
            $resultSrcForEdit = mysqli_fetch_assoc($resultSrcForEdit);

            ?>
            <h3 class="text-secondary mt-3">Edição de aluno(a)</h3>
            <form action="" method="post">

                <div class="form-control mb-3">
                    <label class="form-label" for="nome_alun">Insira o nome do(a) aluno(a)</label>
                    <input type="text" class="form-control" id="nome_alun" name="nome_alun" required value="<?=$resultSrcForEdit['nome']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="code_alun">Insira o código do(a) aluno(a)</label>
                    <input type="number" class="form-control mb-2" id="code_alun" name="code_alun" required value="<?=$resultSrcForEdit['code']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="status_alun">Selecione o status do(a) aluno(a)</label>
                    <select class="form-select mb-2" aria-label="Default select example" id="status_alun" name="status_alun" required>
                        <option <?=$resultSrcForEdit['status'] == 'Ativo' ? 'selected' : ''?> value="Ativo">Ativo</option>
                        <option <?=$resultSrcForEdit['status'] == 'Inativo' ? 'selected' : ''?> value="Inativo">Inativo</option>
                    </select>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="cpf_alun">Insira o CPF do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="cpf_alun" name="cpf_alun" required value="<?=$resultSrcForEdit['cpf']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="nascimento_alun">Insira a data de nascimento do(a) aluno(a)</label>
                    <input type="date" class="form-control mb-2" id="nascimento_alun" name="nascimento_alun" required value="<?=$resultSrcForEdit['nascimento']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="formacao_alun">Insira a formação do(a) aluno(a)</label>
                    <select class="form-select mb-2" aria-label="Default select example" id="formacao_alun" name="formacao_alun" required>
                        <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
                        <option <?=$resultSrcForEdit['formacao'] == 'Ensino Médio Completo' ? 'selected' : ''?> value="Ensino Médio Completo">Ensino Médio Completo</option>
                        <option <?=$resultSrcForEdit['formacao'] == 'Ensino Superior Incompleto' ? 'selected' : ''?> value="Ensino Superior Incompleto">Ensino Superior Incompleto</option>
                        <option <?=$resultSrcForEdit['formacao'] == 'Ensino Superior Completo' ? 'selected' : ''?> value="Ensino Superior Completo">Ensino Superior Completo</option>
                    </select>
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="graducao_alun">Insira a graduação do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="graducao_alun" name="graducao_alun" required value="<?=$resultSrcForEdit['graduacao']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="pos_graduacao_alun">Insira a pós-graduação do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="pos_graduacao_alun" name="pos_graduacao_alun" required value="<?=$resultSrcForEdit['pos_graduacao']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="mestrado_alun">Insira o mestrado do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="mestrado_alun" name="mestrado_alun" required value="<?=$resultSrcForEdit['mestrado']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="doutorado_alun">Insira o doutorado do(a) aluno(a)</label>
                    <input type="text" class="form-control mb-2" id="doutorado_alun" name="doutorado_alun" required value="<?=$resultSrcForEdit['doutorado']?>">
                </div>

                <div class="form-control mb-3">
                    <label class="form-label" for="salario_alun">Insira o salário do(a) aluno(a)</label>
                    <input type="number" class="form-control mb-2" id="salario_alun" name="salario_alun" required value="<?=$resultSrcForEdit['salario']?>">
                </div>
                <div class="w-100">
                    <button class="btn btn-info w-25 text-white fw-bold" name="salva">Salvar alterações</button>
                    <a class="btn btn-danger w-10 text-white fw-bold"  href="estudantes.php?pg=estudantes">Cancelar</a>
                </div>

            </form>
            <?php
            if (isset($_POST['salva'])) {
                $editaProf = [
                    'code' => $_POST['code_alun'],
                    'status' => $_POST['status_alun'],
                    'nome' => $_POST['nome_alun'],
                    'cpf' => $_POST['cpf_alun'],
                    'nascimento' => $_POST['nascimento_alun'],
                    'formacao' => $_POST['formacao_alun'],
                    'graduacao' => $_POST['graducao_alun'],
                    'pos_graduacao' => $_POST['pos_graduacao_alun'],
                    'mestrado' => $_POST['mestrado_alun'],
                    'doutorado' => $_POST['doutorado_alun'],
                    'salario' => $_POST['salario_alun'],
                ];
                $sqlExeForEdit = "UPDATE estudantes SET nome='{$editaProf['nome']}', code='{$editaProf['code']}', status='{$editaProf['status']}', cpf='{$editaProf['cpf']}', nascimento='{$editaProf['nascimento']}', formacao='{$editaProf['formacao']}', graduacao='{$editaProf['graduacao']}', pos_graduacao='{$editaProf['pos_graduacao']}', mestrado='{$editaProf['mestrado']}', doutorado='{$editaProf['doutorado']}', salario='{$editaProf['salario']}' WHERE id = '{$_GET['id']}'";

                $sqlLogin = "UPDATE login SET status='{$editaProf['status']}', code='{$editaProf['code']}', password='{$editaProf['code']}', name='{$editaProf['nome']}' WHERE code='{$resultSrcForEdit['code']}'";
                if (mysqli_query($connection, $sqlExeForEdit) && mysqli_query($connection, $sqlLogin)) {
                    print "<script language='JavaScript'>window.alert('Informações de estudantes editadas e salvas com sucesso');</script>";
                    print "<script language='javascript'>window.location='estudantes.php?pg=estudantes';</script>";
                } else {
                    print "<h2 class='p-1 bg-warning text-white rounded-2 fs-6 mt-3 w-50'>Ocorreu um erro ao tentar editar as informações do aluno(a)</h2>";
                }

            }

        } }?>

    <?php if($_GET['acao'] == 'ativa') {
        $sqlEdit = "UPDATE estudantes SET status='Ativo' WHERE id='{$_GET['id']}'";
        mysqli_query($connection, $sqlEdit);
        $sqlEdit = "UPDATE login SET status='Ativo' WHERE code='{$_GET['code']}'";
        mysqli_query($connection, $sqlEdit);
        print "<script language='javascript'>window.location='estudantes.php?pg=estudantes';</script>";
    } else if ($_GET['acao'] == 'inativa') {
        $sqlEdit = "UPDATE estudantes SET status='Inativo' WHERE id='{$_GET['id']}'";
        mysqli_query($connection, $sqlEdit);
        $sqlEdit = "UPDATE login SET status='Inativo' WHERE code='{$_GET['code']}'";
        mysqli_query($connection, $sqlEdit);
        print "<script language='javascript'>window.location='estudantes.php?pg=estudantes';</script>";
    }?>
</div>

<?php require_once 'footer_admin.php' ?>