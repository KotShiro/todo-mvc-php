<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><? echo $title ?></title>
    <link href="https://fonts.googleapis.com/css?family=Bad+Script|Jura&display=swap" rel="stylesheet">
    <script type="text/javascript" src="../../Public/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../../Public/style/bootstrap.min.css">
    <link rel="stylesheet" href="../../Public/style/main.css">
    <link rel="shortcut icon" href="../../Public/img/favicon.png" type="image/png">
</head>
<body class="bg-info text-white">
    <div>
        <nav class="navbar navbar-expand-md navbar-dark">
            <a class="navbar-brand" href="/">Todo-mvc-php</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">

                    <a class="nav-item nav-link <?=$this->route["action"] === 'index' ? 'active' : ''?>" href="/">Доска заданий<span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link <?=$this->route["action"] === 'add' ? 'active' : ''?>" href="/add">Добавить задание</a>
                    <?
                    if($checkCookie) {
                    ?>
                        <a class="nav-item nav-link <?=$this->route["action"] === 'panel' ? 'active' : ''?>"  href="/admin/panel=1">Админ-панель</a>
                        <a class="nav-item nav-link " href="/admin/logout">LogOut</a>
                    <?
                    } else {
                    ?>
                        <a class="nav-item nav-link <?=$this->route["action"] === 'login' ? 'active' : ''?>" href="/admin/login">LogIn</a>
                    <?
                    }
                    ?>
                </div>
            </div>
        </nav>
        <main class="ml-md-5 mr-md-5">
            <? echo $content ?>
        </main>
  </div>
</body>
</html>