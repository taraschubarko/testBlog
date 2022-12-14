<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Ролі користувачів
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    //
    public function setPasswordAttribute($val)
    {
        $this->attributes['password'] = bcrypt(trim($val));
    }
    //
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function isAdmin(): bool
    {
        $roles = $this->roles->pluck('slug')->toArray();
        return in_array('admin', $roles);
    }

    public function isModerator(): bool
    {
        $roles = $this->roles->pluck('slug')->toArray();
        return in_array('moderator', $roles);
    }
    //Контакти користувачів
    public function contacts()
    {
        return $this->belongsToMany(self::class, 'user_contacts', 'contact_id');
    }


}
