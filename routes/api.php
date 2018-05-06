<?php

use App\Controllers\ImageController;

$app->post('/', ImageController::class . ':store');
