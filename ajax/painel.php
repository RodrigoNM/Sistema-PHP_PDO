<?php
require_once '../funcoes/banco/conexao.php';
require_once '../funcoes/crud/crud.php';
$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'form_cad':
        ?>
        <div class="retorno"></div>
        <form action="" name="form_cad" method="post">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome">
            </div>
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" class="form-control" id="login" placeholder="Login">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha">
            </div>
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" name="tipo" class="form-control" id="tipo" placeholder="Tipo">
            </div>
            <div class="checkbox">
                <p class="pull-right">
                    <img src="../img/load.gif" class="load" alt="Carregando" style="display: none"/>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </p>
            </div>
        </form>
        <?php
        break;

    case 'listar_usuario':
        if (listarUsuario()) {
            $usuario = listarUsuario();
            foreach ($usuario as $user) {
                ?>
                <tr>
                    <td><?php echo $user->nome; ?></td>
                    <td><?php echo $user->sexo; ?></td>
                    <td><?php date_default_timezone_set('America/Sao_Paulo');
                            $data = $user->dtnasc;
                            echo date('d/m/Y', strtotime($data)); ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->login; ?></td>
                    <td>
                        <a href="#" id="btn_edit" data-id="<?php echo $user->id; ?>" class="btn btn-warning">Editar</a>
                        <a href="#" id="btn_excluir" data-id="<?php echo $user->id; ?>"class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
                <?php
            }
        }
        break;

    case 'form_edit':

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $dados = pegaId($id);
        ?>

        <div class="retorno"></div>
        <form action="" name="form_cad" method="post">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" value="<?php echo $dados->nome; ?>" class="form-control" id="nome" placeholder="Nome">
            </div>
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" value="<?php echo $dados->login; ?>" class="form-control" id="login" placeholder="Login">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" value="<?php echo $dados->senha; ?>" class="form-control" id="senha" placeholder="Senha">
            </div>
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" name="tipo" value="<?php echo $dados->tipo; ?>" class="form-control" id="tipo" placeholder="Tipo">
            </div>
            <input type="hidden" name="id" value="<?php echo $dados->id; ?>" />

            <div class="checkbox">
                <p class="pull-right">
                    <img src="img/load.gif" class="load" alt="Carregando" style="display: none"/>
                    <button type="submit" class="btn btn-default">Atualizar</button>
                </p>
            </div>
        </form>

        <?php
        break;

    case 'novo_usuario' :
        ?>
        <div class="retorno"></div>
        <form action="" name="novo_usuario" method="post">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" required>
            </div>
            <div class="form-group">
            <label>Sexo</label><br>
            <label class="radio-inline">
                <input type="radio" name="sexo" id="masculino" value="Masculino"> Masculino
            </label>
            <label class="radio-inline">
                <input type="radio" name="sexo" id="feminino" value="Feminino"> Feminino
            </label>
            </div>
            <div class="form-group">
                <label for="dtnasc">Data de Nascimento</label>
                <input type="date" name="dtnasc" class="form-control" id="dtnasc" maxlength="10" placeholder="dd/mm/aaaa">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" class="form-control" id="login" placeholder="Login" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha" required="true">
            </div>
            <div class="form-group">
                <label for="confirmasenha">Confirmar senha</label>
                <input type="password" name="confirmasenha" class="form-control" id="confirmarsenha" placeholder="Digite a senha novamente" required="true">
            </div>
            <div class="checkbox">
                <p class="pull-right">
                    <img src="../img/load.gif" class="load" alt="Carregando" style="display: none"/>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </p>
            </div>
        </form>
        <?php
        break;
    default:
        echo 'NADA!';
        break;
}