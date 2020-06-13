
$(document).ready(() => {

    $("#cpf").mask("999.999.999-99");

//  $("#inscrever_se").on("click", event => {
    $("#form_inscricao").submit( function(event){
        event.preventDefault();

        var formData = $(this).serialize();
        console.log(formData);
        formData = new FormData(this);

        let base_url = $("#base_url").val();

        console.log(formData);

        $.ajax({
            type: "POST",
            url: base_url + "\\Inscricao_controller\\cadastro",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,  
          success: sucesso => {
                console.log("Sucesso=" + JSON.stringify(sucesso));   /*
                $("#erro_nome").html(sucesso.erro_nome);
                $("#erro_cpf").html(sucesso.erro_cpf);
                $("#erro_email").html(sucesso.erro_email);
                $("#erro_senha").html(sucesso.erro_senha);

                if (sucesso.erro == "n") {
                    alert("Obrigado por se cadastrar!");
                    $(location).attr("href", base_url + "\\Login_controller");
                }*/
            },
            error: erro => {
                console.log(erro.responseText);
            }
        });

    });
});