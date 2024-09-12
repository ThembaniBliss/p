<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Property extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $table = 'property';
    protected $primaryKey = 'prop_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'location_id',
        'prop_description',
        'prop_rental_fee',
        'prop_deposit',
        'prop_rental_negotiable',
        'prop_rental_term',
        'prop_rooms',
        'prop_beds',
        'prop_accommodation_type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'prop_id' => 'integer',
        'owner_id' => 'integer',
        'loc_id' => 'integer',
        'prop_rental_fee' => 'double',
        'prop_deposit' => 'double',
    ];


    public function location()
    {
        return $this->belongsTo(\App\Location::class, 'loc_id');
    }

    public function owner()
    {
        return $this->belongsTo(\App\Owner::class, 'owner_id');
    }

    public function gallery()
    {
        return $this->hasMany(\App\Gallery::class, 'gallery_main');
    }
    
}
