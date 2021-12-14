<?php
spl_autoload_register(function ($class) {
    include $class . '.php';
});

try {
    $img = new Image(__DIR__ . '/exapmple/test3.jpg');
    $img->resize( 100, 200 )->save();

    $img = new Image(__DIR__ . '/exapmple/test2_400x600.jpg');
    $img->resize( 100, 200 )->save();

    $img = new Image(__DIR__ . '/exapmple/test3_400x800.jpg');
    $img->resize( 100, 200 )->save();

    $img = new Image(__DIR__ . '/exapmple/test4_400x1000.jpg');
    $img->resize( 100, 200 )->save();

    $img = new Image(__DIR__ . '/exapmple/test5_200x500.jpg');
    $img->resize( 100, 200 )->save();

    $success = 'Done! Example of the result of work class look along the path of the project 2_try_catch_simple_classes/images';
} catch(Exception $e) {
    $error = 'Failed: ' . $e->getMessage();
}



