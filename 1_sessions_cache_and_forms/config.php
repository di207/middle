<?php

define('CACHE', __DIR__ . '/cache/cache.txt');

// Default login data
define('EMAIL','test@example.com'  );
define('PASSWORD','testtest');

// Default check data
define('CHECK_CAPTCHA','1');
define('CHECK_EMAIL','1');
define('CHECK_SMS','1');

// Attemts count for captcha, email or sms
define('ATTEMPTS_FOR_CAPTCHA',3);
define('ATTEMPTS_FOR_EMAIL',6);
define('ATTEMPTS_FOR_SMS',9);

// Clear cache after 1h
define('CACHE_EXPIRE',3600);