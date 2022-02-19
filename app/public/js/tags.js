$("#tag_register").on("click", () => {

    const data = {
        request: 'create',
        id: $('#tag_id').val(),
        name: $('#tag_name').val(),
    }

    if (data.name.trim() == '') {
        mensagem('Por favor informe o nome da tag.')
    }

    $.ajax({
        url: "app/controllers/TagController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if (result.success) {
            mensagem('Tag atualizada com sucesso.')
            loadTags()
            return true
        }

        mensagem('Aconteceu um erro inesperado, por favor tente novamente.')
    })
});

function loadTags() {

    const data = {
        request: 'loadTags'
    }

    $.ajax({
        url: "app/controllers/TagController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if (result.success) {
            $('#tag_id').val(-1)
            $('#tag_name').val("")
            $('#tag_list').html(result.html)
            return true
        }
    })
}

function editTag(tag) {
    const data = {
        request: 'edit',
        id: tag
    }

    $.ajax({
        url: "app/controllers/TagController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if (result.success) {
            $('#tag_id').val(tag)
            $('#tag_name').val(result.name)
            return true
        }

        mensagem('Erro ao carregar Tag.')
    })
}

function deleteTag(tag) {
    const data = {
        request: 'delete',
        id: tag
    }

    $.ajax({
        url: "app/controllers/TagController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if (result.success) {
            mensagem('Sucesso ao deletar Tag.')
            loadTags()
            return true
        }

        mensagem('Erro ao deletar Tag.')
    })
}

function LoadTagProducts(id) {
    const data = {
        request: 'LoadTagProducts',
        id: id
    }

    $.ajax({
        url: "app/controllers/TagController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if (result.success) {
            mensagem(result.html)
            return true
        }

        mensagem('Erro ao carregar Produtos.')
    })
}