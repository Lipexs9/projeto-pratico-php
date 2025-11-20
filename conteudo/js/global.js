const password = document.getElementById("password");
const mostrar = document.getElementById("mostrar");
const icone = mostrar.querySelector("img");

    mostrar.addEventListener("click", function(){
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    if (type === "password"){
        icone.src = "../media/mostrar.png";
        icone.alt = "Mostrar Senha";
    } else{
        icone.src = "../media/ocultar.png";
        icone.alt = "Ocultar Senha";
    }
});