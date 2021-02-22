<h1 class='text-center'>Вход</h1>
<div class="<?=$masseg ? 'alert alert-danger' : ''?>" role="alert"><?=$masseg?></div>
<div class="row justify-content-center">
<form action="/admin/login" method="post" class="col-4 px-0">
    <p>Логин</p>
    <p><input type="text" name="login" class="form-control"></p>
    <p>Пароль</p>
    <p><input type="password" name="password" class="form-control"></p>
    <p><button class="btn btn-outline-light" type="submit" >Войти</button></p>
</form>
</div>