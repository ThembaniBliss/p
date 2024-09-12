<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'image';
    protected $primaryKey = 'img_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'img_filename',
        'img_type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'img_id' => 'integer',
        'user_id' => 'integer',
    ];


    public function gallery()
    {
        return $this->belongsTo(\App\Gallery::class, 'gallery_main');
    }

    // public function user()
    // {
    //     return $this->belongsTo(\App\PoziUser::class, 'user_id');
    // }
    public function student()
    {
        return $this->belongsTo(\App\Student::class, 'stud_id');
    }
}
