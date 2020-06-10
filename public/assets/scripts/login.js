

$(document).ready(() => {
    $("#entrar").on("click", event => {
        event.preventDefault();
        
        let email = $("#email").val();
        let senha = $("#senha").val();
        let base_url = $("#base_url").val();
       
        $.ajax({
            type: "POST",
            url: base_url+"\\Login_controller\\login",
            data:{
                "email":email,
                "senha":senha
            },
            dataType: "json",
            success: sucesso => {
                $("#erro_email").html(sucesso.erro_email);
                $("#erro_senha").html(sucesso.erro_senha);

              //  $(location).attr("href",base_url+"\\Informacoes_usuarios_controller");    
            },
            error: erro => {
                console.log("Erro: "+JSON.stringify(erro));
            }
        });
    
    });
});