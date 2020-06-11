

$(document).ready(() => {

    $("#entrar").on("click", event => {
        event.preventDefault();

        
        let form = $("form").serialize();
        let base_url = $("#base_url").val();

        console.log(form);
        $.ajax({
            type: "POST",
            url: base_url + "\\Login_controller\\login",
            data: form,
            dataType: "json",
            success: sucesso => {
                $("#erro_emailorcpf").html(sucesso.erro_emailorcpf);
                $("#erro_senha").html(sucesso.erro_senha);
                $("erro_login").html(sucesso.erro_login);
                $(location).attr("href",base_url+"\\Home_controller");    
            },
            error: erro => {
               // $(location).attr("href", base_url + "\\Erro_controller");
                console.log("Erro: \n" + JSON.stringify(erro)+"\n");
            }
        });

    });
});