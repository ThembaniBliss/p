<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prop_id',
        'order_amount',
        'order_payment_method',
        'order_reference',       
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_id' => 'integer',
        'prop_id' => 'integer',
    ];


    public function property()
    {
        return $this->belongsTo(\App\Property::class);
    }
}
