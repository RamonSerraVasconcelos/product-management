<?php
ob_start();
session_start();

if (!isset($_SESSION["userId"])) {
    echo "<script>location.href = 'index.php';</script>";
    return false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'head.php' ?>
    <link rel="stylesheet" href="public/css/home.css">
    <title>Home</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Teste Promovit</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Produtos <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./tags.php">Tags</a>
                    </li>
                </ul>
                <div class="form-inline my-2 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:logout()">Sair</a>
                    </li>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section id="section_products">
            <div class="d-flex justify-content-center mt-3" style="padding-bottom: 30px;border-bottom: 1px ridge #cecece;">
                <h1>Produtos</h1>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <input id="cardsfilter" type="text" class="form-control col-md-6 mt-3" id="product_name" placeholder="Filtrar Produtos">
            </div>
            <div class="d-flex justify-content-end mt-3 product-create">
                <button onclick="changeProductSection(true)" class='btn btn-success'>Novo Produto</button>
            </div>
            <div class="products" id="product_list">

            </div>
        </section>
        <section id="section_product" style="display: none;">
            <div class="container mt-3">
                <div class="form-group">
                    <input type="hidden" id="product_id" value='-1'>
                    <label>Nome</label>
                    <input type="text" class="form-control" id="product_name" placeholder="Nome do Produto">
                    <label>Preço</label>
                    <input type="text" class="form-control" id="product_price" placeholder="R$ 0,00" onkeypress="$(this).mask('R$ ###.##0,00', {reverse: true});">
                    <label>Tag</label>
                    <div class='d-flex'><select id="product_tags" class="form-control"></select><span onclick="addTag()" class='material-icons text-danger' style="cursor:pointer">add</span></div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th style="padding-right: 200px;">Nome</th>
                                <th>Exluir</th>
                            </thead>
                            <tbody id="product_tag_list"></tbody>
                        </table>
                    </div>
                    <label for="file-upload" class="custom-file-upload mt-3">
                        <i class="fa fa-cloud-upload"></i> Anexar Foto de Capa
                    </label>
                    <input id="file-upload" name="fileToUploadProductPicture" type="file" />
                </div>

                <button id="product_register" class="btn btn-primary w-100">Salvar Informações</button>
                <button id="product_delete" class="btn btn-danger w-100 mt-3" style="display:none">Excluir Produto</button>
                <button onclick="changeProductSection(false)" class="btn btn-primary w-100 mt-3">Voltar</button>
            </div>
        </section>
    </main>
</body>
<?php include 'utils.php' ?>
<script src='public/js/utils.js'></script>
<script src='public/js/products.js'></script>
<script>
    loadProducts()
    $('#cardsfilter').on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".myCards").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
</script>

</html>