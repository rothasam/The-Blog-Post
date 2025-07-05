<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table = 'bookmarks';
    protected $primaryKey = 'bookmark_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'user_id'
    ];


    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function posts(){
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }
}
