<?php

namespace App\Observers\Utils;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    protected function createFile($model)
    {
        $field = $this->field;
        if (is_a($model->$field, UploadedFile::class) and $model->$field->isValid()) {
            $this->upload($model);
        }
    }

    protected function updateFile($model)
    {
        $field = $this->field;
        if (is_a($model->$field, UploadedFile::class) and $model->$field->isValid()) {
            $previous_file = $model->getOriginal($field);
            $this->upload($model);
            $this->removeFile($previous_file);
        }
    }

    protected function removeFile($file)
    {
        $prefix = Storage::disk(config('filesystems.default'))->getDriver()->getAdapter()->getPathPrefix();
        $file = $prefix . $this->path . '/' . $file;
        if (file_exists($file) and !is_dir($file)) {
            unlink($file);
        }
    }

    protected function upload($model)
    {
        $field = $this->field;
        $extention = $model->$field->extension();
        $name = bin2hex(openssl_random_pseudo_bytes(8));
        $name = $name . '.' . $extention;
        $model->$field->storeAs($this->path, $name);
    }
}
