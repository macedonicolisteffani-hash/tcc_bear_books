document.getElementById("abrirCadastro").addEventListener("click", function(event) {

    event.preventDefault();

    document.querySelector(".login-usuario-container").classList.add("mostrar-cadastro");

});


document.getElementById("voltarLogin").addEventListener("click", function(event) {

    event.preventDefault();

    document.querySelector(".login-usuario-container").classList.remove("mostrar-cadastro");

});