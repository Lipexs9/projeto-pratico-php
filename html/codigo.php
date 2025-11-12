<!DOCTYPE html>
<html>
<link rel="stylesheet" href="../css/codigo.css">
<body>
    <div class="container">
        <form action="novasenha.php">
            <img src="../media/logo.png" alt="logo" width="100px">
            <h1>Recuperação de senha</h1>
            <p>Insira abaixo o código (<b>números</b>) recebido.</p>
            <div id="codigo">
                <input placeholder="Digite o código" type="text" pattern="\d*" minlength="6" maxlength="6" required>
            </div>
            <div id="botao">
                <button type="submit">Recuperar senha</button></a>
            </div>
        </form>
    </div>
</body>
</html>