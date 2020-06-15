$(document).ready(() => {

    let base_url = $("#base_url").val();

    $.ajax({
        type: "GET",
        url: base_url + "\\Erro_controller\\permissao_admin",
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
                    $(location).attr("href", base_url + "\\Informacoes_usuarios_controller");
                });
            }
        }
    });


    $("#info").load(base_url + "\\assets\\documentacao.html");

    $("#documentacao").on("click", () => {
        $("#info").html("");
        $("#info").load(base_url + "\\assets\\documentacao.html");
    });

    $("#alterar_dados").on("click", () => {
        $.get(base_url + "\\Home_controller\\unset_usuario_comum", () => {
            $(location).attr("href", base_url + "\\Alterar_controller");
        });
    });

    $("#sair").on("click", () => {
        $.get(base_url + "\\Home_controller\\sair", () => {
            $(location).attr("href", base_url + "\\Login_controller");
        });
    });



    let meus_dados = sucesso => {

        let div1 = $("<div></div>");
        div1.addClass("row col-9");

        let div11 = $("<div></div>");
        div11.addClass("px-5 py-4 mt-5 col-6");
        let strong11 = $("<strong></strong>");
        strong11.text("Nome: ");
        let span11 = $("<span></span>");
        span11.text(sucesso.nome);
        div11.append(strong11, span11);

        let div12 = $("<div></div>");
        div12.addClass("px-5 py-4 mt-5 col-6");
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
    /*
        <div class="ml-2 mt-5 col-3 text-center">
           <img src='<?php echo "assets/img/perfil.jpg"; ?>' id="imagem_perfil_previa" name="imagem_perfil_previa" class="img-fluid .img-thumbnail">
        </div>
    
        <div class="row col-9">
           <div class="px-5 py-4 mt-5 col-6">
                <strong>Nome:</strong> <span>Jesimiel Efraim Dias</span>
            </div>
        
            <div class="px-5 py-4 mt-5 col-6">
               <strong>CPF:</strong> <span>458.293.698.93</span>
           </div>
               
            <div class="px-5 col-6">
               <strong>Grau acesso:</strong> <span>Admin</span>
               </div>
           <div class="px-5 col-6">
               <strong>Email:</strong> <span>jesimiel.dias@gmail.com</span>
           </div>
        </div>
    */

    $("#meus_dados").on("click", () => {

        $.ajax({
            type: "GET",
            url: base_url + "\\Home_controller\\imagem_usuario",
            contentType: "image/png",
            async: true,
            success: sucesso => {

                let div_img = $("<div></div>");
                div_img.addClass("ml-2 mt-5 col-3 text-center");

                let img = $("<img />");
                img.addClass("img-fluid .img-thumbnail");
                img.attr("id", "imagem_perfil_previa");
                img.attr("src", "data:image/png;base64," + sucesso);

                div_img.append(img);
                $("#info").html("");
                $("#info").append(div_img);
            },
            error: () => {
                $(location).attr("href", base_url + "\\Erro_controller");
            }
        });

        $.ajax({
            type: "GET",
            url: base_url + "\\Home_controller\\get_usuario",
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
                $(location).attr("href", base_url + "\\Erro_controller");
            }
        });

    });
});