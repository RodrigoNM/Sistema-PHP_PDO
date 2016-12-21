$(document).ready(function(){
    $('form[name = "form_login"]').submit(function(){
        var forma = $(this);
        var botao = $(this).find(':button');

        $.ajax({
            url: "ajax/controller.php",
            type: "POST",
            data: "acao=login&" + forma.serialize(),
            beforeSend: function(){
                botao.attr('disabled', true);
                $('.load').fadeIn('slow');
            },
            success : function(retorno){
                $('.load').fadeOut('slow', function(){
                    botao.attr('disabled', false);
                });
                if (retorno === 'vazio') {
                    msg('Digite o login e senha!', 'alerta');
                } else if (retorno === 'naoexiste') {
                    msg('Usuário não encontrado', 'erro');
                } else if (retorno === 'senhadiferente') {
                    msg('Senha incorreta!', 'erro');
                } else {
                    forma.fadeOut('fast', function(){
                        msg('Logina efetuado com sucesso, aguarde!', 'sucesso');
                        $('#load').fadeIn('slow');
                    });
                    setTimeout(function(){
                       $(location).attr('href', 'listagem.php'); 
                    }, 3000);
                }
            }
        });
        return  false;
    });

    //FUNÇÕES GERAL
    function msg(msg, tipo) {
        var retorno = $('.retorno');
        var tipo = (tipo === 'sucesso') ? 'success' : (tipo === 'alerta') ? 'warning' :
                (tipo === 'erro') ? 'danger' : (tipo === 'info') ? 'info' :
                alert('INFORME MENSAGENS DE SUCESSO, ALERTA ERRO E INFO');
        retorno.empty().fadeOut('fast', function(){
            return $(this).html('<div class="alert alert-'+tipo+'">'+ msg+'</div>').fadeIn('slow');
        });

        setTimeout(function(){
            retorno.fadeOut('slow').empty();
        }, 5000);
    }
});