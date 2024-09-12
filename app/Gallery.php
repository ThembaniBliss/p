<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $primaryKey = 'gallery_main';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'img_id',
        'prop_id',
        'gallery_main',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'gallery_main' => 'integer',
        'img_id' => 'integer',
        'prop_id' => 'integer',
    ];


    public function image()
    {
        return $this->hasMany(\App\Image::class, 'img_id');
    }

    public function property()
    {
        return $this->belongsTo(\App\Property::class, 'prop_id');
    }

}
