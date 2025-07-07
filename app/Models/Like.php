<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'like_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id','user_id');
    }

    public function posts()
    {
        return $this->belongsTo(Post::class, 'post_id','post_id');
    }
}
