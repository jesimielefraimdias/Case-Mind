

$(document).ready(() => {

    
    let base_url = $("#base_url").val();
    
    $.ajax({
        type: "GET",
        url: base_url + "\\Erro_controller\\permissao_usuario",
        dataType: "json",
        success: sucesso => {
            if(sucesso.acesso) $(location).attr("href", base_url + "\\Home_controller");
        },
        error: () => {
            $(location).attr("href", base_url + "\\Erro_controller");
        }
    });

    $("#entrar").on("click", event => {
        event.preventDefault();
        let form = $("form").serialize();

        $.ajax({
            type: "POST",
            url: base_url + "\\Login_controller\\login",
            data: form,
            dataType: "json",
            success: sucesso => {
                if (sucesso.erro.erro == true) {
                    $("#erro_emailorcpf").html(sucesso.erro.erro_emailorcpf);
                    $("#erro_senha").html(sucesso.erro.erro_senha);
                    $("#erro_login").html(sucesso.erro.erro_login);
                }
                if (sucesso.erro.erro == false) {
                    if (sucesso.data.grau_acesso != "I") $(location).attr("href", base_url + "\\Home_controller");
                }
            },

            error: () => {
                $(location).attr("href", base_url + "\\Erro_controller");
            }
        });

    });
});