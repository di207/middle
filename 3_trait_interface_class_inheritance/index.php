<?php
/*3. Трейты, интерфейсы, наследование классов
 * Напишите два класса для работы админки, один - список пользователей форума, а второй - список сообщений.
 * Они оба аскетичны (т.е. достаточно пары полей) и наследуют один общий класс “список объектов”,
 * у которого одна функция getList() - в зависимости от параметров запроса дает первые Н объектов
 * для таблицы в админке. Объекты можно сортировать и перебирать “по страницам”.
 */

require "controller.php";
require "../header.tpl";
require "template.tpl";
require "../footer.tpl";