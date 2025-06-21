<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;
    protected $table = 'post_categories';
    protected $primaryKey = 'post_category_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'category_id',
    ];

    public function post(){
        return $this->belongsTo(Post::class, 'post_id','post_id');
            
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

}
