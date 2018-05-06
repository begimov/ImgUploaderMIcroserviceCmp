<?php

namespace App\Files;

use Exception;
use Slim\Http\UploadedFile;

class FileStore
{
    protected $stored = null;

    public function store(UploadedFile $file)
    {
        try {
            $model = $this->createModel($file);

            $file->moveTo(uploads_path($model->uuid));
        } catch(Exception $e) {
            //
        }

        return $this;
    }

    protected function createModel(UploadedFile $file)
    {
        return $this->stored = Image::create([
            'uuid' => 'sdfsdfsdf'
        ]);
    }
}
