<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'name'
    ];

    public function postCategories()
    {
        return $this->hasMany(PostCategory::class);
    }
}
