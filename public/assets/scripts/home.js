$(document).ready(() => {

    $("#cpf").mask("999.999.999-99");

    let base_url = $("#base_url").val();
    let change = false;

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagem_perfil_previa').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#imagem_perfil").change(function () {
        change = true;
        readURL(this);
    });


    $.ajax({
        type: "GET",
        url: base_url + "\\Home_controller\\dados_usuario",
        dataType: "json",
        success: sucesso => {
            $("#nome").val(sucesso.nome);
            $("#cpf").val(sucesso.cpf);
            $("#email").val(sucesso.email);
            console.log(sucesso);

            if (sucesso.grau_acesso == "U") $("#usuario").html("Usuário: " + sucesso.nome);
            else if (sucesso.grau_acesso == "A") $("#usuario").html("Administrador: " + sucesso.nome);
            else if (sucesso.grau_acesso == "I") $("#usuario").html("Usuário inativo: " + sucesso.nome);
        },
        error: erro => {
            console.log(erro);
        }

    });


    $("#sair").on("click", () => {
        $.get(base_url + "\\Home_controller\\sair", () => {
            $(location).attr("href", base_url + "\\Login_controller");
        });
    });

    $("#form_alterar").submit(function (event) {
        event.preventDefault();

        let form = new FormData(this);

        if (!change) {
            form = $("#form_alterar").serialize();
            console.log("Teste "+form);

            $.ajax({
                type: "POST",
                url: base_url + "\\Home_controller\\alterar",
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
                        $(location).attr("href", base_url + "\\Home_controller");
                    } else if (sucesso.erro == false && sucesso.erro_upload == true) {
                        let $msg = "Dados alterados, não foi possível dar upload na imagem.<br>Acesse sua página para trocar!"
                        alert($msg);
                        $(location).attr("href", base_url + "\\Home_controller");
                    }
                },
                error: erro => {
                    console.log(erro);
                    $("#erro_upload").html("Ocorreu um erro! Verifique se você fez upload da imagem.")
                }
            });
        } else {

            console.log(form);
            $.ajax({
                type: "POST",
                url: base_url + "\\Home_controller\\alterar",
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
                        $(location).attr("href", base_url + "\\Home_controller");
                    }
                },
                error: erro => {
                    console.log(erro);
                }
            });
        }

    });
});