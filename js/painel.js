$(document).ready(function(){
    //CADASTRA NOVO ITEM
    var janela = $('#janela');
    var conteudo = $('.modal-body');

    janela.click(function(){
        $.post('ajax/painel.php', {acao: 'form_cad'}, function(retorno){
            $('#myModal').modal({backdrop: 'static'});
            conteudo.html(retorno);
        });
    });

    $("#myModal").on("submit", 'form[name="form_cad"]', function(){
        var form = $(this);
        var botao = form.find(':button');

        $.ajax({
            url: 'ajax/controller.php',
            type: 'POST',
            data: 'acao=cadastro&' + form.serialize(),
            beforeSend: function(){
                botao.attr('disbled', true);
                $('.load').fadeIn('slow');
            },
            success: function(retorno){
                botao.attr('disbled', false);
                $('.load').fadeOut('slow');

                if (retorno === 'cadastrou'){
                    form.fadeOut('slow', function(){
                        msg('Usuário cadastrado com sucesso', 'sucesso');
                        listarTudo('ajax/painel.php', 'listar_usuario', true);
                    });
                } else {
                    msg('Erro ao cadastrar usuário', 'erro');
                }
            }
        });
        return false;
    });

    //BTN EDIT
    $('.table').on("click", '#btn_edit', function(){
        var id = $(this).attr('data-id');
        $.post('ajax/painel.php', {acao: 'form_edit', id: id}, function(retorno){
            $('#myModal').modal({backdrop: 'static'});
            conteudo.html(retorno);
        });
        return false;
    });

    //BTN ATUALIZAR
    $('#myModal').on("submit", 'form[name="form_edit"]', function(){
        var dados = $(this);
        var botao = dados.find(':button');

        $.ajax({
            url: 'ajax/controller.php',
            type: 'POST',
            data: 'acao = edit&' + dados.serialize(),
            beforSend: function () {
                botao.attr('disbled', true);
                $('.load').fadeIn('slow');
            },
            success: function(retorno){
                if (retorno === 'atualizou') {
                    dados.fadeOut('slow', function(){
                        msg('Usuário atualizado com sucesso', 'sucesso');
                        listarTudo('ajax/painel.php', 'listar_usuario', true);
                    });
                } else {
                    msg('Nenhum campo foi alterado', 'alerta');
                    $('.load').fadeOut('slow', function(){
                        botao.attr('disabled', false);
                    });
                }
            }
        });
        return false;
    });

    //BTN EXCLUIR
    $('.table').on('click', '#btn_excluir', function(){
        var id = $(this).attr('data-id');

        if (confirm('Deseja realmente excluir este usuário?')) {
            $.post('ajax/controller.php', {acao: 'excluir', id: id}, function(retorno){

                if (retorno === 'excluiu') {
                    alert('Usuário excluido com sucesso!');
                    listarTudo('ajax/painel.php', 'listar_usuario', true);
                } else {
                    alert('Erro ao excluir!');
                }
            });
        } else {
            return false;
        }
    });

    //FUNÇÃO GERAL
    function listarTudo(url, acao, atualiza){
        $.post(url, {acao: acao}, function(retorno){
            var tbody = $('.table').find('tbody');
            var load = tbody.find('.load');

            if (atualiza === true) {
                tbody.html(retorno);
            } else {
                load.fadeOut('slow', function(){
                    tbody.html(retorno);
                });
            }
        });
    }

//REALIZA LISTAGEM VIA JQUERY
    listarTudo('ajax/painel.php', 'listar_usuario');

    //FUNÇÕES DE MSG
    function msg(msg, tipo){
        var retorno = $('.retorno');
        var tipo = (tipo === 'sucesso') ? 'success' : (tipo === 'alerta') ? 'warning' :
                (tipo === 'erro') ? 'danger' : (tipo === 'info') ? 'info' :
                alert('INFORME MENSAGENS DE SUCESSO, ALERTA ERRO E INFO');
        retorno.empty().fadeOut('fast', function(){
            return $(this).html('<div class="alert alert-' + tipo + '">' + msg + '</div>').fadeIn('slow');
        });

        setTimeout(function(){
            retorno.fadeOut('slow').empty();
        }, 5000);
    }
});