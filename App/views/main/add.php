<h1 class="text-center">Добавление</h1>
<div class="<?=$alert ? 'alert alert-info' : ''?>" role="alert"><?=$alert?></div>
<div class="row justify-content-center">

    <div class='card text-white bg-dark col-5 col-md-4 m-2 p-3'>
        <form action="/add" method="post">
            <p>Ваше имя*:</p>
            <p>
                <input class="form-control my-2"  type="text" name="name">
            </p>
            <p>Email*:</p>
            <p>
                <input class="form-control my-2"  type="text" name="email">
            </p>
            <p>Текст задачи*:</p>
                <textarea class="form-control my-2"  name="content"></textarea>
            <p>
                <button class="btn btn-outline-light my-2" type="submit">Добавить</button>
            </p>

        </form>
    </div>
</div>