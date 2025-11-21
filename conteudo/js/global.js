const password = document.getElementById("password");
const mostrar = document.getElementById("mostrar");
const icone = mostrar.querySelector("img");

mostrar.addEventListener("click", function() {
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    if (type === "password") {
        icone.src = "../media/mostrar.png";
        icone.alt = "Mostrar Senha";
    } else {
        icone.src = "../media/ocultar.png";
        icone.alt = "Ocultar Senha";
    }
});

document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("../php/login.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        const msgErro = document.getElementById("mensagem-erro");
        const msgSucesso = document.getElementById("mensagem-sucesso");

        msgErro.innerHTML = "";
        msgSucesso.innerHTML = "";

        if (data.includes("sucesso")) {
            msgSucesso.innerHTML = "<p class='sucesso'>✅ Login realizado com sucesso!</p>";
            setTimeout(() => {
                window.location.href = "../html/inicial.html";
            }, 1500);
        } else {
            msgErro.innerHTML = "<p class='erro'>❌ " + data + "</p>";
        }
    })
    .catch(error => {
        document.getElementById("mensagem-erro").innerHTML = "<p class='erro'>Erro na requisição: " + error + "</p>";
    });
});
