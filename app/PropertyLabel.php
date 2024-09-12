<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyLabel extends Model
{
    protected $table = 'property';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label_id',
        'prop_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [        
        'label_id' => 'integer',
        'prop_id' => 'integer',
    ];


    public function label()
    {
        return $this->belongsTo(\App\Label::class, 'label_id');
    }

    public function property()
    {
        return $this->belongsTo(\App\Property::class, 'prop_id');
    }
}
