<?php
set_include_path(get_include_path() . PATH_SEPARATOR . realpath(__DIR__ . '/..'));
spl_autoload_extensions(".php");
spl_autoload_register();

require_once 'vendor/autoload.php';

$DEBUG = true;

if (preg_match('/\.(?:png|jpg|jpeg|gif|js|css|html|ico)$/', $_SERVER["REQUEST_URI"])) {
    return false;
}

$routes = include('Routing/routes.php');

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = ltrim($path, '/');

if (isset($routes[$path])) {
    $renderer = $routes[$path]();

    try{
        foreach ($renderer->getFields() as $name => $value) {
            $sanitized_value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            if ($sanitized_value && $sanitized_value === $value) {
                header("{$name}: {$sanitized_value}");
            } else {
                http_response_code(500);
                if($DEBUG) print("Failed setting header - original: '$value', sanitized: '$sanitized_value'");
                exit;
            }
            print($renderer->getContent());
        }
    }
    catch (Exception $e){
        http_response_code(500);
        print("Internal error, please contact the admin.<br>");
        if($DEBUG) print($e->getMessage());
    }
} else {
    header('Location:/404');
    exit;
}