<?php

require_once __DIR__ . '/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => getenv('APP_DEBUG') === 'true',

        'app' => [
            'name' => getenv('APP_NAME')
        ],
    ],
]);

$container = $app->getContainer();

require_once __DIR__ . '/../routes/api.php';
