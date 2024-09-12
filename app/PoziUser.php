<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoziUser extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_email', 'user_password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_password', 'user_auth-code',
    ];

    public function student()
    {
        return $this->hasMany(\App\Student::class, 'stud_id');
    }
}
