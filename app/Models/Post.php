<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'content',
        'thumbnail',
        'is_deleted',
        'published_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bookmarks(){
        return $this->hasMany(Bookmark::class);
    }

    public function postCategories(){
        return $this->hasMany(PostCategory::class);
    }

}
