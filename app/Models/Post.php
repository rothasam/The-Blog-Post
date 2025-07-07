<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Post extends Model
{
    Use HasFactory;
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

    public function users(){
        return $this->belongsTo(User::class,'user_id','user_id');
        // first user_id is the fk in the current model (Post)
        // second user_id is the pk in the User model
    }

    public function bookmarks(){
        return $this->hasMany(Bookmark::class,'post_id','post_id');
    }

    // Users who bookmarked this post
    public function bookmarkedByUsers(){
        return $this->belongsToMany(User::class, 'bookmarks', 'post_id', 'user_id');
    }

    // bookmarks() → direct access to Bookmark records (hasMany)
    // bookmarkedByUsers() → easy access to Users via pivot (belongsToMany)

    public function likes(){
        return $this->hasMany(Like::class,'post_id','post_id');
    }
    public function likedByUsers(){
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'post_id','post_id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class,'post_category','post_id','category_id');
    }

    public function formatDate($date){
        return Carbon::parse($date)->format('d M, Y');
    }

}
