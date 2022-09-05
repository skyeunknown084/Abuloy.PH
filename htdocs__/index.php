<?php

$routes = [];

$path = $_SERVER['REQUEST_URI'];

// route('/login',  include 'login.php');

// route('/login', function () {
//     return include 'login.php';
// });

// route('/about-us', function () {
//   echo "About Us";
// });

// route('/404', function () {
//   echo "Page not found";
// });

function route(string $path, callable $callback) {
  global $routes;
  $routes[$path] = $callback;
}

run();

function run() {
  global $routes;
  $uri = $_SERVER['REQUEST_URI'];
  $found = false;
  foreach ($routes as $path => $callback) {
    if ($path !== $uri) continue;

    $found = true;
    $callback;
  }

  if (!$found) {
    $notFoundCallback = $routes['/404'];
    $notFoundCallback();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome to<br/></h1>
    <main>
        <?php  
            if($path == '/login'){ 
                route('/',  include 'login.php');
            } 
            if($path == '/'){ 
                route('/',  include 'home.php');
            } 
        ?>
        <a href="/">home</a>
        <a href="/login">login</a>
    </main>
</body>
</html>