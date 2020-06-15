$(document).ready(() => {

    $("#cpf").mask("999.999.999-99");
    let change = false;

    $("#imagem_perfil_previa").on("click", () => {
        $("#imagem_perfil").trigger("click");
    });

    $("#imagem_perfil").change(function () {
        change = true;
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagem_perfil_previa').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $.ajax({
        type: "GET",
        url: location.origin + "\\Alterar_controller\\imagem_usuario",
        success: sucesso => {
            $("#imagem_perfil_previa").attr("src", "data:image/png;base64," + sucesso);
        },
        error: () => {
            $(location).attr("href", location.origin + "\\Erro_controller");
        }
    });

    $.ajax({
        type: "GET",
        url: location.origin + "\\Alterar_controller\\dados_usuario",
        dataType: "json",
        success: sucesso => {
            $("#nome").val(sucesso.nome);

            let cpf = sucesso.cpf.slice(0, 3) + ".";
            cpf += sucesso.cpf.slice(3, 6) + ".";
            cpf += sucesso.cpf.slice(6, 9) + "-";
            cpf += sucesso.cpf.slice(9, 11);

            $("#cpf").val(cpf);
            $("#email").val(sucesso.email);

            let primeiro_nome = sucesso.nome.split(" ");
            primeiro_nome = primeiro_nome[0];

            if (sucesso.grau_acesso == "U") $("#usuario").html("Usuário: " + primeiro_nome);
            else if (sucesso.grau_acesso == "A") $("#usuario").html("Administrador: " + primeiro_nome);
            else if (sucesso.grau_acesso == "I") $("#usuario").html("Usuário inativo: " + primeiro_nome);
        },
        error: () => {
            $(location).attr("href", location.origin + "\\Erro_controller");
        }

    });


    $("#voltar").on("click", () => {
        $.get(location.origin + "\\Alterar_controller\\voltar", () => {
            $(location).attr("href", location.origin + "\\Home_controller");
        });
    });

    $("#form_alterar").submit(function (event) {
        event.preventDefault();

        let form = new FormData(this);

        if (!change) {
            form = $("#form_alterar").serialize();
          
            $.ajax({
                type: "POST",
                url: location.origin + "\\Alterar_controller\\alterar",
                data: form,
                dataType: "json",
                success: sucesso => {

                    console.log("Sucesso=" + JSON.stringify(sucesso));
                    $("#erro_nome").html(sucesso.erro_nome);
                    $("#erro_cpf").html(sucesso.erro_cpf);
                    $("#erro_email").html(sucesso.erro_email);
                    $("#erro_senha").html(sucesso.erro_senha);
                    $("#erro_imagem").html(sucesso.erro_imagem);
                    $("#erro_alterar").html(sucesso.erro_alterar);

                    if (sucesso.erro == false) {
                        alert("Dados alterados!");
                        $(location).attr("href", location.origin + "\\Alterar_controller");
                    } else if (sucesso.erro == false && sucesso.erro_upload == true) {
                        let $msg = "Dados alterados, não foi possível dar upload na imagem.<br>Tente novamente mais tarde!"
                        alert($msg);
                        $(location).attr("href", location.origin + "\\Alterar_controller");
                    }
                },
                error: () => {
                    $(location).attr("href", location.origin + "\\Erro_controller");
                }
            });
        } else {

            $.ajax({
                type: "POST",
                url: location.origin + "\\Alterar_controller\\alterar",
                data: form,
                dataType: "json",
                processData: false,
                contentType: false,
                success: sucesso => {

                    console.log("Sucesso=" + JSON.stringify(sucesso));
                    $("#erro_nome").html(sucesso.erro_nome);
                    $("#erro_cpf").html(sucesso.erro_cpf);
                    $("#erro_email").html(sucesso.erro_email);
                    $("#erro_senha").html(sucesso.erro_senha);
                    $("#erro_imagem").html(sucesso.erro_imagem);
                    $("#erro_alterar").html(sucesso.erro_alterar);

                    if (sucesso.erro == false) {
                        alert("Dados alterados!");
                        $(location).attr("href", location.origin + "\\Alterar_controller");
                    }
                },
                error: () => {
                    $(location).attr("href", location.origin + "\\Erro_controller");
                }
            });
        }

    });
});