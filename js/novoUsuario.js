$(document).ready(function(){
    //CADASTRA NOVO USUÁRIO 
    var novo = $('#novoUsuario');
    var conteudo = $('.modal-body');
    
    novo.click(function(){
        $.post('ajax/painel.php', {acao: 'novo_usuario'}, function(retorno){
            $('#myModal').modal({backdrop: 'static'});
            conteudo.html(retorno);
        });
    });
    
    $("#myModal").on("submit", 'form[name="novo_usuario"]', function(){
        var form = $(this);
        var botao = form.find(':button');
        
        $.ajax({
            url: 'ajax/controller.php',
            type: 'POST',
            data: 'acao=cadastro&' + form.serialize(),
            beforeSend: function(){
                botao.attr('disabled', true);
                $('.load').fadeIn('slow');
            },
            success: function(retorno){
                botao.attr('disbled', false);
                $('.load').fadeOut('slow');
                    
                if (retorno === 'cadastrou') {
                    form.fadeOut('slow', function(){
                        msg('Usuário cadastrado com sucesso', 'sucesso');
                    });
                } else {
                    msg('Erro ao cadastrar usuário', 'erro');
                }
            }
        });
        return false;
    });
    
//    //FUNÇÃO VALIDA DADOS DO FORMULÁRIO DE CADASTRO DO USUÁRIO
//    function validaUsuario(){
//        if (document.novo_usuario.value === "") {
//            msg('Por favor, preencha todos os campos', 'alerta');
//        } else {
//        }
//    }
//    
//    //VALIDA SE AS SENHAS DIGITADAS SÃO IGUAIS
//    function validaSenha(){
//        senha = document.novo_usuario.senha.value;
//        confirmaSenha = document.novo_usuario.confirmasenha.value;
//        if (senha !== confirmaSenha){
//            msg('As senhas digitadas não sao iguais', 'alerta');
//            document.novo_usuario.confirmasenha.focus();
//            return false;
//        } else{
//            confirmaSenha.setCustomValidity('Senhas iguais!');
//        }
//    }
    
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