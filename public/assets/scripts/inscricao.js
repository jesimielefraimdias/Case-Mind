
$(document).ready(() => {
    $("#inscrever_se").on("click", event => {
        event.preventDefault();

        let form = $("form").serialize();
        let base_url = $("#base_url").val();

        $.ajax({
            type: "POST",
            url: base_url + "\\Inscricao_controller\\cadastro",
            data: form,
            dataType: "json",
            success: sucesso => {
                
                $("#erro_nome").html(sucesso.erro_nome);
                $("#erro_email").html(sucesso.erro_email);
                $("#erro_senha").html(sucesso.erro_senha);

                if (sucesso.erro == "n") {
                    alert("Obrigado por se cadastrar!");
                    $(location).attr("href", base_url + "\\Login_controller");
                }
            },
            error: erro => {
                console.log(erro.responseText);
            }
        });

    });
});