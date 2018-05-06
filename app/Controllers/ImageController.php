<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};
use App\Files\FileStore;

class ImageController extends Controller
{
    public function store($request, $response, $args)
    {
        if (!$upload = $request->getUploadedFiles()['file'] ?? null) {
            return $response->withStatus(422);
        }
        
        $store = (new FileStore)->store($upload);

        dump($store->getStored());

        die('OK');

    }
}
