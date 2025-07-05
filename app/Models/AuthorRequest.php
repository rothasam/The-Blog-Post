<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorRequest extends Model
{
    protected $table = 'author_requests';
    protected $primaryKey = 'author_request_id';
    public $incrementing = true;
    public $timestamps = true;

    
    protected $fillable = [
        'user_id',
        'describe',
        'status',
    ];

    /**
     * Get the user that owns the author request.
     */
    public function users()
    {
        return $this->belongsTo(User::class);
        
    } 
}
