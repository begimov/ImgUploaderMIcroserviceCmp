<?php

namespace App\Files;

use Slim\Http\UploadedFile;

class FileStore
{
    public function store(UploadedFile $file)
    {
        $file->moveTo(uploads_path($file->getClientFilename()));

        return $this;
    }
}
