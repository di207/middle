<?php
/* 1. Сессии, кеши, сложные формы
 *
 * Написать простейшую форму логина по емейлу/паролю с обработкой данных. Сделать и вывод формы, и ее обработку,
 * и запись в сессию успешности логина и перенаправление на внутреннюю часть сайта - в одном файле. “Правильной парой”
 * для примера будет только test@example.com и пароль testtest (т.е. не надо базы данных реальной). Учесть защиту
 * от “силового подбора” пароля с помощью любого кеша (т.е. если на один емейл идут разные запросы с разными паролями
 * даже с разных айпи - блокировать эти боты еще до “подключения к базе”), выдавать разные формы
 * подтверждения “правдивости” в зависимости от количество неудачных попыток (капча, смс, емейл подтверждение).
 */


require "../header.tpl";
require "controller.php";
require "../footer.tpl";

