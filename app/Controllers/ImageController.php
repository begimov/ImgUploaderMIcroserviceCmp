<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};
use App\Files\FileStore;
use App\Models\Image;
use Exception;

class ImageController extends Controller
{
    public function show($request, $response, $args)
    {
        try {
            $image = Image::where('uuid', $args['uuid'])->firstOrFail();
        } catch (Exception $e) {
            return $response->withStatus(404);
        }

        $response->getBody()
            ->write($this->getProcessedImage($image, $request));

        return $this->respondWithHeaders($response);
    }

    public function store($request, $response, $args)
    {
        if (!$upload = $request->getUploadedFiles()['file'] ?? null) {
            return $response->withStatus(422);
        }

        try {
            $this->c->image->make($upload->file);
        } catch (Exception $e) {
            return $response->withStatus(422);
        }   
        
        $store = (new FileStore)->store($upload);

        return $response->withJson([
            'data' => [
                'uuid' => $store->getStored()->uuid
            ]
        ]);

    }

    protected function respondWithHeaders($response)
    {
        foreach ($this->getResponseHeaders() as $name => $value) {
            $response = $response->withHeader($name, $value);
        }
        return $response;
    }

    protected function getResponseHeaders()
    {
        return [
            'Content-Type' => 'image/png'
        ];
    }

    protected function getProcessedImage($image, $request)
    {
        return $this->c->image->make(uploads_path($image->uuid))
            ->resize($request->getParam('s'), null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('png');
    }
}
