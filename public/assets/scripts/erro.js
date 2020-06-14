$(document).ready(() => {

    let base_url = $("#base_url").val();

    $("#voltar").on("click", () => {
        $(location).attr("href", base_url+"\\Login_controller");
    });
});