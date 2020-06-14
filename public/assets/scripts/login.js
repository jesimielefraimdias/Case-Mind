

$(document).ready(() => {

    
    let base_url = $("#base_url").val();
    
    $.ajax({
        type: "GET",
        url: base_url + "\\Erro_controller\\permissao_usuario",
        dataType: "json",
        success: sucesso => {
            if(sucesso.acesso) $(location).attr("href", base_url + "\\Alterar_controller");
        },
        error: erro => {
            console.log(erro);
        }
    });

    $("#entrar").on("click", event => {
        event.preventDefault();


        let form = $("form").serialize();

        console.log(form);
        $.ajax({
            type: "POST",
            url: base_url + "\\Login_controller\\login",
            data: form,
            dataType: "json",
            success: sucesso => {
                console.log(sucesso);
                if (sucesso.erro.erro == true) {
                    $("#erro_emailorcpf").html(sucesso.erro.erro_emailorcpf);
                    $("#erro_senha").html(sucesso.erro.erro_senha);
                    $("#erro_login").html(sucesso.erro.erro_login);
                }
                if (sucesso.erro.erro == false) {
                    if (sucesso.data.grau_acesso == "U") $(location).attr("href", base_url + "\\Alterar_controller");
                    else if (sucesso.data.grau_acesso == "A") $(location).attr("href", base_url + "\\Informacoes_usuarios_controller");
                }
            },

            error: erro => {
                // $(location).attr("href", base_url + "\\Erro_controller");
                console.log(JSON.stringify(erro));
            }
        });

    });
});