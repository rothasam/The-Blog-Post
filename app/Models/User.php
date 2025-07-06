<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'first_name',
        'last_name',
        'gender_id',
        'email',
        'password',
        'dob',
        'role_id',
    ];

    public function role(){
        return $this->belongsTo(Role::class); 
    }
    public function gender(){
        return $this->belongsTo(Gender::class);
    }
    public function posts(){
        return $this->hasMany(Post::class); 
    }

    // direct access to Bookmark records with no detail
    public function bookmarks(){
        return $this->hasMany(Bookmark::class,'user_id','user_id'); 
    }

    // for convenient access to bookmarked posts with detail
    public function bookmarkedPosts(){
        return $this->belongsToMany(Post::class,'bookmarks','user_id','post_id');
    }

    public function authorRequests(){
        return $this->hasMany(AuthorRequest::class); 
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
