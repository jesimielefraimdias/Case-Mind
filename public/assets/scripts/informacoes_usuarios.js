$(document).ready(() => {

//    let location.origin = $("#location.origin").val();

    atualizar_tabela = () => {
        $.ajax({
            type: "GET",
            url: location.origin + "\\Informacoes_usuarios_controller\\get_usuarios",
            dataType: "json",
            success: sucesso => {
                $("#tabela_tbody").html("");
                sucesso.forEach(listagem);
                alterarordesativar();
            },
            error: () => {
                $(location).attr("href", location.origin + "\\Erro_controller");
            }

        });
    }

    alterarordesativar = () => {
        $("button").on("click", event => {
            event.preventDefault();
            let id = event.currentTarget.attributes.id.value;
            id = id.split("_");

            if (id[0] == "desativarorativar") {
                $.get(location.origin + "\\Informacoes_usuarios_controller\\ativarordesativar", { id_usuario: id[1] },
                    () => {
                        atualizar_tabela();
                    }
                );

            } else if (id[0] == "alterar") {

                $.get(location.origin + "\\Alterar_controller\\setar_id", { id_usuario_comum: id[1] },
                    () => {
                        $(location).attr("href", location.origin + "\\Alterar_controller");
                    }
                );
            }
        });
    }

    listagem = (element) => {
        let tr = $("<tr></tr>");

        let usuario = Object.values(element);

        usuario.forEach((element_usuario, index) => {
            if (index != 0) {
                let text = element_usuario;

                if (index == 4) {
                    if (element_usuario == "A") text = "Administrador";
                    else if (element_usuario == "U") text = "Usuário";
                    else text = "Inativo";
                } else if (index == 2) {

                    cpf = text.slice(0, 3) + ".";
                    cpf += text.slice(3, 6) + ".";
                    cpf += text.slice(6, 9) + "-";
                    cpf += text.slice(9, 11);
                    text = cpf;
                }

                let td = $("<td></td>").text(text);
                $(tr).append(td);
            }
        });


        let td = $("<td></td>");

        let buttom_alterar = $("<button></button>");
        buttom_alterar.text("Alterar");
        buttom_alterar.addClass("mx-1 btn btn-warning");
        buttom_alterar.attr("id", "alterar_" + element.id_usuario);

        let text = "Inativar";
        let classe = "btn-danger";

        if (element.grau_acesso == "I") {
            text = "Ativar";
            classe = "btn-success";
        }
        let buttom_desativarorativar = $("<button></button>");
        buttom_desativarorativar.text(text);
        buttom_desativarorativar.addClass("mx-1 btn " + classe);
        buttom_desativarorativar.attr("id", "desativarorativar_" + element.id_usuario);


        td.append(buttom_alterar, buttom_desativarorativar);
        tr.append(td);
        $("#tabela_tbody").append(tr);
    }

    atualizar_tabela();

    $("#voltar").on("click", () => {
        $(location).attr("href", location.origin + "\\Home_controller");
    });

});