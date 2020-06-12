$(document).ready(() => {

    $("#cpf").mask("999.999.999-99");
    let base_url = $("#base_url").val();
    
    $.ajax({
        type: "GET",
        url: base_url + "\\Home_controller\\dados_usuario",
        dataType: "json",
        success: sucesso => {
              $("#nome").val(sucesso.nome);
              $("#cpf").val(sucesso.cpf);
              $("#email").val(sucesso.email);
              console.log(sucesso);

              if(sucesso.grau_acesso == "U") $("#usuario").html("Usuário: "+sucesso.nome);
              else if(sucesso.grau_acesso == "A") $("#usuario").html("Administrador: "+sucesso.nome);
              else if(sucesso.grau_acesso == "I") $("#usuario").html("Usuário inativo: "+sucesso.nome);
        },
        error: erro => {
            console.log(JSON.stringify(erro));
        }

    });


    $("#sair").on("click", event => {
        $.get(base_url + "\\Home_controller\\sair", () => {
            $(location).attr("href", base_url + "\\Login_controller");
        });
    
    });

    $("#alterar").on("click", event => {
        event.preventDefault();

        let form = $("form").serialize();

        console.log(form);

        $.ajax({
            type: "POST",
            url: base_url + "\\Home_controller\\alterar",
            data: form,
            dataType: "json",
            success: sucesso => {
                console.log(sucesso);
                $("#erro_nome").html(sucesso.erro_nome);
                $("#erro_cpf").html(sucesso.erro_cpf);
                $("#erro_email").html(sucesso.erro_email);
                $("#erro_senha").html(sucesso.erro_senha);
               

                if (sucesso.erro == "n") {
                    alert("Dados alterados com sucesso!");
                   $(location).attr("href", base_url + "\\Home_controller");
                   $("#nome").val(sucesso.nome);
                   $("#cpf").val(sucesso.cpf);
                   $("#email").val(sucesso.email);
     
                }
            },
            error: erro => {
                console.log(erro.responseText);
            }
        });

    });
});