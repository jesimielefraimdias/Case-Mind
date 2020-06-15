$(document).ready(() => {

    $.ajax({
        type: "GET",
        url: location.origin + "\\Erro_controller\\permissao_admin",
        dataType: "json",
        success: sucesso => {

            if (sucesso.acesso == true) {
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
                    $(location).attr("href", location.origin + "\\Informacoes_usuarios_controller");
                });
            }
        }
    });


    $("#info").load(location.origin + "\\assets\\documentacao.txt");

    $("#documentacao").on("click", () => {
        $("#info").html("");
        $("#info").load(location.origin + "\\assets\\documentacao.txt");
    });

    $("#alterar_dados").on("click", () => {
        $.get(location.origin + "\\Home_controller\\unset_usuario_comum", () => {
            $(location).attr("href", location.origin + "\\Alterar_controller");
        });
    });

    $("#sair").on("click", () => {
        $.get(location.origin + "\\Home_controller\\sair", () => {
            $(location).attr("href", location.origin + "\\Login_controller");
        });
    });



    let meus_dados = sucesso => {

        let div1 = $("<div></div>");
        div1.addClass("row col-9 meus_dados");

        
        let div11 = $("<div></div>");
        div11.addClass("col-6 align-self-center px-5 py-4 mt-5");
        
        let strong11 = $("<strong></strong>");
        strong11.text("Nome: ");
        let span11 = $("<span></span>");
        span11.text(sucesso.nome);
        div11.append(strong11, span11);

        let div12 = $("<div></div>");
        div12.addClass("col-6 align-self-center px-5 py-4 pb-2 mt-5");
        let strong12 = $("<strong></strong>");
        strong12.text("CPF: ");
        let span12 = $("<span></span>");
        span12.text(sucesso.cpf);
        div12.append(strong12, span12);

        let div13 = $("<div></div>");
        div13.addClass("px-5 col-6");
        let strong13 = $("<strong></strong>");
        strong13.text("Grau acesso: ");
        let span13 = $("<span></span>");
        span13.text(sucesso.grau_acesso);
        div13.append(strong13, span13);

        let div14 = $("<div></div>");
        div14.addClass("px-5 col-6");
        let strong14 = $("<strong></strong>");
        strong14.text("Email: ");
        let span14 = $("<span></span>");
        span14.text(sucesso.email);
        div14.append(strong14, span14);


        div1.append(div11, div12, div13, div14);
        $("#info").append(div1);
    }

    $("#meus_dados").on("click", () => {

        $.ajax({
            type: "GET",
            url: location.origin + "\\Home_controller\\imagem_usuario",
            success: sucesso => {

                let div_img = $("<div></div>");
                div_img.addClass("ml-2 mt-5 col-3 text-center");

                let img = $("<img />");
                img.addClass(".imagem_perfil_previa img-fluid .img-thumbnail");
                img.attr("src", "data:image/png;base64," + sucesso);
                div_img.append(img);
                $("#info").html("");
                $("#info").append(div_img);
            },
            error: () => {
                $(location).attr("href", location.origin + "\\Erro_controller");
            }
        });

        $.ajax({
            type: "GET",
            url: location.origin + "\\Home_controller\\get_usuario",
            dataType: "json",
            success: sucesso => {
                if (sucesso.grau_acesso == "U") sucesso.grau_acesso = "Usuário";
                else sucesso.grau_acesso = "Administrador";

                let cpf;
                cpf = sucesso.cpf.slice(0, 3) + ".";
                cpf += sucesso.cpf.slice(3, 6) + ".";
                cpf += sucesso.cpf.slice(6, 9) + "-";
                cpf += sucesso.cpf.slice(9, 11);
                sucesso.cpf = cpf;

                meus_dados(sucesso);

            },
            error: () => {
                $(location).attr("href", location.origin + "\\Erro_controller");
            }
        });

    });
});