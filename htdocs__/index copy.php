<?php

require_once __DIR__ . '/vendor/autoload.php';

use app\core\Application;

$app = new Application();

// $app->router->get('/', funtion(){
//     return 'hello';
// });


// $app->router->get('/contact', funtion(){
//     return 'Contact';
// });
 
$app->run();