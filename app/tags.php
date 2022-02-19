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
                    <li class="nav-item">
                        <a class="nav-link" href="./home.php">Produtos</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Tags <span class="sr-only">(current)</span></a>
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
        <div class="container mt-3">
            <div class="d-flex justify-content-center mt-3" style="padding-bottom: 30px;">
                <h1>Tags</h1>
            </div>
            <div class="d-flex justify-content-between">
                <input type="hidden" id="tag_id" value='-1'>
                <input type="text" class="form-control" id="tag_name" placeholder="Nome da Tag" style="width:50%">
                <button id="tag_register" class='btn btn-success text-end' style="margin-bottom:30px">Adicionar Tag</button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td style="padding-right: 200px;">Nome</td>
                            <td style="padding-right: 200px;">Excluir</td>
                            <td style="padding-right: 200px;">Editar</td>
                            <td>Produtos Vinculados</td>
                        </tr>
                    </thead>
                    <tbody id="tag_list"></tbody>
                </table>
            </div>
        </div>
    </main>
</body>
<?php include 'utils.php' ?>
<script src='public/js/utils.js'></script>
<script src="public/js/tags.js"></script>
<script>
    loadTags()
</script>

</html>