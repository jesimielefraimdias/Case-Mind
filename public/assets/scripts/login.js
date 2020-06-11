

$(document).ready(() => {

//    $("#emailorcpf").mask("999.999.999-99");
    /*
    $("#emailorcpf").keyup((e) => {
        let txt = $(e.target).val();

        txt = txt.replace("-", "");
        txt = txt.replace(".", "");
        i++;
        console.log(txt+"  teste"+i);
        
        if (txt.lenght == 11) {
            $("#emailorcpf").mask("999.999.999-99");
        }
    });*/


    $("#entrar").on("click", event => {
        event.preventDefault();

        
        let form = $("form").serialize();
        let base_url = $("#base_url").val();

        $.ajax({
            type: "POST",
            url: base_url + "\\Login_controller\\login",
            data: form,
            dataType: "json",
            success: sucesso => {
                $("#erro_emailorcpf").html(sucesso.erro_emailorcpf);
                $("#erro_senha").html(sucesso.erro_senha);
                $("erro_login").html(sucesso.erro_login);
                //  $(location).attr("href",base_url+"\\Informacoes_usuarios_controller");    
            },
            error: erro => {
                console.log("Erro: " + JSON.stringify(erro));
            }
        });

    });
});