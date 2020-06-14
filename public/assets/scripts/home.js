$(document).ready(() => {

    let base_url = $("#base_url").val();

    $.ajax({
        type: "GET",
        url: base_url + "\\Erro_controller\\permissao_admin",
        dataType: "json",
        success: sucesso => {

            if(sucesso.acesso == true){
                let li = $("<li></li>");
                li.addClass("nav-item");

                let a = $("<a></a>");
                a.addClass("nav-link");
                a.attr("id", "listar_usuarios");
                a.attr("href", "#");
                a.text("Listar usuários");

                li.append(a);
                $("#home_nav ul").append(li);

                $("#listar_usuarios").on("click", () => {
                    $(location).attr("href", base_url + "\\Informacoes_usuarios_controller");
                });
            }
        }
    });

    
    $("#info").load(base_url + "\\assets\\documentacao.html");

    $("#alterar_dados").on("click", () => {
        $(location).attr("href", base_url + "\\Alterar_controller");
    });

    $("#sair").on("click", () => {
        $.get(base_url + "\\Home_controller\\sair", () => {
            $(location).attr("href", base_url + "\\Login_controller");
        });
    });
});