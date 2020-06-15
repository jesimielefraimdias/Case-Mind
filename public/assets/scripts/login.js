$(document).ready(() => {

    $.ajax({
        type: "GET",
        url: location.origin + "\\Erro_controller\\permissao_usuario",
        dataType: "json",
        success: sucesso => {
            if (sucesso.acesso) $(location).attr("href", location.origin + "\\Home_controller");
        },
        error: () => {
            $(location).attr("href", location.origin + "\\Erro_controller");
        }
    });

    $("#inscrever_se").on("click", () => {

        console.log(location);
        $(location).attr("href", location.origin + "\\Inscricao_controller");
    });

    $("#entrar").on("click", event => {
        event.preventDefault();
        let form = $("form").serialize();

        $.ajax({
            type: "POST",
            url: location.origin + "\\Login_controller\\login",
            data: form,
            dataType: "json",
            success: sucesso => {
                if (sucesso.erro.erro == true) {
                    $("#erro_emailorcpf").html(sucesso.erro.erro_emailorcpf);
                    $("#erro_senha").html(sucesso.erro.erro_senha);
                    $("#erro_login").html(sucesso.erro.erro_login);
                }
                if (sucesso.erro.erro == false) {
                    if (sucesso.data.grau_acesso != "I") $(location).attr("href", location.origin + "\\Home_controller");
                }
            },

            error: () => {
                $(location).attr("href", location.origin + "\\Erro_controller");
            }
        });

    });
});