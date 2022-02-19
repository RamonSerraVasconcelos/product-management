$("#btn_login").on("click", () => {

    const data = {
        request: 'login',
        email: $('#login_email').val(),
        password: $('#login_password').val()
    }

    if(data.email.trim() == '' || data.password.trim() == '') {
        mensagem('Todos os campos são necessários')
    }

    $.ajax({
        url: "app/controllers/UserController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if(result.success) {
            window.location.href = 'home.php'
            return true
        }

        mensagem('Email ou Senha Incorretos')
    })
});

$('#btn_register').on("click", () => {
    const data = {
        request: 'register',
        name: $('#register_name').val(),
        email: $('#register_email').val(),
        password: $('#register_password').val(),
        confirm_password: $('#register_confirm_password').val()
    }

    if(data.name.trim() == '' || data.email.trim() == '' || data.password.trim() == '' || data.confirm_password.trim() == '') {
        mensagem('Todos os campos são necessários')
    }

    if(data.password != data.confirm_password) {
        mensagem('As 2 senhas estão diferentes')
    }

    $.ajax({
        url: "app/controllers/UserController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if(result.success) {
            window.location.href = 'home.php'
            return true
        }

        mensagem(result.error)
    })
})

function sectionLogin(abrir) {
    if(abrir) {
        document.getElementById('section_login').style.display = ''
        document.getElementById('section_register').style.display = 'none'
        return
    }

    document.getElementById('section_login').style.display = 'none'
    document.getElementById('section_register').style = ''
}