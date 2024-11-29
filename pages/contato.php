<?php
include "../includes/cabecalho.php";
include "../includes/navbar.php";
?>

<body class="contato_b">
    <main class="contato_main">
        <div class="contato_container">
            <div class="contatos_textos">
                <h1>FALE CONOSCO</h1><br>
                <h3>Você pode utilizar o formulário ao lado para nos enviar sua sugestão ou para fazer uma reclamação.</h3>
                <h3>Se preferir pode entrar em contato por outros meios</h3><br><br>
                <strong>
                    <p><i class="fa-brands fa-whatsapp"></i> (11) 1234-5678</p>
                </strong><br>
                <strong>
                    <p><i class="fa-solid fa-phone"></i> (11) 1234-5678</p>
                </strong>
                <input type="button" value="Enviar Mensagem" onclick="ResetForm()" class="input_reset">
            </div>
            <form action="enviar_mensagem.php" method="POST">
                <div class="contatos_inputs">
                    <input type="text" name="nome" id="nome" placeholder="Nome" required><br><br>
                    <input type="email" name="email" id="email" placeholder="Email*" required><br><br>
                    <input type="text" name="telefone" id="telefone" placeholder="Telefone*" required><br><br>
                    <textarea name="msg_contato" id="msg_contato" cols="30" rows="10" placeholder="Escreva sua mensagem*" required></textarea><br><br>
                    <input type="submit" value="Enviar Mensagem" class="input_reset">
                </div>
            </form>

        </div>
    </main>
</body>


<?php
include "../includes/rodape.php";
?>