function changeProductSection(change) {
    if (change) {
        $('#product_id').val(-1)
        $('#product_tags').val(-1)
        $('#product_tag_list').html("")
        $('#product_name').val("")
        $('#product_price').val("")
        $('#file-upload').val("")
        document.getElementById('section_product').style.display = ''
        document.getElementById('product_delete').style.display = 'none'
        document.getElementById('section_products').style.display = 'none'
        return
    }

    document.getElementById('section_product').style.display = 'none'
    document.getElementById('section_products').style = ''
}

$("#product_register").on("click", () => {

    const data = {
        request: 'create',
        id: $('#product_id').val(),
        name: $('#product_name').val(),
        price: $('#product_price').val()
    }

    if (data.name.trim() == '') {
        mensagem('Por favor informe o nome do produto.')
    }

    if (data.price.trim() == '') {
        mensagem('Por favor informe o preço do produto.')
    }

    $.ajax({
        url: "app/controllers/ProductController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if (result.success) {
            if (document.getElementById("file-upload").files.length != 0) {
                uploadProductImage(result.id)
            }
            mensagem('Produto atualizado com sucesso.')
            loadProducts()
            document.getElementById('section_product').style.display = 'none'
            document.getElementById('section_products').style = ''
            return true
        }

        mensagem('Aconteceu um erro inesperado, por favor tente novamente.')
    })
});

function uploadProductImage(id) {
    var formData = new FormData();
    formData.append('fileToUpload', document.getElementById('file-upload').files[0]);
    formData.append('request', 'uploadProductImage');
    formData.append('id', id);

    $.ajax({
        url: "app/controllers/ProductController.php",
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false
    }).done(function (result) {
        loadProducts()
    });
}

function loadProducts() {
    const data = {
        request: 'loadProducts'
    }

    $.ajax({
        url: "app/controllers/ProductController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if (result.success) {
            loadTags()
            $('#product_list').html(result.html)
            return true
        }
    })
}

function editProduct(product) {
    const data = {
        request: 'edit',
        id: product
    }

    $.ajax({
        url: "app/controllers/ProductController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if (result.success) {
            console.log(product)
            $('#product_id').val(product)
            $('#product_name').val(result.name)
            $('#product_price').val(result.price)
            loadProductTags()
            document.getElementById('section_product').style.display = ''
            document.getElementById('product_delete').style.display = ''
            document.getElementById('section_products').style.display = 'none'
            return true
        }

        mensagem('Erro ao carregar Produto.')
    })
}

$("#product_delete").on("click", () => {
    const data = {
        request: 'delete',
        id: $('#product_id').val()
    }

    $.ajax({
        url: "app/controllers/ProductController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if (result.success) {
            loadProducts()
            changeProductSection(false)
            return true
        }
    })
})

function loadTags() {
    const data = {
        request: 'loadTags',
    }

    $.ajax({
        url: "app/controllers/ProductController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if (result.success) {
            $('#product_tags').html(result.html)
            return true
        }
    })
}

function addTag() {
    const data = {
        request: 'addTag',
        product: $('#product_id').val(),
        tag: $('#product_tags').val()
    }

    if (data.tag == -1) {
        mensagem('Você deve selecionar a Tag antes de clicar no botão')
        return false
    }

    if (data.product == -1) {
        mensagem('Você deve cadastrar o produto antes de adicionar a Tag')
        return false
    }

    $.ajax({
        url: "app/controllers/ProductController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if (result.success) {
            loadProducts()
            loadProductTags()
            return true
        }
    })
}

function loadProductTags() {
    const data = {
        request: 'loadProductTags',
        id: $('#product_id').val()
    }

    $.ajax({
        url: "app/controllers/ProductController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if (result.success) {
            $('#product_tag_list').html(result.html)
            return true
        }

        $('#product_tag_list').html("")
    })
}

function deleteProductTag(tag) {
    const data = {
        request: 'deleteProductTag',
        product: $('#product_id').val(),
        tag: tag
    }

    $.ajax({
        url: "app/controllers/ProductController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function (result) {
        if (result.success) {
            loadProducts()
            loadProductTags()
            return true
        }
    })
}
