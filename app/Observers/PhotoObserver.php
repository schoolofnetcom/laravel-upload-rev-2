<?php

namespace App\Observers;

use App\Photo;
use App\Observers\Utils\UploadTrait;

class PhotoObserver
{
    use UploadTrait;

    protected $field = 'url';
    protected $path = 'img';

    public function creating(Photo $model)
    {
        $this->createFile($model);
    }

    public function deleting(Photo $model)
    {
        $this->removeFile($model->url);
    }

    public function updating(Photo $model)
    {
        $this->updateFile($model);
    }
}
