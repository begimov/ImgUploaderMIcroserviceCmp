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

        try {
            $this->c->image->make($upload->file);
        } catch (\Exception $e) {
            return $response->withStatus(422);
        }
        
        
        $store = (new FileStore)->store($upload);

        return $response->withJson([
            'data' => [
                'uuid' => $store->getStored()->uuid
            ]
        ]);

    }
}
