$(document).ready(() => {
    $.ajax({
        type: "GET",
        url: base_url + "\\Erro_controller\\permissao_usuario",
        dataType: "json",
        success: sucesso => {
            if(sucesso.acesso) $(location).attr("href", base_url + "\\Home_controller");
        },
        error: erro => {
            console.log(erro);
        }
    });
});