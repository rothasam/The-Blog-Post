<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'comment_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'post_id',
        'user_id',
        'describe',
        'is_deleted'
    ];

    public function posts()
    {
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
