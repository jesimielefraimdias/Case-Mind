
$(document).ready(() => {

    $("#cpf").mask("999.999.999-99");

    let base_url = $("#base_url").val();
    let change = false;

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

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#form_inscricao").submit(function (event) {
        event.preventDefault();

        let form = new FormData(this);

        if (!change) {
            form = $("#form_inscricao").serialize();
            console.log(form);

            $.ajax({
                type: "POST",
                url: base_url + "\\Inscricao_controller\\cadastro",
                data: form,
                dataType: "json",
                success: sucesso => {

                    console.log("Sucesso :" + JSON.stringify(sucesso));
                    console.log("Sucesso :" + sucesso);

                    $("#erro_nome").html(sucesso.erro_nome);
                    $("#erro_cpf").html(sucesso.erro_cpf);
                    $("#erro_email").html(sucesso.erro_email);
                    $("#erro_senha").html(sucesso.erro_senha);
                    $("#erro_imagem").html(sucesso.erro_imagem);


                    if (sucesso.erro == false) {
                        alert("Obrigado por se cadastrar!");
                        $(location).attr("href", base_url + "\\Login_controller");
                    } else if (sucesso.erro == false && sucesso.erro_upload == true) {
                        let $msg = "Obrigado por se cadastrar!<br>Não foi possível dar upload na imagem.<br>Acesse sua página para trocar!"
                        alert($msg);
                        $(location).attr("href", base_url + "\\Login_controller");
                    }
                },
                error: () => {
                    $(location).attr("href", base_url + "\\Erro_controller");
                }
            });

        } else {
            $.ajax({
                type: "POST",
                url: base_url + "\\Inscricao_controller\\cadastro",
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
                    $("#erro_inserir").html(sucesso.erro_inserir);

                    if (sucesso.erro == false) {
                        alert("Obrigado por se cadastrar!");
                        $(location).attr("href", base_url + "\\Login_controller");
                    } else if (sucesso.erro == false && sucesso.erro_upload == true) {
                        let $msg = "Obrigado por se cadastrar!<br>Não foi possível dar upload na imagem.<br>Acesse sua página para trocar!"
                        alert($msg);
                        $(location).attr("href", base_url + "\\Login_controller");
                    }
                },
                error: () => {
                    $(location).attr("href", base_url + "\\Erro_controller");
                }
            });
        }

    });
});