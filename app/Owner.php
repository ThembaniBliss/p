<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $table = 'owner';
    protected $primaryKey = 'owner_id';
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
        'user_id',
        'owner_name',
        'owner_surname',
        'owner_address',       
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'owner_id' => 'integer',
        'user_id' => 'integer',
    ];


    public function property()
    {
        return $this->hasMany(\App\Property::class, 'prop_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\PoziUser::class, 'user_id');
    }

    
}
