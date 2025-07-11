<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';
    protected $primaryKey = 'profile_id';
    public $incrememting = true;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'username',
        'avatar',
        'bio',
        'phone',
        'address'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','user_id');
    }
    
}
