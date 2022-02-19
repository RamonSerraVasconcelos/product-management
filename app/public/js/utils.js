var modal = document.getElementById("myModal");

var btn = document.getElementById("myBtn");

var span = document.getElementsByClassName("close")[0];

function mensagem(mensagem) {
    modal.style.display = "block";
    document.getElementById('info_mensagem').innerHTML = mensagem
}

function closeModal() {
    document.getElementsByClassName("close")[0].click()
}

span.onclick = function () {
    modal.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function somenteNumeros(e) {
    var charCode = e.charCode ? e.charCode : e.keyCode;
    // charCode 8 = backspace   
    // charCode 9 = tab
    if (charCode != 8 && charCode != 9) {
        // charCode 48 equivale a 0   
        // charCode 57 equivale a 9
        if (charCode < 48 || charCode > 57) {
            return false;
        }
    }
}

$(document).ready(function () {
    $(".txtOnly").keypress(function (e) {
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            e.preventDefault();
        }
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_pic')
                .attr('src', e.target.result)
        };

        reader.readAsDataURL(input.files[0]);
    }
}
function validarImagem(field) {
    documento = $("#" + field.id).val();
    var upld = documento.split('.').pop();
    if (upld == 'jpg' || upld == 'jpeg' || upld == 'png') {
        const fileSize = field.files[0].size / 1024 / 1024; // in MiB
        if (fileSize > 5) {
            alert("O arquivo não deve ser maior que 5MB.")
            field.value = '';
        }

        ProfilePic.readURL(field)
    } else {
        alert("O documento deve estar nos formatos jpg, jpeg ou png.")
        field.value = '';
    }
}

function logout() {

    const data = {
        request: 'logout'
    }

    $.ajax({
        url: "app/controllers/UserController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        location.href = 'index.php'
    })
}