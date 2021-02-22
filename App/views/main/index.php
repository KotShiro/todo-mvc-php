<h1 class="text-center">Главная страница</h1>
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
<div class="row justify-content-center">
    <?
    foreach ($tasks as $value):
    ?>

        <div class="card text-dark <?= $value['state'] < 1 ? 'bg-light' : 'bg-success' ?> m-3 col-4 px-0" style="max-width: 18rem;">
            <div class="card-header"><span class="text-<?= $value['state'] < 1 ? 'info' : 'light' ?> strong">#<?=$value['id']?></span> <strong><?=$value['email']?></strong></div>
            <div class="card-body">
                <h5 class="card-title"><?=$value['name']?></h5>
                <p class="card-text"><?=$value['content']?></p>
            </div>
            <div class="card-footer ">
                <div class="row justify-content-between">
                    <span><?= $value['state'] < 1 ? 'В работе' : 'Закрыта' ?></span>
                    <span><?= $value['edit'] < 1 ? '' : 'Ред.' ?></span>
                </div>
            </div>
        </div>

    <?
    endforeach;
    ?>
</div>

<nav class="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="page=1<?=$paramSelect?>">Первая</a></li>
        <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
            <a  class="page-link" href="<?php if($page <= 1){ echo '#'; } else { echo "page=".$back; } ?><?=$paramSelect?>">Назад</a>
        </li>
        <li class="page-item <?php if($page >= $totalPages){ echo 'disabled'; } ?>">
            <a  class="page-link" href="<?php if($page >= $totalPages){ echo '#'; } else { echo "page=".$next; } ?><?=$paramSelect?>">Вперёд</a>
        </li>
        <li class="page-item"><a  class="page-link" href="page=<?= $totalPages; ?><?=$paramSelect?>">Последняя</a></li>
    </ul>
</nav>