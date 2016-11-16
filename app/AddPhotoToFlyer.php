<?php

namespace App;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Photo;

class AddPhotoToFlyer
{
    protected $flyer;
    protected $photo;

    public function __construct(Flyer $flyer, UploadedFile $file, Thumbnail $thumbnail = null)
    {
        $this->flyer = $flyer;
        $this->photo = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail;
    }

    public function save()
    {
        $photo = $this->flyer->addPhoto($this->makePhoto());

        // Move photo to images folder
        $this->photo->move($photo->baseDir(), $photo->name);

        // Generate a thumbnail
        $this->thumbnail->make($photo->path, $photo->thumbnail_path);

    }

    protected function makePhoto()
    {
        return new Photo(['name' => $this->makeFileName()]);
    }

    protected function makeFileName()
    {
        $name = sha1(
            time() . $this->photo->getClientOriginalName()
        );

        $extension = $this->photo->getClientOriginalExtension();

        return $name . '.' . $extension;
    }
}