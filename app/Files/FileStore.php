<?php

namespace App\Files;

use Slim\Http\UploadedFile;

class FileStore
{
    public function store(UploadedFile $file)
    {
        $file->moveTo(__DIR__ . '/../../storage/uploads/' . $file->getClientFilename());

        return $this;
    }
}
