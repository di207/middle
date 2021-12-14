<?php

/*
 * опишите что этот запрос делает, и можно ли его улучшить
 * заметьте - это Postgresql - предположительно не знакомая вам база данных и вам нужно
 * почитать документацию прежде чем ответить
 */

$sql = 'UPDATE reviews AS r SET (status, chtime)=(1, NOW())
        WHERE (SELECT sub.match
        FROM (SELECT (reviews.*)=(r.*) AS match
        FROM items AS i
        LEFT JOIN reviews ON reviews.id_item = i.id
        WHERE item.id=222) AS sub)';

$newSql = 'UPDATE reviews AS r SET (status, chtime)=(1, NOW()) WHERE id_item=222';

/*
 * Запрос обновляет строки в таблице reviews, где id_item = 222,
 * устанавливает status = 1 и chtime - текущее время
 */

require "../header.tpl";

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm">
            <div class="list-group">
                <a href="/" class="list-group-item list-group-item-action">Назад</a>
                <a href="/1_sessions_cache_and_forms/" class="list-group-item list-group-item-action">1. Сессии, кеши, сложные формы</a>
                <a href="/2_try_catch_simple_classes/" class="list-group-item list-group-item-action">2. Трай, кетч, простые классы </a>
                <a href="/3_trait_interface_class_inheritance/" class="list-group-item list-group-item-action">3. Трейты, интерфейсы, наследование классов</a>
                <a href="/4_code_review/" class="list-group-item list-group-item-action active">4. Code review</a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm">
            <p><?php print_r($sql ); ?></p>
            <p>Запрос обновляет строки в таблице reviews, где id_item = 222, устанавливает status = 1 и chtime - текущее время</p>
            <p>Оптимизировать запрос можно следующим образом:</p>
            <p><?php print_r($newSql ); ?></p>
        </div>
    </div>
</div>

<?php require "../footer.tpl"; ?>