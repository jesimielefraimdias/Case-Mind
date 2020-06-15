$(document).ready(() => {
    $("#voltar").on("click", () => {
        console.log("teste"+location.origin);
        $(location).attr("href", location.origin+"\\Login_controller");
    });
});