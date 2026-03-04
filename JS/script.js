// Aqui estamos esperando o site carregar completamente antes de rodar o código
document.addEventListener("DOMContentLoaded", function () {

    // ==============================
    // PARTE DO LOGIN
    // ==============================

    // Aqui estamos pegando o formulário de login pelo ID
    const formLogin = document.getElementById("formLogin");

    // Se o formulário existir na página
    if (formLogin) {

        // Quando a pessoa clicar em enviar
        formLogin.addEventListener("submit", function (event) {

            event.preventDefault();
            // Impede a página de recarregar automaticamente

            const email = document.getElementById("email").value;

            // Pega o valor digitado no campo email

            const senha = document.getElementById("senha").value;
            // Pega o valor digitado no campo senha

            const mensagemErro = document.getElementById("mensagemErro");
            // Pega o local onde vamos mostrar erro

            if (email === "" || senha === "") {
                mensagemErro.textContent = "Preencha todos os campos!";
                // Mostra erro se estiver vazio
            } else {
                mensagemErro.textContent = "Login enviado! (Depois vamos ligar no PHP)";
                // Mensagem temporária até ligar no banco
            }

        });
    }

    // ==============================
    // PARTE DA RESERVA
    // ==============================

    const formReserva = document.getElementById("formReserva");
    // Pega o formulário de reserva

    if (formReserva) {

        formReserva.addEventListener("submit", function (event) {

            event.preventDefault();
            // Impede recarregar a página

            const horaInicio = document.getElementById("horaInicio").value;
            // Pega hora início

            const horaFim = document.getElementById("horaFim").value;
            // Pega hora fim

            const mensagemReserva = document.getElementById("mensagemReserva");
            // Pega local da mensagem

            if (horaInicio >= horaFim) {
                mensagemReserva.textContent = "A hora final deve ser maior que a hora inicial!";
                mensagemReserva.className = "mensagem-erro";
            } else {
                mensagemReserva.textContent = "Reserva realizada com sucesso!";
                mensagemReserva.className = "mensagem-sucesso";
                formReserva.reset();
            }

        });
    }

    // ==============================
    // PARTE DO CADASTRO
    // ==============================

    const formCadastro = document.getElementById("formCadastro");
    // Pega o formulário de cadastro

    if (formCadastro) {

        formCadastro.addEventListener("submit", function (event) {

            event.preventDefault();
            // Impede a página de recarregar

            const senha = document.getElementById("senhaCadastro").value;
            // Pega senha digitada

            const confirmarSenha = document.getElementById("confirmarSenha").value;
            // Pega confirmação da senha

            const mensagemCadastro = document.getElementById("mensagemCadastro");
            // Pega o local onde vamos mostrar mensagens

            if (senha !== confirmarSenha) {
                mensagemCadastro.textContent = "As senhas não coincidem!";
                // Mostra erro se as senhas forem diferentes

            } else {
                mensagemCadastro.textContent = "Cadastro enviado! (Depois vamos ligar no PHP)";
                // Mensagem temporária até conectar com banco
            }

        });

    }
});