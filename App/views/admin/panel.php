<h1 class="text-center">Админ панель</h1>
<form>
    <legend>Условия сортировки</legend>
    <div class="row">
        <div class="mb-3 col-3">
            <label for="name" class="form-label">По имени</label>
            <select id="name" name="name" class="form-control">
                <option value="">-</option>
                <option <?= $paramSelect? ($getName ==='ASC' ?  'selected' : '') : ''?> value="ASC">От А до Я</option>
                <option <?= $paramSelect? ($getName ==='DESC' ?  'selected' : '') : ''?> value="DESC">От Я до А</option>
            </select>
        </div>
        <div class="mb-3 col-3">
            <label for="email" class="form-label">По e-mail(у)</label>
            <select id="email" name="email" class="form-control">
                <option value="">-</option>
                <option <?= $paramSelect? ($getEmail ==='ASC' ?  'selected' : '') : ''?> value="ASC">От A до Z</option>
                <option <?= $paramSelect? ($getEmail ==='DESC' ?  'selected' : '') : ''?> value="DESC">От Z до A</option>
            </select>
        </div>
        <div class="mb-3 col-3">
            <label for="email" class="form-label">По состоянию</label>
            <select id="email" name="state" class="form-control">
                <option value="">-</option>
                <option <?= $paramSelect? ($getState ==='ASC' ?  'selected' : '') : ''?> value="ASC">От "В работе" до "Закрыта"</option>
                <option <?= $paramSelect? ($getState ==='DESC' ?  'selected' : '') : ''?> value="DESC">От "Закрыта" до "В работе"</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-outline-light">Применить сортировку</button>
</form>
<div class="justify-content-center d-flex container">
<?
foreach ($tasks as $value):
?>
<div class='card text-white <?= $value['state'] ==='1' ?  'bg-success' : 'bg-dark' ?> col-5 col-md-4 m-2 p-3'>
    <form id="form-<?=$value['id']?>" action="/admin/edit" method="post">
        <label class="m-1" id="form-<?=$value['id']?>">#<?=$value['id']?></label>
        <input type="hidden" name="id" value="<?=$value['id']?>">
        <input type="hidden" name="name" value="<?=$value['name']?>">
        <input type="hidden" name="email" value="<?=$value['email']?>">
        <input class="form-control my-2" type="text" value="<?=$value['name']?>" disabled>
        <input class="form-control my-2" type="text" value="<?=$value['email']?>" disabled>
        <textarea class="form-control my-2" name="content"><?=$value['content']?></textarea>
        <select class="form-control my-2" name="state">
            <option <?= $value['state'] ==='0' ?  'selected' : '' ?> value='0'>Не выполнен</option>
            <option <?= $value['state'] ==='1' ?  'selected' : '' ?> value='1'>Завершон</option>
        </select>
        <input class="btn btn-outline-light my-2" type="submit" value="Отредактировать">
    </form>
</div>
<?
endforeach;
?>
</div>
<nav class="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="panel=1">Первая</a>
        </li>
        <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($page <= 1){ echo '#'; } else { echo "panel=".$back; } ?>">Назад</a>
        </li>
        <li class="page-item <?= $page >= $totalPages ? 'disabled': ''?>">
            <a class="page-link" href="<?= $page >= $totalPages ? 'disabled': 'panel='.$next?>">Вперёд</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="panel=<?= $totalPages ?>">Последняя</a>
        </li>
    </ul>
</nav>