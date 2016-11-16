<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class Photo extends Model
{
    protected $table = 'flyer_photos';

    protected $fillable = ['name', 'path', 'thumbnail_path'];

    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->path = $this->baseDir() .'/'. $name;
        $this->thumbnail_path = $this->baseDir() .'/tn-'. $name;
    }

    public function baseDir()
    {
        return 'flyer-assets/photos';
    }

    public function delete()
    {
        \File::delete([
            $this->path,
            $this->thumbnail_path
        ]);

        parent::delete();
    }
}
