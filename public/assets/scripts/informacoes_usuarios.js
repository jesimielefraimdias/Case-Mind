

$(document).ready(() => {

    
    let base_url = $("#base_url").val();


    $.ajax({
        type: "GET",
        url: base_url + "\\Informacoes_usuarios_controller\\get_usuarios",
        data: "competencia=" + "teste",
        dataType: "json",
        success: sucesso => {

            sucesso.forEach(listagem);
            alterarordesativar();
        },
        error: erro => { console.log("Msg de erro:", erro); }
    });

    $("#alterar_meus_dados").on("click", event => {
        event.preventDefault();
        $(location).attr("href", base_url + "\\Home_controller");
    });

    alterarordesativar = () => {
        $("button").on("click",event => {
            event.preventDefault();
            let id = event.currentTarget.attributes.id.value;
            id = id.split("_");
            
            if(id[0] == "desativarorativar"){
                $.ajax({
                    type: "GET",
                    url: base_url + "\\Informacoes_usuarios_controller\\ativarordesativar",
                    data: "id_usuario="+id[1],
                    dataType: "json",
                    success: sucesso => {
                        console.log(sucesso);
                    },
                    error: erro => {
                        console.log("Msg de erro:", erro); 
                    }
                });
            }
            console.log(id);
        });
    }

    listagem = (element) => {
        let tr = $("<tr></tr>");
        
        let usuario = Object.values(element);

        usuario.forEach((element_usuario, index) => {
            let text = element_usuario;
           
            if(index == 4){
                if(element_usuario == "A") text = "Administrador";
                else if(element_usuario == "U") text = "Usuário";
                else text = "Inativo";
            }

            let td = $("<td></td>").text(text);
            $(tr).append(td);
        });

        
        let td = $("<td></td>");

        let buttom_alterar = $("<button></button>");
        buttom_alterar.text("Alterar");
        buttom_alterar.addClass("mx-1 btn btn-warning");
        buttom_alterar.attr("id", "alterar_"+element.id_usuario);

        let text = "Inativar";
        let classe = "btn-danger";

        if(element.grau_acesso == "I"){
            text = "Ativar";
            classe = "btn-success";
        } 
        let buttom_desativarorativar = $("<button></button>");
        buttom_desativarorativar.text(text);
        buttom_desativarorativar.addClass("mx-1 btn "+classe);
        buttom_desativarorativar.attr("id", "desativarorativar_"+element.id_usuario);

        
        td.append(buttom_alterar, buttom_desativarorativar);
        tr.append(td);
        $("#tabela_tbody").append(tr);
//       console.log(Object.values(element));
    }
});