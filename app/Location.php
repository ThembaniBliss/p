<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';
    protected $primaryKey = 'loc_id';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loc_order',
        'loc_title',
        'loc_province',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'loc_id' => 'integer',
    ];


    public function property()
    {
        return $this->hasMany(\App\Property::class);
    }

    public function owner()
    {
        return $this->belongsTo(\App\Owner::class);
    }
}
